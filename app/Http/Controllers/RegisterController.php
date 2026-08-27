<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessUser;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'business_name' => 'required',
            'business_type' => 'required',
            'plan_id' => 'required'
        ]);

        $user = new User;
        $business = new Business;

        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $business->name = $request->business_name;
        $business->plan_id = $request->plan_id;
        $business->business_type_id = $request->business_type;
        $business->save();

        $businessUser = new BusinessUser;
        $businessUser->business_id = $business->id;
        $businessUser->user_id = $user->id;
        $businessUser->save();

        return response()->json(
            [
                'message' => 'Registered Successfully!'
            ]
        );
    }
}
