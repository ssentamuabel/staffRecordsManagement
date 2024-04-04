<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NextOfKin;
use App\Models\Employee;

class NextOfKinController extends Controller
{
    //
    public function store(Request $request, $id){
        try{

            $employee = Employee::findOrFail($id);



            $validator = Validator::make($request->all(), [                
                
                'name' => 'required',
                'contact' => 'required',
                'relationship' => 'required'
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }
            

            $nextofkin = NextOfKin::create([
                'employee_id' => $employee->id,
                'name' => $request->name,
                'contact' => $request->contact,
                'relationship' => $request->relationship
                
            ]);

            
            $nextofkin->save();

        
            return response()->json([
                'status' => true,
                'message' => "Kin created  successfully",

            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'Message' => $th->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id){
        try{


            $validator = Validator::make($request->all(), [                
                
                'name' => 'required',
                'contact' => 'required',
                'relationship' => 'required'
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }

            if (NextOfKin::where('id', $id)->exists()){

                $kin = NextOfKin::find($id);

                $kin->name = $request->name;
                $kin->contact = $request->contact;
                $kin->relationship = $request->relationship;
                

                $kin->update();

                return response()->json([
                    'status' => true,
                    'message' => 'Update Successful'
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Contact Doesnot exist'
                ], 401);
            }


        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function index(){


        try{

            $kins = NextOfKin::with('employee')->get();

            return response()->json([
                'status'=> true,
                'Next Of Kins' => $kins

            ]);



        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }

        
    }

    public function getKins($id){
        try{

            $employee = Employee::findOrFail($id);

            $kins = $employee->next_of_kins;

            $value = count($kins);
       
            return response()->json([
                'status' => true,
                'kins' => $kins,
                
            ]);             
                
        

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

}
