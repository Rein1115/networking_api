<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Forgetpassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ForgetpasswordController extends Controller
{
    public function forgetpassword(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }
        

        $user = User::where('email', $request->email)->firstOrFail();
        $token = Str::random(60);
        
    
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        

        $data = [
            'fullname' => $user->fullname,
            'token' => $token,
            'expiration' => 60 
        ];
       
        try {
            Mail::to($user->email)->send(new Forgetpassword($data));
            return response()->json(['success' => true, 'message' => 'Password reset email sent.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send password reset email. Please try again later.'
            ], 500);
        }

    }

    public function resetpassword(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required|string', 
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed',
            ]);
            
            if ($validator->fails()) {
                
                return response()->json([
                    'errors' => $validator->errors(),
                ]);
            }

        
            $token = DB::select('SELECT created_at FROM password_reset_tokens WHERE token = ?', [$request->token]);

            if ($token) {
   
                $createdAt = Carbon::parse($token[0]->created_at);
                $now = Carbon::now();
            
                if ($createdAt->diffInSeconds($now) > 60) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token has expired. Please request a new one.'
                    ]);
                }   
                DB::commit();
                DB::update('UPDATE users SET password = ? WHERE email = ?', [Hash::make($request->password), $request->email]);
                return response()->json([
                    'success' => true,
                    'message' => 'Password changed successfully.'
                ]);
            } else {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token.'
                ]);
            }            
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['success' => false, "message" => $th->getMessage()]);
        }



        


        

    }



   
}
