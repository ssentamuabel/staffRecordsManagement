<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function show($id){
        try{

            $employee = Employee::find($id);

            if (!$employee){
                return response()->json([
                    'status' => false,
                    'message' => "Employee not Found"
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'Employee' => $employee
                ]);
            }

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getAll(){

        try{

            $employees = Employee::all();

            return response()->json([
    
                'status' => true,
                'employees' => $employees
            ]);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'Message' => $th->getMessage()
            ], 500);
        }
       
    }
    //
    public function createEmployee(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                "sur_name" => "required",
                "first_name" => "required",
                'dob' => 'required',
                'gender' => 'required',
                'Married' => 'required',
                'email' => 'required|email|unique:employees,email',
                'nationality' => 'required',
                'nin_number' => 'required'
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' =>"validation Error",
                    'errors' => $validator->errors()
                ], 401);
            }

            // if (is_null($request->other_names)){$request->other_name = "";}

            $employee = Employee::create([
                'sur_name' => $request->sur_name,
                'first_name' => $request->first_name,
                'other_names' => $request->other_names,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'Married' => $request->Married,
                'email' => $request->email,
                'nationality' => $request->nationality,
                'nin_number' => $request->nin_number

            ]);


            return response()->json([
                'statu'=> true,
                'message' => "Employee created successfully",
                'Employee' => $employee

            ]);


        }catch(\Throwable $th){
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }


    public function updateEmployee(Request $request, $id){
        try{

            $validator = Validator::make($request->all(), [
                "sur_name" => "required",
                "first_name" => "required",
                'dob' => 'required',
                'gender' => 'required',
                'Married' => 'required',
                'email' => 'required|email',
                'nationality' => 'required',
                'nin_number' => 'required'
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' =>"validation Error",
                    'errors' => $validator->errors()
                ], 401);
            }

            if (Employee::where('id', $id)->exists()){

                $employee = Employee::find($id);


                $employee->sur_name =  $request->sur_name;
                $employee->first_name = $request->first_name;
                $employee->other_names = $request->other_names;
                $employee->dob = $request->dob;
                $employee->gender = $request->gender;
                $employee->Married = $request->Married;
                $employee->email = $request->email;
                $employee->nationality = $request->nationality ;
                $employee->nin_number = $request->nin_number;  
                $employee->updated_at = now(); 

                $employee->save();
                
                return response()->json([
                    'status' => true,
                    'message' => 'Update was successful',

                ], 200);
                
            }else{
                return response()->json([
                    'status' => false,
                    'message' => "Employee doesnot exist",

                ], 402);
            }

        }catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        try{

            $employee = Employee::find($id);

            if (!$employee){
                return response()->json([
                    'status' => false,
                    'message' => "Employee is not Found"
                ], 400);
            }else{
                
                $employee->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Employee deleted'
                ], 200);
            }

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
