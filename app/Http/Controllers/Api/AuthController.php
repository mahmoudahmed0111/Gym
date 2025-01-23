<?php

// app/Http/Controllers/Api/AuthController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|string',
            'city_id' => 'nullable|exists:cities,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('password', 'img', 'cover_img');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }

        if ($request->hasFile('cover_img')) {
            $data['cover_img'] = UploadImage($request->file('cover_img'), "users");
        }

        $user = User::create($data);
        $token = $user->createToken('tokens')->plainTextToken;
        $responseData = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return sendResponse(200, 'user created successfully', $responseData);
    }

    public function login(Request $request)
    {
        $rules = [
            'email_or_mobile' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $loginType = filter_var($request->email_or_mobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $user = User::where($loginType, $request->email_or_mobile)->first();

        if ($user) {
            $otp = rand(100000, 999999);
            $user->update(['otp' => $otp]);

            // Send OTP to user's mobile/email
            // For demonstration purposes, we'll return the OTP in the response
            return sendResponse(200, 'OTP sent successfully', ['otp' => $otp]);
        } else {
            return sendResponse(403, 'Email or mobile not found.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $rules = [
            'email_or_mobile' => 'required|string',
            'otp' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $loginType = filter_var($request->email_or_mobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $user = User::where($loginType, $request->email_or_mobile)->where('otp', $request->otp)->first();

        if ($user) {
            $token = $user->createToken('tokens')->plainTextToken;
            $user->update(['otp' => null]); // Clear the OTP after verification

            return sendResponse(200, 'OTP verified successfully', ['user' => new UserResource($user), 'token' => $token]);
        } else {
            return sendResponse(403, 'Invalid OTP.');
        }
    }

    public function loginWithGoogle(Request $request)
    {
        $rules = [
            'name'  => 'required',
            'email' => 'required|email',
            'uid'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return sendResponse(422, "error", $validator->errors()->first());
        }

        $validatedData = $validator->validated();
        $validatedData['uid'] = $request->uid;
        $validatedData['email_verified_at'] = now();
        $validatedData['type_account'] = "gmail";
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['password'] = Str::random(10);

        $user = User::firstOrCreate(['uid' => $request->uid, 'email' => $request->email], $validatedData);
        $token = $user->createToken('tokens')->plainTextToken;

        $data = [
            'user'  => new UserResource($user),
            'token' => $token
        ];

        return sendResponse(200, 'User created successfully', $data);
    }
}
