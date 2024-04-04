<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Leaves;
use App\Models\Employee;

class LeavesController extends Controller
{
    //
    public function store(Request $request, $id){
        try{

            $employee = Employee::findOrFail($id);



            $validator = Validator::make($request->all(), [
                
                'leave_date' => 'required',
                'return_date' => 'required',
                'status' => 'required',
                'year' => 'required',
               
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }
            

            $leave = Leaves::create([
                'employee_id' => $employee->id,              
                'leave_date' => $request->leave_date,
                'return_date' =>$request->return_date,
                'status' => $request->status,
                'year' => $request->year,
                
            ]);

            $employee->leaves()->save($leave);

        
            return response()->json([
                'status' => true,
                'message' => "Leave created successfully",

            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'Message' => $th->getMessage()
            ], 500);
        }
    }
    public function index(){
        try{

            $leaves = Leaves::with('employee')->get();

            return response()->json([
                'status'=> true,
                'leaves' => $leaves

            ]);



        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }        
    }


    public function update(Request $request, $id){
        try{


            $validator = Validator::make($request->all(), [
                
                'leave_date' => 'required',
                'return_date' => 'required',
                'status' => 'required',
                'year' => 'required',
               
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }

            if (Leaves::where('id', $id)->exists()){

                $leave = Leaves::find($id);

                $leave->leave_date = $request->leave_date;
                $leave->return_date = $request->return_date;
                $leave->status = $request->status;                
                $leave->year = $request->year;

                $leave->update();

                return response()->json([
                    'status' => true,
                    'message' => 'Update Successful'
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Leave Doesnot exist'
                ], 401);
            }


        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getLeaves($id){
        try{

            $employee = Employee::findOrFail($id);

            $leaves = $employee->leaves;

       
            return response()->json([
                'status' => true,
                'leaves' => $leaves
            ]);             
                
        

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

}
