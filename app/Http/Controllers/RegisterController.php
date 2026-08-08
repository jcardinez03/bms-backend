<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = new User;

        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(
            [
                'message' => 'Registered Successfully!'
            ]
        );
    }
}
