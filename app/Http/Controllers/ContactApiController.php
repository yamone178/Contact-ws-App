<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts= Contact::latest('id')->get();
        return ContactResource::collection($contacts);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName'=> 'required',
            'lastName'=> 'required',
            'phone'=> 'required',

        ]);
        $contact= new Contact();
        $contact->firstName= $request->firstName;
        $contact->lastName= $request->lastName;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->jobTitle= $request->jobTitle;
        $contact->birthday= $request->birthday;
        $contact->note= $request->note;
        $contact->user_id= Auth::id();

        if ($request->hasFile('image')){
            $newPath= $request->file('image')->store('public/image/'.$request->image);
            $contact->image= $newPath;
        }


        $contact->save();

        return response()->json([
            'message'=>'Contact created',
            'success'=> 'true',
            'status'=> 202,
            'contact'=> new ContactResource($contact)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact= Contact::find($id);
        if (is_null($contact)){
            return  response()->json([
                'message'=> 'Contact not found',
                'status'=> 404
            ]);
        }

        return response()->json([
            'success'=> 'true',
            'status'=> 200,
            'contact'=> new ContactResource($contact)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
           'firstName'=>'nullable',
           'lastName'=> 'nullable',
           'phone'=> 'nullable',
            'image'=> 'nullable|file|mimes:jpeg,png|max:512'
        ]);


        $contact = Contact::find($id);

        if (is_null($contact)){
            return  response()->json([
                'message'=> 'Contact not found',
                'status'=> 404
            ]);
        }


        if ($request->has('firstName')){
            $contact->firstName= $request->firstName;
        }
        if ($request->has('lastName')){
            $contact->lastName= $request->lastName;
        }
        if ($request->has('phone')){
            $contact->phone = $request->phone;
        }
        if ($request->has('email')){
            $contact->email= $request->email;
        }
        if ($request->has('jobTitle')){
            $contact->jobTitle= $request->jobTitle;
        }
        if ($request->has('birthday')){
            $contact->birthday= $request->birthday;
        }
        if ($request->hasFile('image')){
            $newPath= $request->file('image')->store('public/image/'.$request->image);
            $contact->image= $newPath;
        }

        if ($request->has('note')){
            $contact->note= $request->note;
        }

        $contact->update();

        return response()->json([
            'message'=> 'Contact is updated',
            'status'=> 200,
            'success'=> true,
            'contact'=> $contact
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact= Contact::find($id);
        if (is_null($contact)){
            return  response()->json([
                'message'=> 'Contact not found',
                'status'=> 404
            ]);
        }
        $contact->delete();


        return  response()->json([
            'message'=> 'Contact is deleted',
            'status'=>200,
            'success'=> true

        ]);
    }
}
