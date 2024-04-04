<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HobbyController extends Controller
{
    //
    public function store(Request $request, $id){
        try{

            $employee = Employee::findOrFail($id);



            $validator = Validator::make($request->all(), [
                
                'contact' => 'required',
                'type' => 'required'

            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => "validation error",
                    'errors' => $validator->errors()
                ], 401);
            }
            

            $contact = Contact::create([
                'employee_id' => $employee->id,
                'contact' => $request->contact,
                'type' => $request->type,
                
            ]);

            $employee->contacts()->save($contact);

        
            return response()->json([
                'status' => true,
                'message' => "Contact created successfully",

            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'Message' => $th->getMessage()
            ], 500);
        }
    }
}
