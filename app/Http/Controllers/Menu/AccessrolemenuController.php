<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Roleaccessmenu;
use App\Models\Roleaccesssubmenu;
use App\Models\Submenu;
use App\Models\Menu;
use DB;
class AccessrolemenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $description = "Security roles";

    // ORIGINAL CODE
    // public function index(Request $request)
    // {   
    //     $modules = Roleaccessmenu::where('rolecode',Auth::user()->role_code)->get();
    //     $result = [];
    //     for ($m = 0; $m < count($modules); $m++) {
    //         $menus =  Menu::where('id',$modules[$m]->menus_id) ->where('status', 'A')->where('desc_code',$request->desc_code)
    //         ->orderBy('sort') 
    //         ->get();
    //         for($me = 0; $me<count($menus); $me++){

    //             $submodule = Roleaccesssubmenu::where([['rolecode',Auth::user()->role_code],['transNo', $modules[$m]->transNo]])->get();
    //             $sub = [];
    //             for($sb = 0 ; $sb<count($submodule); $sb++){
    //                 $submenus = Submenu::where('id',$submodule[$sb]->submenus_id)
    //                  ->where('status', 'A')
    //                  ->where('desc_code',$request->desc_code)
    //                 ->orderBy('sort')->get();
    //                 for($su=0; $su<count($submenus); $su++){
                     
    //                     $sub[] = [
    //                         "description" =>$submenus[$su]->description ,
    //                         "icon" => $submenus[$su]->icon,
    //                         "route" => $submenus[$su]->routes,
    //                         "sort" => $submenus[$su]->sort
    //                     ];
    //                 }
    //             }
    //             $result[] =[
    //                 "description" => $menus[$me]->description,
    //                 "icon" => $menus[$me]->icon,
    //                 "route" => $menus[$me]->routes,
    //                 "sort" =>  $menus[$me]->sort,
    //                 "submenus" => $sub 
    //             ]  ;

    //         }
    //     }
    //     return response()->json($result);
    // }


   // REVISED CODE
    public function index(Request $request)
    {
        // Get all the role access menus
        $modules = Roleaccessmenu::where('rolecode', Auth::user()->role_code)->get();

        // Initialize an empty result array
        $result = [];

        // Loop through each module using for loop
        for ($m = 0; $m < count($modules); $m++) {
            // Get menus associated with this module, ordered by 'sort'
            $menus = Menu::where('id', $modules[$m]->menus_id)
                ->where('status', 'A')
                ->where('desc_code', $request->desc_code)
                ->orderBy('sort')
                ->get();

            // Loop through each menu using for loop
            for ($me = 0; $me < count($menus); $me++) {
                // Get submodules associated with the current menu
                $submodule = Roleaccesssubmenu::where([
                    ['rolecode', Auth::user()->role_code],
                    ['transNo', $modules[$m]->transNo]
                ])->get();

                // Initialize an empty submenus array
                $sub = [];

                // Loop through submodules using for loop
                for ($sb = 0; $sb < count($submodule); $sb++) {
                    // Get submenus for this submodule, ordered by 'sort'
                    $submenus = Submenu::where('id', $submodule[$sb]->submenus_id)
                        ->where('status', 'A')
                        ->where('desc_code', $request->desc_code)
                        ->orderBy('sort')
                        ->get();

                    // Add submenus to the $sub array
                    for ($su = 0; $su < count($submenus); $su++) {
                        $sub[] = [
                            "description" => $submenus[$su]->description,
                            "icon" => $submenus[$su]->icon,
                            "route" => $submenus[$su]->routes,
                            "sort" => $submenus[$su]->sort
                        ];
                    }
                }

                // Add the menu and its submenus to the result array
                $result[] = [
                    "description" => $menus[$me]->description,
                    "icon" => $menus[$me]->icon,
                    "route" => $menus[$me]->routes,
                    "sort" => $menus[$me]->sort,
                    "submenus" => $sub
                ];
            }
        }

        // Sort the result array by 'sort' value
        usort($result, function($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });

        // Return the result as a JSON response
        return response()->json($result);
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
        try {
            DB::beginTransaction();
        
            $data = $request->all();
            

            foreach ($data as $header) {
                $trans = Roleaccessmenu::max('transNo');
                $transNo = empty($trans) ? 1 : $trans + 1;    
                // Validate header data
                $head = Validator::make($header, [
                    'rolecode' => 'required|string',
                    'menus_id' => 'required|numeric'
                ]);
        
                if ($head->fails()) {
                    // Return validation errors and rollback
                    return response()->json([
                        'success' => false,
                        'message' => $head->errors()
                    ], 422); 
                }
        
                // Insert header data
                Roleaccessmenu::insert([
                    "rolecode" => $header['rolecode'],
                    "transNo" => $transNo,
                    "menus_id" => $header['menus_id'],
                    "created_by" => Auth::user()->fullname,
                    "updated_by" => Auth::user()->fullname
                ]);
        
                // Check if `lines` exists, is an array, and contains at least one valid `submenus_id`
                if (!empty($header['lines']) && is_array($header['lines'])) {
                    foreach ($header['lines'] as $line) {
                        // Only process lines if `submenus_id` is present
                        if (!empty($line['submenus_id'])) {
                            // Ensure `rolecode` matches `header['rolecode']` if `rolecode` is missing in the line
                            $line['rolecode'] = $line['rolecode'] ?? $header['rolecode'];
        
                            // Validate line data
                            $l = Validator::make($line, [
                                "submenus_id" => 'required|numeric'
                            ]);
        
                            if ($l->fails()) {
                                // Return validation errors and rollback
                                DB::rollBack();
                                return response()->json([
                                    'success' => false,
                                    'message' => $l->errors()
                                ], 422);
                            }
        
                            // Insert line data
                            Roleaccesssubmenu::insert([
                                "rolecode" => $line['rolecode'],
                                "transNo" => $transNo,
                                "submenus_id" => $line['submenus_id'],
                                "created_by" => Auth::user()->fullname,
                                "updated_by" => Auth::user()->fullname
                            ]);
                        }
                    }
                }
            }       
                    
            // Commit transaction if all inserts succeed
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data inserted successfully']);
            
        } catch (\Throwable $th) {
            // Rollback transaction on error
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


// accessmenu.index GET 
// {
//     "desc_code" : "tnavigation_token"
// }

// accessmenu.store POST
// [
//     {
//         "rolecode": "DEF-MASTERADMIN",
//         "menus_id": 1,
//         "lines": [
//             {
//                 "rolecode": "DEF-MASTERADMIN" ,
//                 "submenus_id": 1
//             },
//             {
//                 "rolecode": "DEF-MASTERADMIN",
//                 "submenus_id": 2
//             },
//                         {
//                 "rolecode": "DEF-MASTERADMIN",
//                 "submenus_id": 3
//             }
//         ]
//     },
//     {
//         "rolecode": "DEF-MASTERADMIN",
//         "menus_id": 2,
//         "lines": []
//     }
// ]