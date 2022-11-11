<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\StoreContactResource;
use App\Models\Contact;
use App\Models\StoreContact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class StoreContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notis = StoreContact::where('receiver', Auth::id())
            ->latest('id')
            ->paginate(5)
            ->withQueryString();
        return response()->json([
            'success'=> 'true',
            'status'=> 200,
            'contacts' => $notis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact= Contact::find($request->contact_id);
        $storeContact= new StoreContact();
        $storeContact->sender = $contact->user_id;
        $storeContact->shared_Contact= $contact;
        $storeContact->receiver= User::where('email',$request->email)->first()->id;

        $storeContact->save();

        return response()->json([
            'message'=>'Sending contact successfully ',
            'success'=> 'true',
            'status'=> 200,
            'contact'=> new StoreContactResource($storeContact)
        ]);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact= StoreContact::find($id);
        $contact->delete;

        return response([
           'status'=> 200,
           'message'=> "Contact is removed from store"
        ]);
    }



    public function acceptContact(Request $request,$id){

        //find from contact

        $storeContact = StoreContact::find($id);
        $toArray = json_decode($storeContact->shared_Contact);
        $contact = $toArray;

        if (is_null($contact)){
            return response()->json([
               'message'=> 'contact not found'
            ]);
        }

        //isAccepted
        StoreContact::where('id',$id)->update(['isAccepted' => 1]);

        //save to receiver
        $newContact = new Contact();
        $newContact->create([
            'firstName' => $contact->firstName,
            'lastName' => $contact->lastName,
            'jobTitle' => $contact->jobTitle,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'birthday' => $contact->birthday,
            'image' =>  $contact->image,
            'note'=> $contact->note,
            'user_id' => Auth::user()->id,

        ]);

        //Delete old contact from sender
        $oldContact = Contact::find($contact->id);
        if (is_null($oldContact)){
            return response()->json([
                'message'=> 'Contact has been accepted'
            ]);
        }
        $oldContact->delete();

        return response()->json([
            'message'=>'Contact is accepted',
            'success'=> 'true',
            'status'=> 200,
            'contact'=> $newContact
        ]);
    }


    public function declineContact (Request $request,$id){


        //isAccepted
        StoreContact::where('id',$id)->update(['isAccepted' => 0]);

        return response()->json([
            'message'=>'Contact is declined',
            'success'=> 'true',
            'status'=> 200,
        ]);
    }

}
