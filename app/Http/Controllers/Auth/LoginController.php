<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }
    
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            $user = Auth::user();
    
            // Check if the user's status is "I" (inactive)
            if ($user->status === 'I') {
                // Log out the user
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => "Your account is inactive."
                ]);
            }
    
            // If the account is active, create a token
            $token = $user->createToken('Personal Access Token')->plainTextToken;
    
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ]);
        }
        return response()->json(['success' => false, 'message' => 'The email or password is incorrect. Please check your credentials.']);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();
    
        return response()->json(['success' => true , 'message' => 'You have been logged out successfully.']);
    }

}


// login POST
// {
//     "email" : "TEST@gmail.com", 
//     "password": "1",
// }