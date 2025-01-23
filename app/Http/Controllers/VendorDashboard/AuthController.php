<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\Vendor;
use App\Repositories\Sql\AdminRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $userRepository;



    public function create()
    {
        return view('vendor-dashboard.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in admin
        if (auth('vendor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('vendor.dashboard.index'))->with('success', 'تم تسجيل الدخول بنجاح');
        }

        // Neither vendor nor regular user authenticated
        return redirect()->back()->withInput($request->only('password'))->withErrors([
            'password' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ]);
    }


    public function logout(Request $request)
    {
        auth('vendor')->logout();
        return redirect()->route('login');
    }

    public function setting()
    {
        $data = Vendor::find(auth("vendor")->id());
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
        $admin =Vendor::find(auth("admin")->id());
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $admin->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        $admin->update($data);
        return redirect()->back()->with('success', __('models.edited_successfully'));
    }




}
