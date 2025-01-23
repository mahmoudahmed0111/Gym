<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Models\Trainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $userRepository;


    public function create()
    {
        return view('trainee-dashboard.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in admin
        $trainee = Trainee::where('email', $request->email)->first();

        if ($trainee && Hash::check($request->password, $trainee->password)) {
            Auth::guard('trainee')->login($trainee); // Manually log the user in
            return redirect()->intended(route('trainee.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
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
        auth('trainee')->logout();
        return redirect()->route('trainee.login');
    }

    public function setting()
    {
        $data = Trainee::find(auth("trainee")->id());
        return view("trainee-dashboard.admins.setting", compact("data"));
    }


    public function update_setting(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $trainee = Trainee::find(auth("trainee")->id());
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $trainee->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "trainees");
        }
        $trainee->update($data);
        return redirect()->back()->with('success', __('models.edited_successfully'));
    }
}
