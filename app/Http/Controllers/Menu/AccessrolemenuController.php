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
class AccessrolemenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $description = "Security roles";

    public function index(Request $request)
    {   
        $modules = Roleaccessmenu::where('rolecode',Auth::user()->role_code)->get();
        $result = [];
        for ($m = 0; $m < count($modules); $m++) {
            $menus =  Menu::where('id',$modules[$m]->menus_id) ->where('status', 'A')->where('desc_code',$request->desc_code)
            ->orderBy('sort') 
            ->get();
            for($me = 0; $me<count($menus); $me++){

                $submodule = Roleaccesssubmenu::where([['rolecode',Auth::user()->role_code],['transNo', $modules[$m]->transNo]])->get();
                $sub = [];
                for($sb = 0 ; $sb<count($submodule); $sb++){
                    $submenus = Submenu::where('id',$submodule[$sb]->submenus_id)
                     ->where('status', 'A')
                     ->where('desc_code',$request->desc_code)
                    ->orderBy('sort')->get();
                    for($su=0; $su<count($submenus); $su++){
                     
                        $sub[] = [
                            "description" =>$submenus[$su]->description ,
                            "icon" => $submenus[$su]->icon,
                            "route" => $submenus[$su]->routes,
                            "sort" => $submenus[$su]->sort
                        ];
                    }
                }
                $result[] =[
                    "description" => $menus[$me]->description,
                    "icon" => $menus[$me]->icon,
                    "route" => $menus[$me]->routes,
                    "sort" =>  $menus[$me]->sort,
                    "submenus" => $sub 
                ]  ;

            }
        }
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

      // DB::beginTransaction();
        // $data = $request->all();


        // foreach($data as $header){

        //     $head = Validator::make($header, [
        //         'rolecode' => 'required|string',
        //         'menus_id' => 'required|numeric'
        //     ]);

        //     if ($head->fails()) {
        //         return response()->json([
        //             'success' => false,  // Indicate failure
        //             'message' => $head->errors()  // Return validation errors
        //         ], 422); 
        //     }

        //     foreach($header['lines'] as $line){
        //         $l = Validator::make($line, [
        //             "rolecode" => 'required|string',
        //         ])
        //     }

        // }

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
