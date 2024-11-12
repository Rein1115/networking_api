<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Forgetpassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetpasswordController extends Controller
{
    public function forgetpassword(Request $request)
    {
        // Retrieve the user
        $exsists = User::where('email', $request->email)->count();
        if ($exsists > 0) {
            $retrieve = User::where('email', $request->email)->select('fullname', 'password')->first();
            $data = [
                'fullname' => $retrieve->fullname,
                'password' => $retrieve->password
            ];
            Mail::to($request->email)->send(new Forgetpassword($data));
            return response()->json(['message' => 'Password reset email sent.']);
        } else {
            return response()->json(['message' => 'User not found.']);
        }
    }

}

