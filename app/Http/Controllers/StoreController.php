<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreContactRequest;
use App\Http\Requests\UpdateStoreContactRequest;
use App\Models\Contact;
use App\Models\StoreContact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Termwind\renderUsing;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreContactRequest $request)
    {

       $contact= Contact::find($request->contact_id);
       $storeContact= new StoreContact();
       $storeContact->sender = $contact->user_id;
       $storeContact->shared_Contact= $contact;
        $storeContact->receiver= User::where('email',$request->email)->first()->id;

        $storeContact->save();
       return  redirect()->back()->with('status',"Sending Contact Successful");


    }

    public function multipleStoreContact( Request $request){
        $contacts= Contact::whereIn('id',$request->checks)->get();

        foreach ($contacts as $contact){
            $contact= Contact::find($contact->id);
            $storeContact= new StoreContact();
            $storeContact->sender = Auth::id();
            $storeContact->shared_Contact= $contact;
            $storeContact->receiver= User::where('email',$request->email)->first()->id;

            $storeContact->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreContact  $storeContact
     * @return \Illuminate\Http\Response
     */
    public function show(StoreContact $storeContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreContact  $storeContact
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreContact $storeContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreContactRequest  $request
     * @param  \App\Models\StoreContact  $storeContact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreContactRequest $request, StoreContact $storeContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreContact  $storeContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreContact $storeContact, $id)
    {
        $contact= StoreContact::findorFail($id);
        $contact->delete();

        return redirect()->back();
    }

    public function noti(){

        $notis = StoreContact::where('receiver', Auth::id())->get();
        return view('contact.noti', compact('notis'));
    }


    public function acceptContact(Request $request,$id){

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

       $newContact = new Contact();
       $newContact->create([
           'firstName' => $contact->firstName,
           'lastName' => $contact->lastName,
           'jobTitle' => $contact->jobTitle,
           'email' => $contact->email,
           'phone' => $contact->phone,
           'birthday' => $contact->birthday,
           'image' => $contact->image,
           'user_id' => Auth::user()->id,

       ]);

       $fullName = "$contact->firstName $contact->lastName";
       $senderEmail = User::find($storeContact->sender)->email;

        //Delete old contact from sender
        $oldContact = Contact::find($contact->id);
        if ($oldContact){
            $oldContact->delete();
        }

       return redirect()->back()->with('status', "Contact name $fullName is accepted from $senderEmail");
    }


    public function declineContact (Request $request,$id){

        //Decline Contact
       StoreContact::where('id',$id)->update(['isAccepted' => 0]);

      return redirect()->back();

    }


}
