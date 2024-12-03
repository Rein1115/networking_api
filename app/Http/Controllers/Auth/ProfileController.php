<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Resource;
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
        //
        return Auth::user()->code;
        // if (Auth::check()) {
            try {
                // Begin Transaction
                DB::beginTransaction();

                // Validate the request data
                $validator = Validator::make($request->all(), [
                    'fname' => 'required|string|max:255',
                    'lname' => 'required|string|max:255',
                    'contactno' => 'nullable|string|max:15',
                    'password' => 'nullable|string|confirmed|min:8',
                    'industry' => 'nullable|string|max:255',
                    'designation' => 'nullable|string|max:255',
                    'age' => 'nullable|integer|min:1|max:150',
                    'profession' => 'nullable|string|max:255',
                    'profile_picture' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                    'resumepdf' => 'nullable|file|mimes:pdf|max:4096',
                ]);

                // Check for validation errors
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->all(),
                    ]);
                }

                // Find the authenticated user
                $user = User::where('code', Auth::user()->code)->firstOrFail();

                // Handle the Profile Picture Upload
                $profilePicturePath = null;
                if ($request->hasFile('profile_picture')) {
                    $profilePicture = $request->file('profile_picture');
                    $profilePicturePath = $profilePicture->storeAs(
                        'public/uploads/' . Auth::user()->code . '/profilepicture', // Separate folder for profile pictures
                        'profile_picture.' . $profilePicture->getClientOriginalExtension()
                    );
                }

                // Handle the Resume PDF Upload
                $resumePdfPath = null;
                if ($request->hasFile('resumepdf')) {
                    $resumePdf = $request->file('resumepdf');
                    $resumePdfPath = $resumePdf->storeAs(
                        'public/uploads/' . Auth::user()->code . '/resume', // Separate folder for resume PDFs
                        'resume.' . $resumePdf->getClientOriginalExtension()
                    );
                }

                // Update User Data
                $user->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => $request->mname,
                    'contactno' => $request->contactno,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'company' => $request->company,
                ]);

                // Update Resource Data
                $resource = Resource::where('code', Auth::user()->code)->firstOrFail();
                $resource->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => $request->mname,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'contact_no' => $request->contactno,
                    'age' => $request->age,
                    'profession' => $request->profession,
                    'profile_picture' => $profilePicturePath,
                    'resumepdf' => $resumePdfPath,
                ]);

                // Commit Transaction
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => "Information updated successfully.",
                ], 200);
            } catch (\Throwable $th) {
                // Rollback transaction on error
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => $th->getMessage(),
                ], 500);
            }
        // }
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

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            try {
                // Begin Transaction
                DB::beginTransaction();

                // Validate the request data
                $validator = Validator::make($request->all(), [
                    'fname' => 'required|string|max:255',
                    'lname' => 'required|string|max:255',
                    'contactno' => 'nullable|string|max:15',
                    'password' => 'nullable|string|confirmed|min:8',
                    'industry' => 'nullable|string|max:255',
                    'designation' => 'nullable|string|max:255',
                    'age' => 'nullable|integer|min:1|max:150',
                    'profession' => 'nullable|string|max:255',
                    'profile_picture' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                    'resumepdf' => 'nullable|file|mimes:pdf|max:4096',
                ]);

                // Check for validation errors
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->all(),
                    ]);
                }

                // Find the authenticated user
                $user = User::where('code', Auth::user()->code)->firstOrFail();

                // Handle the Profile Picture Upload
                $profilePicturePath = null;
                if ($request->hasFile('profile_picture')) {
                    $profilePicture = $request->file('profile_picture');
                    $profilePicturePath = $profilePicture->storeAs(
                        'public/uploads/' . Auth::user()->code . '/profilepicture', // Separate folder for profile pictures
                        'profile_picture.' . $profilePicture->getClientOriginalExtension()
                    );
                }

                // Handle the Resume PDF Upload
                $resumePdfPath = null;
                if ($request->hasFile('resumepdf')) {
                    $resumePdf = $request->file('resumepdf');
                    $resumePdfPath = $resumePdf->storeAs(
                        'public/uploads/' . Auth::user()->code . '/resume', // Separate folder for resume PDFs
                        'resume.' . $resumePdf->getClientOriginalExtension()
                    );
                }

                // Update User Data
                $user->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => $request->mname,
                    'contactno' => $request->contactno,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'company' => $request->company,
                ]);

                // Update Resource Data
                $resource = Resource::where('code', Auth::user()->code)->firstOrFail();
                $resource->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => $request->mname,
                    'fullname' => ucfirst($request->fname . ' ' . $request->lname),
                    'contact_no' => $request->contactno,
                    'age' => $request->age,
                    'profession' => $request->profession,
                    'profile_picture' => $profilePicturePath,
                    'resumepdf' => $resumePdfPath,
                ]);

                // Commit Transaction
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => "Information updated successfully.",
                ], 200);
            } catch (\Throwable $th) {
                // Rollback transaction on error
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
