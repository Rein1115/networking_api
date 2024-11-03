<?php

namespace App\Http\Controllers\Menus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth; 

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $menu = Menu::all();

        $result = [];

            for($m = 0; $m<count($menu); $m++){


                $submenu = Submenu::where('transNo', $menu[$m]->transNo)->get();   
                $sub = [];
                for($su = 0; $su<count($submenu); $su++){

                    $sub[$su] = [
                        "description" => $submenu[$su]->description,
                        "icon" => $submenu[$su]->icon,
                        "route" => $submenu[$su]->route,
                        "sort" => $submenu[$su]->sort
                    ];
                }

                $result[$m] = [
                    "description" => $menu[$m]->description,
                    "icon" => $menu[$m]->icon,
                    "route" => $menu[$m]->route,
                    "sort" => $menu[$m]->sort,
                    "submenu" => $sub
                ];
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

        try {
            DB::beginTransaction();
            $data = $request->all();
            $header = Validator::make($data, [
                'description' => 'required|string',
                'icon' => 'required|string',
                'class' => 'required|string',
                'routes' => 'required|string',
                'sort' => 'required|integer'
            ]);
            
            if ($header->fails()) {
                return response()->json([
                    'success' => false,  // Indicate failure
                    'message' => $header->errors()  // Return validation errors
                ], 422); 
            }

            $trans = Menu::max('transNo');
            $transNo = empty($trans) ? 1 : $trans + 1;

            Menu::insert([
                "transNo" => $transNo,
                "description" => $data['description'],
                'icon' =>$data['icon'],
                'class'=>$data['class'],
                'routes' =>$data['routes'],
                'sort' =>$data['sort'],
                // 'created_by',
                // 'updated_by'
            ]);

            foreach($data['lines'] as $line){
                $lineValidator = Validator::make($line, [
                    'description' => 'required|string',
                    'icon' => 'required|string',
                    'class' => 'required|string',
                    'routes' => 'required|string',
                    'sort' => 'required|integer',
                ]);

            
                if ($lineValidator->fails()) {
                    $lineErrors[$index] = $lineValidator->errors();
                }

                Submenu::insert([
                    "transNo" => $transNo,
                    "description" => $line['description'],
                    'icon' =>$line['icon'],
                    'class'=>$line['class'],
                    'routes' =>$line['routes'],
                    'sort' =>$line['sort'],
                    // 'created_by',
                    // 'updated_by',
                ]);
            }
                    // Commit the transaction
                    DB::commit();

                    // Return response
                    return response()->json([
                        'success' => true,
                        'message' => 'Menu and submenus created successfully',
                    ]);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success'=>false,'message' => $th->getMessage()  ]);
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
