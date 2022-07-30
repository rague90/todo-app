<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
   // get all contacts 
   public function getContacts()
   {
   //      $contacts = Contact::get();
         return response()->json(Contact::all());

   }
   //get and edit contact
   public function get_contact($id)
   {
    $contact = Contact::find($id);
    return response()->json($contact);
   }

   // get contact id
   public function getContact($id)
   { 
      $contact = Contact::find($id);
      return response()->json([
    'contact' => $contact,
    'message' => 'get contact',
    

      ]
      );

   }

    // add and save contact
    public function saveContact (Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
       $contact->Tel = $request->Tel;
        $contact->fonction = $request->fonction;
        $contact->save();
        return response()->json([
            'message' =>'Contact Created Successfully',
            'code' => 200
        ]);

    }
     //delete contact
    public function deleteContact($id){
    $contact = Contact::find($id);
    if($contact)
    {  
        $contact->delete();
        return response()->json([
                'message' => 'Contact Deleted Successfuly',
                'code' => 200
        ]
     );

    }else
    {
       return response()->json([
            'message' => "Contact with id:$id does not exist", 
       ]
    );
    }
    }


    //update contact
    public function UpdateContact($id, Request $request){
        $contact = Contact::where('id',$id)->first();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->Tel = $request->Tel;
        $contact->fonction = $request->fonction;
        $contact->save();
        return response()->json([
            'message' =>'Contact Update Successfully',
            'code' => 200
        ]);

    }
}
