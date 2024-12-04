<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Resource;
use App\Models\Usercapabilitie;
use App\Models\Usereducation;
use App\Models\Userprofile;
use DB;

use Illuminate\Support\Facades\File; 


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Resource::where('code',Auth::user()->code)->get();
            $result = [];

            for($i = 0 ; $i < count($user); $i++){
                $result [] = [
                    "fullname" => $user[$i]->fullname,
                    "fname" => $user[$i]->fname,
                    "lname" => $user[$i]->lname,
                    "code" => $user[$i]->code,
                    "contact_no" => $user[$i]->contact_no,
                    "profession" => $user[$i]->profession,
                    "industry" => $user[$i]->industry,
                    "companywebsite" =>  $user[$i]->companywebsite
                ];
            }         
            return response()->json(['success' => true,'message' => $result]);
        } 
        else {
            return response()->json(['success'=>false,'message' => 'User is not authenticated']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Check if the user is authenticated
         if (Auth::check()) {



             // Begin Transaction
            
     
             try {

                DB::beginTransaction();
                $exist = UserProfile::where('code', Auth::user()->code)->exists();
                if ($exist) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'You already created your profile. You can\'t add another, but you can update it.']);
                }
                 $data = $request->all();
     
                 // Validate the request data for the user profile
                 $validator = Validator::make($data, [
                     'photo_pic' => 'nullable|file|image|max:2048', // Validate file upload
                     'contact_no' => 'nullable|string|max:255',
                     'contact_visibility' => 'nullable|integer',
                     'email_visibility' => 'nullable|integer',
                     'date_birth' => 'nullable|date',
                     'home_country' => 'nullable|string|max:255',
                     'current_location' => 'nullable|string|max:255',
                 ]);
     
                 // Check for validation errors
                 if ($validator->fails()) {
                     return response()->json([
                         'success' => false,
                         'message' => $validator->errors()->all(),
                     ]);
                 }
     
                 
                 $userCode = Auth::user()->code;
     
                 // Handle the photo_pic file upload if it exists
                 $photoPath = null;
                 if ($request->hasFile('photo_pic')) {
                     $file = $request->file('photo_pic');
     
                     // Define the folder path based on the user's code
                     $folderPath = "uploads/{$userCode}/cvphoto";
     
                     // Store the file and get the stored path
                     $photoPath = $file->store($folderPath, 'public');
                 }
     
                 // Get the new transaction number
                 $transNo = UserProfile::max('transNo');
                 $newtrans = empty($transNo) ? 1 : $transNo + 1;
     
                 // Create the User Profile
                 $userProfile = UserProfile::create([
                     'code' => $userCode,
                     'transNo' => $newtrans,
                     'photo_pic' => $photoPath, // Save the file path
                     'contact_no' => $data['contact_no'],
                     'contact_visibility' => $data['contact_visibility'],
                     'email' => Auth::user()->email,
                     'email_visibility' => $data['email_visibility'],
                     'date_birth' => $data['date_birth'],
                     'home_country' => $data['home_country'],
                     'current_location' => $data['current_location'],
                 ]);
     
                 // Validate and insert capabilities (languages and skills)
                 if (isset($data['lines']['capability'])) {
                     foreach ($data['lines']['capability'] as $capability) {
                         Usercapabilitie::create([
                             'code' => $userCode,
                             'transNo' => $newtrans,
                             'language' => $capability['language'],
                             'skills' => $capability['skills'],
                         ]);
                     }
                 }
     
                 // Validate and insert education data
                 if (isset($data['lines']['education'])) {
                     foreach ($data['lines']['education'] as $education) {
                         Usereducation::create([
                             'code' => $userCode,
                             'transNo' => $newtrans,
                             'highest_education' => $education['highest_education'],
                             'school_name' => $education['school_name'],
                             'year_entry' => $education['year_entry'],
                             'year_end' => $education['year_end'],
                             'status' => $education['status'],
                         ]);
                     }
                 }
     
                 // Update resource data
                 Resource::where('code', $userCode)
                     ->update([
                         'date_birth' => $data['date_birth'],
                         'home_country' => $data['home_country'],
                         'current_location' => $data['current_location'],
                     ]);
     
                 // Commit the transaction if everything is successful
                 DB::commit();
     
                 // Return success response
                 return response()->json([
                     'success' => true,
                     'message' => 'Profile and related information saved successfully.',
                 ]);
             } catch (\Throwable $th) {
                 // Rollback transaction on error
                 DB::rollBack();
     
                 // Return error response
                 return response()->json([
                     'success' => false,
                     'message' => 'Error occurred: ' . $th->getMessage(),
                 ], 500);
             }
         }
     }
     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        return view('testuploads');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

              // Resource::where('code',Auth::user()->code)
                //     ->update([
                //         'date_birth' => 
                //         'home_country'=>
                //         'current_location' => 
                //     ]);


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


//    *** STORE ***
// {
//     "photo_pic": "profile.jpg",
//     "contact_no": "+1234567890",
//     "contact_visibility": true,
//     "email_visibility": false,
//     "date_birth": "1990-01-01",
//     "home_country": "United States",
//     "current_location": "New York",
//     "lines": {
//       "capability": [
//         {
//           "language": "English",
//           "skills": "Programming"
//         },
//         {
//           "language": "Spanish",
//           "skills": "Translation"
//         }
//       ],
//       "education": [
//         {
//           "highest_education": "Bachelor's Degree",
//           "school_name": "Harvard University",
//           "year_entry": 2010,
//           "year_end": 2014,
//           "status": "Graduated"
//         },
//         {
//           "highest_education": "Master's Degree",
//           "school_name": "MIT",
//           "year_entry": 2015,
//           "year_end": 2017,
//           "status": "Graduated"
//         }
//       ]
//     }
//   }