<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;
class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
       try {



            // Validate the request data
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                // 'mname' => 'nullable|string|max:255',
                'contactno' => 'nullable | string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:1', // Includes password confirmation
            ]);
            // Check for validation errors
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message'=> $validator->errors()->all()
                ]);
            }

            $cod = User::max('code');
            $code = empty($cod) ? 701 : $cod + 1;

            // Create the user
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'mname' => '',
                'contactno' => $request->contactno,
                'fullname' => ucfirst($request->fname .' '.$request->lname) ,
                'email' => $request->email,
                'password' => Hash::make($request->password), 
                'code' =>  $code ,
                'role_code' => "DEF-USERS",
            ]);

            // Return a success response
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user
            ], 201);
       } catch (\Throwable $th) {
        DB::rollBack();
            return response()->json(['success' => false, "message" =>  $th->getMessage() ]);
       }
    }

}





// register POST
// {
//     "fname" : "TESTFNAME",
//     "lname":"TESTLNAME",
//     "email" : "TEST@gmail.com",
//     "contactno" : "+630908199829292", 
//     "password": "1",
//     "password_confirmation" : "1"
//  }
