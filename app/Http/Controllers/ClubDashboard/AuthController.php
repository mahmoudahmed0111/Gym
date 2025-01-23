<?php

namespace App\Http\Controllers\coachDashboard;

use Carbon\Carbon;
use App\Models\coach;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    protected $userRepository;



    public function create()
    {
        return view('coach-dashboard.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in coach
        if (auth('coach')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $coach = auth('coach')->user();
            if ( $coach->is_active == true && $subscription && $subscription->is_active == true &&  ($subscription->end_date === null || Carbon::parse($subscription->end_date)->isFuture())) {
                return redirect()->intended(route('coach.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
            }elseif( $coach->is_active == true && !$subscription ){
                return redirect()->intended(route('coach.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
            } else {
                auth('coach')->logout();
                return redirect()->back()->withErrors(['password' => 'Your subscription is either inactive or expired.']);
            }
            // return redirect()->intended(route('coach.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
        }

        // Neither coach nor regular user authenticated
        return redirect()->back()->withInput($request->only('password'))->withErrors([
            'password' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ]);
    }


    public function logout(Request $request)
    {
        auth('coach')->logout();
        return redirect()->route('coach.login');
    }

    public function setting()
    {
        $data = Coach::find(auth("coach")->id());
        return view("coach-dashboard.coachs.setting", compact("data"));
    }


    public function update_setting(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $coach =Coach::find(auth("coach")->id());
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $coach->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        $coach->update($data);
        return redirect()->back()->with('success', __('models.edited_successfully'));
    }




}
