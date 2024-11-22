<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Resource;
use App\Mail\Registeractivation;
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
                'password' => 'required|string|confirmed|min:1',
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
                'company' => $request->company,
                'code' =>  $code ,
                'role_code' => $request->code == 0 ? 'DEF-USERS' : 'DEF-CLIENTS',
            ]);
            

            // $request->code === 0 def-users  else 'def-clients'

            $resource = Resource::create([
                'code' => $code,                
                'fname' => $request->fname,
                'lname' => $request->lname,         
                'mname' => '',            
                'fullname' => ucfirst($request->fname .' '.$request->lname) ,
                'contact_no' =>  $request->contactno,    
                'age' =>  $request->age,                   
                'email' => $request->email, 
                'profession' => $request->profession,     
                'company' => $request->company,       
                'industry' => $request->industry,     
                'companywebsite' => $request->companywebsite, 
                'role_code' => $request->statuscode == 0 ? 'DEF-USERS' : 'DEF-CLIENTS',     
            ]);
            $data = [
                        'fname' => $request->fname,
                        'email' => $request->email,
                    ];
              $emailSent = Mail::to($request->email)->send(new Registeractivation($data));

            if (!$emailSent) {
            
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send the activation email. Please try again later.'
                ]);
            }

            // Return a success response
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "You're registered successfully. Please visit your Gmail to activate your account.",
                // 'data' => $user
            ], 201);
       } catch (\Throwable $th) {
        DB::rollBack();
            return response()->json(['success' => false, "message" =>  $th->getMessage() ]);
       }
    }

}

// try {
//     // Validate the request data
//     DB::beginTransaction(); // Start transaction to handle both user and resource inserts
    
//     $validator = Validator::make($request->all(), [
//         'fname' => 'required|string|max:255',
//         'lname' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|confirmed|min:1',
//     ]);

//     // Check for validation errors
//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message'=> $validator->errors()->all()
//         ]);
//     }

 
//     $cod = User::max('code');
//     $code = empty($cod) ? 701 : $cod + 1;


//     $user = User::create([
//         'fname' => $request->fname,
//         'lname' => $request->lname,
//         'mname' => '',
//         'contactno' => $request->contactno,
//         'fullname' => ucfirst($request->fname .' '.$request->lname),
//         'email' => $request->email,
//         'password' => Hash::make($request->password), 
//         'company' => $request->company,
//         'code' =>  $code ,
//         'role_code' => $request->code == 0 ? 'DEF-USERS' : 'DEF-CLIENTS',
//     ]);


//     $resource = Resource::create([
//         'code' => $code,
//         'fname' => $request->fname,
//         'lname' => $request->lname,
//         'mname' => '',
//         'fullname' => ucfirst($request->fname .' '.$request->lname),
//         'contact_no' => $request->contactno,
//         'age' => $request->age,
//         'email' => $request->email,
//         'profession' => $request->profession,
//         'company' => $request->company,
//         'industry' => $request->industry,
//         'companywebsite' => $request->companywebsite,
//         'role_code' => $request->statuscode == 0 ? 'DEF-USERS' : 'DEF-CLIENTS',
//     ]);
//     $data = [
//         'fname' => $request->fname,
//         'email' => $request->email,
//     ];

//     $emailSent = Mail::to($request->email)->send(new Registeractivation($data));

//     if (!$emailSent) {
     
//         DB::rollBack();
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to send the activation email. Please try again later.'
//         ]);
//     }

//     // Commit the transaction if everything is successful
//     DB::commit();

//     // Return success response
//     return response()->json([
//         'success' => true,
//         'message' => 'Registered successfully, activation email sent.',
//         // 'data' => $user
//     ], 201);

// } catch (\Throwable $th) {
//     // Rollback the transaction if there's an exception
//     DB::rollBack();
//     return response()->json([
//         'success' => false,
//         'message' => $th->getMessage()
//     ]);
// }




// register POST

// DEF-USERS
// {
//     "fname": "rein june",
//     "lname": "ediral",
//     "contactno": "1234567890",
//     "email": "reinjunelaride34@gmail.com",
//     "password": "123123123",
//     "password_confirmation": "123123123",
//     "age": 25,
//     "profession": "Developer",
//     "statuscode": 0
// }

// DEF-CLIENTS
// {
//     "fname": "John", //FIRSTNAME
//     "lname": "Doe", //LNAME
//     "contactno": "1234567890", //CONTACT NO
//     "email": "john.doe@example.com", //EMAIL
//     "password": "password123", //PASSWORD
//     "password_confirmation": "password123", //PASSWORD
//     "company": "ABC Corp.", //COMPANY
//     "industry": "Technology", //INDUSTRY
//     "companywebsite": "https://www.abccorp.com", //COMPANY WEBSITE
//     "statuscode": 1
// }


