<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\VideoResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;

use App\Models\Exam;
use App\Models\Level;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\PaymentLog;
use App\Models\Product;
use App\Models\Question;
use App\Models\Score;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Subscription;
use App\Models\Support;
use App\Models\Term;
use App\Models\User;
use App\Models\UserExam;
use App\Models\Video;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $subscription = Subscription::create([
            'club_id' => $request->club_id,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);

        // Here, you'd normally redirect to a payment gateway
        return $this->credit( $request) ;
    }
    public function credit(Request $request) {
        try{

            $paymentToken = $this->getPaymentToken($request);
            } catch (\Exception $exception) {
                dd($exception);
            }
        // return "belal";
        return sendResponse(200, 'Subscription successfully', ['url' => 'https://ksa.paymob.com/unifiedcheckout/?publicKey='.env('PUBLIC_KEY').'&clientSecret='.$paymentToken]);
    }

    public function getPaymentToken(Request $request)
    {
        $user=auth()->user();
        $items =[ [
                "name"=>  $user->name ,
                "description"=>  "subscription" ,
                "amount"=> ($request->price )*100,
                "quantity" => 1,
            ]];
        $billingData = [
            "email" => $user->email,
            "first_name" => $user->name,
            "last_name" => ".",
            "phone_number" => $user->mobile,
            "phone" => $user->mobile,
            "street1" =>  "",
            "city" =>"nan",
            "state" =>  "nan",
            "country" =>"nan",
            "address" =>"",
            "floor" => "42",
            "apartment" =>  "803",
            "street" => "Ethan Land",
            "building" => "8028",
            "shipping_method" => "PKG",

        ];
        $data = [
            "amount" => $request->price *100, // Ensure this is an integer value, equivalent to 100.00 SAR
            "currency" => "SAR",
            "payment_methods"=>  ["MIGS-Website","Apple Pay - Website"], //Enter your integration id
            "items" => $items,
            "billing_data" => $billingData,
        ];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Token '.env("SECRET_KEY")
        ])->post('https://ksa.paymob.com/v1/intention/', $data);
        return $response->object()->client_secret;
    }

    // public function callback(Request $request)
    // {

    //     $data = $request->all();
    //     // dd($data);
    //     ksort($data);
    //     $hmac = $data['hmac'];
    //     $array = [
    //         'amount_cents',
    //         'created_at',
    //         'currency',
    //         'error_occured',
    //         'has_parent_transaction',
    //         'id',
    //         'integration_id',
    //         'is_3d_secure',
    //         'is_auth',
    //         'is_capture',
    //         'is_refunded',
    //         'is_standalone_payment',
    //         'is_voided',
    //         'order',
    //         'owner',
    //         'pending',
    //         'source_data_pan',
    //         'source_data_sub_type',
    //         'source_data_type',
    //         'success',
    //     ];
    //     $connectedString = '';
    //     foreach ($data as $key => $element) {
    //         if(in_array($key, $array)) {
    //             $connectedString .= $element;
    //         }
    //     }
    //     $secret = env('PAYMOB_HMAC_SECRET');
    //     $hased = hash_hmac('sha512', $connectedString, $secret);
    //     if ( $hased == $hmac) {
    //         // echo "secure" ; exit;
    //         $is_success=filter_var($request['success'],FILTER_VALIDATE_BOOLEAN);
    //         if ($is_success) {
    //             // Payment was successful
    //             // Setting a session variable 'order' to true or any value
    //             $this->createOrder($payment = 'visa',$payment_status = 'paid');
    //         } else {
    //             // session()->flash('order', true);
    //             session()->flash('error', "Order creation failed.");
    //             // Handle the error case
    //             return redirect()->route('user.order.checkout')->with('error', 'Order creation failed.');
    //         }
    //     }
    //     return redirect()->route('user.order.checkout')->with('error', 'payment not secure.');
    // }

    // public function handlePayment(Request $request)
    // {
    //     $request->validate([
    //         'subscription_id' => 'required|exists:subscriptions,id',
    //         'payment_status' => 'required|in:success,failure',
    //     ]);

    //     $subscription = Subscription::find($request->subscription_id);

    //     if ($request->payment_status == 'success') {
    //         // Handle successful payment logic here
    //         $subscription->update(['status' => 'active']);
    //         return response()->json(['message' => 'Payment successful. Subscription is now active.']);
    //     } else {
    //         // Handle failed payment logic here
    //         $subscription->delete();
    //         return response()->json(['message' => 'Payment failed. Subscription has been cancelled.']);
    //     }
    // }


    public function slider(Request $request)
    {
        $data = Slider::get()->map(function($item){
            return[
                "image"=>url("storage/".$item->image)
            ];
        });
        return response()->json(['message' => 'slider get successfully', 'data' => $data], 200);
    }


    public function category()
    {
        $category = Category::latest()->paginate(10);
        return CategoryResource::collection($category);
    }


    public function products()
    {
        $products = Product::latest()->paginate(10);
        return ProductResource::collection($products);
    }


    public function product($id)
    {
        $product=Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function add_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $address = Address::create([
            'user_id' =>auth()->user()->id,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return response()->json([
            'message' => 'Address created successfully.',
            'address' => $address,
        ], 201);
    }

    /**
     * Retrieves the addresses for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the user's addresses.
     */
    public function get_addresses()
    {
        $addresses = auth()->user()->addresses;

        return response()->json([
            'message' => 'Addresses retrieved successfully.',
            'addresses' => $addresses,
        ], 200);
    }

    public function store_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|exists:addresses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $address = $request->user()->addresses()->find($request->address_id);

        if (!$address) {
            return response()->json(['error' => 'Invalid address.'], 422);
        }

        $userId = auth()->user()->id;
        // Retrieve the carts associated with the user
        $carts = Cart::where('user_id', $userId)->get();
        $user = auth()->user();

        $items = [];
        foreach ($carts as $item) {
            $product = $item->product;

            $items[] = [
                "name" => $product->name,
                "description" => $product->description,
                "amount" => $item->price * 100, // Amount in cents
                "quantity" => $item->quantity,
            ];
        }

        try {
            // Step 6: Prepare billing data
            $billingData = [
                "email" => $user->email,
                "first_name" => $user->name,
                "last_name" => ".",
                "phone_number" => $user->mobile,
                "phone" => $user->mobile,
                "street1" => $address->address_line1,
                "street2" => $address->address_line2,
                "city" => $address->city,
                "state" => $address->state,
                "country" => $address->country,
                "postal_code" => $address->postal_code,
                "shipping_method" => "PKG",
            ];

            // Step 7: Prepare data for the payment request
            $data = [
                "amount" => calculateTotalCart() * 100, // Amount in cents
                "currency" => "SAR",
                "payment_methods" => ["MIGS-Website", "Apple Pay - Website"],
                "items" => $items,
                "billing_data" => $billingData,
            ];

            // Step 8: Send the payment request to the payment gateway
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . env("SECRET_KEY")
            ])->post('https://ksa.paymob.com/v1/intention/', $data);

            // Step 9: Extract the payment token from the response
            $paymentToken = $response->object()->client_secret;

        } catch (\Exception $exception) {
            // Handle exceptions
            return sendResponse(402, "error", $exception->getMessage());
        }

        // Step 12: Return the response with the payment URL and relevant IDs
        return sendResponse(200, 'Subscription successfully', [
            'url' => 'https://ksa.paymob.com/unifiedcheckout/?publicKey=' . env('PUBLIC_KEY') . '&clientSecret=' . $paymentToken,
        ]);
    }



    public function handlePayment(Request $request)
    {
        $request->validate([
            'payment_status' => 'required|in:success,failure',
        ]);

        if ($request->payment_status == 'success') {
                    // Get the user ID from the request or from the authenticated user
        $userId = auth()->user()->id;
        // Retrieve the carts associated with the user
        $carts = Cart::where('user_id', $userId)->get();

        // Initialize total price variable

            // Step 10: Create an order in the database
            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $request->address_id,
                'total_amount' => calculateTotalCart(),
                'status' => 'pending',
            ]);

            // Step 11: Create order items in the database
            foreach ($carts as $item) {
                $product = $item->product;
                $product->update([
                    "stock"=>$product->stock - $item['quantity']
                ]);
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'attribute_values' => $item['attribute_values'],
                    'owner_id' => $product->owner_id,
                    'owner_type' => $product->owner_type,
                    'price' => $item['price'],
                ]);
                $paymentLog = PaymentLog::create([
                    'bill_no' => mt_rand(100000000, 9999999999),
                    'owner_id' => $product->owner_id,
                    'owner_type' => $product->owner_type,
                    'amount' => $item['price']*$item->quantity ,
                    'type' => "order",
                    'payment_tool' => "visa",
                    'status' => true,
                ]);
                if($paymentLog->owner_type == "App\Models\Vendor"){
                    $paymentLog->owner()->update([
                        "balance"=> $paymentLog->owner->balance + $paymentLog->amount
                    ]);
                }
            }
            foreach ($carts as $item) {
                $item->delete();
            }
            return response()->json(['message' => 'Payment successful. order is now active.']);
        } else {

            return response()->json(['message' => 'Payment failed. order has been cancelled.']);
        }
    }


    public function support(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        $message = $validated['message'];
        $support = new Support([
            'message' => $message,
            'owner_type' => get_class(User::first()),
            'owner_id' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Support message created successfully.',
            'support' => $support,
        ], 201);
    }

    public function setting()
    {
        $model=Setting::first();
        return response()->json([
            'message' => 'Setting get successfully.',
            'data' => $model,
        ], 201);
    }

    public function terms_conditions($type)
    {
        // Fetch all terms from the database
        $terms = Term::where("type", $type)->get();
        $terms=$terms->map(function ($item) {
            return [
                "id" => $item->id,
                "title" => $item->title,
                "desc" => $item->desc,
            ];
        });
        // Return the terms as a JSON response
        return sendResponse(200, "Successfully",$terms);
    }
}
