<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }

    public function updatePassword(Request $request)
    {
        $rules['old_password'] = 'required';
        $rules['new_password'] = 'required|string|min:8';
        $rules['confirm_new_password'] = 'required|same:new_password';

        $attributeNames['old_password'] = 'Old Password';
        $attributeNames['new_password'] = 'New Password';
        $attributeNames['confirm_new_password'] = 'Confirm New Password';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->after(function ($validator) use ($request) {
            if (!Hash::check($request['old_password'], Auth::user()->password)) {
                $validator->errors()->add('old_password', 'Old passowrd is not correct');
            }
        });
        $validator->validate();

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('success', 'Passwrod Change Successfully.');
        return redirect()->back();
    }
}
