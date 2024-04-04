<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Employee;

class ContactController extends Controller
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


    public function index(){


        try{

            $contacts = Contact::with('employee')->get();

            return response()->json([
                'status'=> true,
                'contacts' => $contacts

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
                
                'contact' => 'required',
                'type' => 'required'

            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' =>"validation Error",
                    'errors' => $validator->errors()
                ], 401);
            }

            if (Contact::where('id', $id)->exists()){

                $contact = Contact::find($id);

                $contact->contact = $request->contact;
                $contact->type = $request->type;

                $contact->update();

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
                'status' => true,
                'message' => $th->getMessage()
            ]);
        }
    }


    public function getContacts($id){
        try{

            $employee = Employee::findOrFail($id);

            $contacts = $employee->contacts;

       
            return response()->json([
                'status' => true,
                'contacts' => $contacts
            ]);             
                
        

        }catch(\Throwable $th){
            return response()->json([
                'status' => true,
                'message' => $th->getMessage()
            ]);
        }
    }

}
