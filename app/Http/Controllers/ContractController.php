<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use App\Models\Employee;

class ContractController extends Controller
{
    //



    public function store(Request $request, $id)
    {
        try{

            $employee = Employee::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'issue_date' => 'required',
                'anual_leave_days' => 'required',
                'running' => 'required'
            ]);


            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }

            $contract = Contract::create([
                'employee_id' => $employee->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'issue_date' => $request->issue_date,
                'anual_leave_days' => $request->anual_leave_days,
                'running' => $request->running
            ]);

            $employee->contracts()->save($contract);


            return response()->json([
                'status' => true,
                'message' => 'Contract  saved successfully'
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

            $contracts = Contract::with('employee')->get();

            return response()->json([
                'status'=> true,
                'contracts' => $contracts

            ]);



        }catch(\Throwable $th){
            return response()->json([
                'status' => true,
                'message' => $th->getMessage()
            ]);
        }

        
    }

    public function update(Request $request, $id){
        try{

            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'issue_date' => 'required',
                'anual_leave_days' => 'required',
                'running' => 'required'
            ]);


            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' =>"validation Error",
                    'errors' => $validator->errors()
                ], 401);
            }

            if (Contract::where('id', $id)->exists()){

                $contract = Contract::find($id);


                $contract->start_date = $request->start_date;
                $contract->end_date = $request->end_date;
                $contract->issue_date = $request->issue_date;
                $contract->anual_leave_days = $request->anual_leave_days;
                $contract->running = $request->running;
                

                $contract->update();

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

    public function getContracts($id){
        try{

            $employee = Employee::findOrFail($id);

            $contracts = $employee->contracts;

       
            return response()->json([
                'status' => true,
                'contracts' => $contracts
            ]);             
                
        

        }catch(\Throwable $th){
            return response()->json([
                'status' => true,
                'message' => $th->getMessage()
            ]);
        }
    }

    
}
