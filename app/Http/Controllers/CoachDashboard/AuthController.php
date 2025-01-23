<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Attempt to log in admin
        $coach = Coach::where('email', $request->email)->first();

        if ($coach && Hash::check($request->password, $coach->password)) {
            Auth::guard('coach')->login($coach); // Manually log the user in
            return redirect()->intended(route('coach.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
        } else {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }

        // Neither vendor nor regular user authenticated
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
        return view("dashboard.admins.setting", compact("data"));
    }


    public function update_setting(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $admin = Coach::find(auth("admin")->id());
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $admin->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        $admin->update($data);
        return redirect()->back()->with('success', __('models.edited_successfully'));
    }
}
