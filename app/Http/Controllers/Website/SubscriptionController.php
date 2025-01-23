<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Club;
use App\Models\Package;
use App\Models\PaymentLog;
use App\Models\Vendor;
use Http;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $packages_club = Package::where("type", "club")->get();
        $packages_vendor = Package::where("type", "vendor")->get();
        return view("website.subscription.index",compact("packages_club","packages_vendor"));
    }
    public function subscription_club($id){
        $package = Package::findOrFail($id);
        $categories = Category::all();

        return view("website.subscription.subscription_club",compact("package","categories"));
    }
    public function subscription_vendor($id){
        $package = Package::findOrFail($id);
        // $categories = Category::all();

        return view("website.subscription.subscription_vendor",compact("package"));
    }

    public function club_store(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|',
            'mobile' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'img' => 'nullable|image',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',
        ]);
        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);
        $data['is_active'] = false;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "images");
        }

        $club = Club::firstOrCreate([
                "email" => $request->email,
                ]
            ,$data);
        $package = Package::find($id);
        $club->subscriptions()->create([
            'amount' => $package->price,
            'package_id' => $id,
            'start_date' => now(),
            'end_date' => $package->time==-1? null: now()->addMonths($package->time),
        ]);
        $paymentToken = $this->payment($club,$package);
        if ($paymentToken) {
            // return  $paymentToken;
            session()->put('type', "club");

        return redirect('https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken)->with('success', __('models.added_successfully'));
        }else{
            return back()->with('error', "craeting club failed, please try again later");
        }
    }

    public function vendor_store(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|',
            'mobile' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'img' => 'nullable|image',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',
        ]);
        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);
        $data['is_active'] = false;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "images");
        }

        $club = Vendor::firstOrCreate([
                "email" => $request->email,
                ]
            ,$data);
        $package = Package::find($id);
        $club->subscriptions()->create([
            'amount' => $package->price,
            'package_id' => $id,
            'start_date' => now(),
            'end_date' => $package->time==-1? null: now()->addMonths($package->time),
        ]);
        $paymentToken = $this->payment($club,$package);
        if ($paymentToken) {
            // return  $paymentToken;
            session()->put('type', "vendor");

        return redirect('https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken)->with('success', __('models.added_successfully'));
        }else{
            return back()->with('error', "craeting club failed, please try again later");
        }
    }

    public function payment($user,$package){

        $paymentLog = PaymentLog::create([
            'bill_no' => mt_rand(100000000, 9999999999),
            'owner_id' => Admin::first()->id,
            'owner_type' => get_class(Admin::first()),
            'amount' => $package->price,
            'type' => "subscriptions",
            'payment_tool' => "visa",
        ]);
        session()->put('paymentLog_id', $paymentLog->id);
        session()->put('user_id', $user->id);
        try {
            $items = [
                [
                    "name" => $user->name ." ".$package->name,
                    "description" => "subscription",
                    "amount" => ($package->price) * 100,
                    "quantity" => 1,
                ]
            ];

            $billingData = [
                "email" => $user->email,
                "first_name" => $user->name,
                "last_name" => ".",
                "phone_number" => $user->mobile,
                "phone" => $user->mobile,
                "street1" => "",
                "city" => "nan",
                "state" => "nan",
                "country" => "nan",
                "address" => "",
                "floor" => "42",
                "apartment" => "803",
                "street" => "Ethan Land",
                "building" => "8028",
                "shipping_method" => "PKG",
            ];

            $data = [
                "amount" => ($package->price)  * 100, // Ensure this is an integer value, equivalent to 100.00 SAR
                "currency" => "SAR",
                "payment_methods" => ["MIGS-Website", "Apple Pay - Website"],
                "items" => $items,
                "billing_data" => $billingData,
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . env("SECRET_KEY")
            ])->post('https://ksa.paymob.com/v1/intention/', $data);

            $paymentToken= $response->object()->client_secret;

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $paymentToken ;
        // sendResponse(200, 'Subscription successfully', ['url' => 'https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken]);
    }

    public function callback(Request $request)
    {

        $data = $request->all();
        // dd($data);
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if(in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC_SECRET');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ( $hased == $hmac) {
            // echo "secure" ; exit;
            $is_success=filter_var($request['success'],FILTER_VALIDATE_BOOLEAN);
            if ($is_success) {
                // Payment was successful
                // Setting a session variable 'order' to true or any value
                // $this->createOrder($payment = 'visa',$payment_status = 'paid');
                $paymentLog=PaymentLog::find(session()->get('paymentLog_id'));
                $paymentLog->update(['status' => true]);
                if(session()->get('type')=="club"){
                    $user=Club::find(session()->get('user_id'));
                    $user->update(['is_active' => true]);
                }elseif(session()->get('type')=="vendor"){
                    $user=Vendor::find(session()->get('user_id'));
                    $user->update(['is_active' => true]);
                }
                session()->forget('paymentLog_id');
                session()->forget('user_id');
                session()->forget('type');
            } else {
                $paymentLog=PaymentLog::find(session()->get('paymentLog_id'));
                $paymentLog->delete();
                if(session()->get('type')=="club"){
                    $user=Club::find(session()->get('user_id'));
                    $user->delete();
                }elseif(session()->get('type')=="vendor"){
                    $user=Vendor::find(session()->get('user_id'));
                    $user->delete();
                }
                session()->flash('error', "subscription creation failed.");
                session()->forget('paymentLog_id');
                session()->forget('user_id');
                session()->forget('type');
                return redirect()->route('subscription.index')->with('error', 'subscription creation failed.');
            }
        }
        return redirect()->route('subscription.index')->with('error', 'payment not secure.');
    }
}
