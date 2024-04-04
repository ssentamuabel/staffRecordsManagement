<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Referees;
use App\Models\Employee;

class RefereesController extends Controller
{
    //
    public function store(Request $request, $id){
        try{

            $employee = Employee::findOrFail($id);



            $validator = Validator::make($request->all(), [
                
                'names' => 'required',
                'proffession' => 'required',
                'position_of_influence' => 'required',
                'contact' => 'required'

            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }
            

            $referees = Referees::create([
                'employee_id' => $employee->id,
                'names' => $request->names,
                'title' => $request->proffession,
                'relation' => $request->position_of_influence,
                'contact' => $request->contact,
                
                
            ]);

            $employee->referees()->save($referees);

        
            return response()->json([
                'status' => true,
                'message' => "Referee created successfully",

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
                
                'names' => 'required',
                'proffession' => 'required',
                'position_of_influence' => 'required',
                'contact' => 'required'

            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }


            if (Referees::where('id', $id)->exists()){

                $referee = Referees::find($id);

                $referee->names = $request->names;
                $referee->title = $request->proffession;
                $referee->relation = $request->position_of_influence;
                $referee->contact = $request->contact;

                $referee->update();

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

            $referees = Referees::with('employee')->get();

            return response()->json([
                'status'=> true,
                'referees' => $referees

            ]);



        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }

        
    }

    public function getReferees($id){
        try{

            $employee = Employee::findOrFail($id);

            $referees = $employee->referees;

       
            return response()->json([
                'status' => true,
                'referees' => $referees
            ]);             
                
        

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
