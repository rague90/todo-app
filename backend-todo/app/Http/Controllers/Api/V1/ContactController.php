<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactsCollectionResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ContactsCollectionResource(Contact::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactRequest $request)
    {
        try {
            $contact = Contact::create($request->validated());
            return new ContactResource($contact);
        
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            return new ContactResource($contact);
        } catch(ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'model not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, $id)
    {
        try {
            if($request->validated()) {
                Contact::where('id', $id)->update($request->validated());
                return new ContactResource(Contact::find($id));
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(Contact::destroy($id)) {
                return response()->json(['success' => true, 'message' => 'contact deleted successfully']);
            }
            return response()->json(['success' => false, 'message' => 'contact not found'], 404);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
