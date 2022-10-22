<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use App\Imports\TestImport;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Nette\Utils\Paginator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts= Contact::latest('id')
            ->paginate(6)
            ->withQueryString()
        ;

        return  view('contact.index',compact(['contacts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {



        $contact= new Contact();
        $contact->firstName= $request->firstName;
        $contact->lastName= $request->lastName;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->jobTitle= $request->jobTitle;
        $contact->birthday= $request->birthday;
        $contact->note= $request->note;
        $contact->user_id = Auth::user()->id;


//       if ($request->hasFile('image')){
//
//            $newName= uniqid().'contact_img.'.$request->file('image')->extension();
//            $request->file('image')->storeAs('public/images', $newName);
//
//           $contact->image = $newName;
//       }

        if ($request->hasFile('image')){
            $newName= $request->file('image')->store('public/image');
            $contact->image= $newName;
        }




        $contact->save();




        return  redirect()->route('contact.index')->with('status','contact is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return  view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {


        return view('contact.edit', compact('contact'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->firstName= $request->firstName;
        $contact->lastName= $request->lastName;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->jobTitle= $request->jobTitle;
        $contact->birthday= $request->birthday;
        $contact->note= $request->note;
        $contact->user_id = Auth::id();


        if ($request->hasFile('image')){
            $newName= $request->file('image')->store('public/image');
            $contact->image= $newName;
        }

        $contact->update();

        return  redirect()->route('contact.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $contact= Contact::withTrashed()->findOrFail($id);


        //forceDelete
        if ($contact->trashed()){

            Storage::delete('public/image/'.$contact->image);
            $contact->forceDelete();
        }

        //softDelete
        $contact->delete();
        return redirect()->back();
    }

    public function trash(){

        $trashItems=  Contact::onlyTrashed()->latest('id')
                        ->paginate(6)->withQueryString();
        return view('contact.trash', compact('trashItems'));
    }

    public function restore($id){

        $contact= Contact::withTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->back();
    }

    public function multipleDelete(Request $request){



        $contacts= Contact::withTrashed()->whereIn('id',$request->checks)->get();

           foreach ($contacts as $contact){
               if ($contact->trashed()){
                   $contact->forceDelete();
               }
           }

        Contact::destroy($request->checks);
        return  redirect()->back();
    }



    public function export(){
        return Excel::download(new TestExport, 'contact.csv');
    }

    public function import(Request $request){
         Excel::import(new TestImport, $request->file('contacts'));

        return redirect()->route('contact.index')->with('success');
    }
}
