<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Clientregister;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientregisterController extends Controller
{
    //
    public function clientRegister(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Validation
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'contactno' => 'nullable|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->all()
                ], 422);
            }

           

            

            // Attempt to send email
            try {
                DB::commit();
                    // Generate user code
                $cod = User::max('code');
                $code = empty($cod) ? 701 : $cod + 1;

                // Create user
                $user = User::create([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => '',
                    'contactno' => $request->contactno,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'code' => $code,
                    'role_code' => "DEF-CLIENT",
                ]);
                $data = [
                    'fname' => $request->fname,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'email' => $request->email,
                ];
                Mail::to($request->email)->send(new Clientregister($data));
                
                return response()->json([
                    'success' => true,
                    'message' => 'Registered successfully. Please check your email and click the sign-in link to activate your account.',
                ]);
            } catch (\Exception $emailException) {

                DB::rollback();
                // Log the email error and proceed
                return response()->json([
                    'success' => true,
                    'message' => $emailException->getMessage(),
                ]);
            }

         

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
}


