<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\StoreContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\TestImport;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $contacts= Contact::where('user_id',Auth::id())
            ->latest('id')
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


       if ($request->file('image') != null){

            $newName= uniqid().'contact_img.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public', $newName);

           $contact->image = $newName;
       }

//        if ($request->hasFile('image')){
//            $newName= $request->file('image')->store('public/image');
//            $contact->image= $newName;
//        }




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
        Gate::authorize('view',$contact);
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

        Gate::authorize('update',$contact);
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

        Gate::authorize('update',$contact);
        $contact->firstName= $request->firstName;
        $contact->lastName= $request->lastName;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->jobTitle= $request->jobTitle;
        $contact->birthday= $request->birthday;
        $contact->note= $request->note;
        $contact->user_id = auth()->user()->id;

        if ($request->hasFile('image')){

            //delete old photo
            Storage::delete("public/".$contact->image);

            $newName= uniqid().'contact_img.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public', $newName);

            $contact->image = $newName;
        }

//        if ($request->hasFile('image')){
//            $newName= $request->file('image')->store('public/image');
//            $contact->image= $newName;
//        }

        $contact->update();

        return  redirect()->route('contact.index')->with('status','contact is updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contact= Contact::where('user_id',Auth::id())
                    ->withTrashed()->findOrFail($id);


        //forceDelete
        if ($contact->trashed()){
                if ($contact->image != null){
                    Storage::delete('public/'.$contact->image);
                }
            $contact->forceDelete();
        }

        //softDelete
        $contact->delete();
        return redirect()->back()->with('status','Contact are deleted');
    }

    public function trash(){

        $trashItems=  Contact::where('user_id',Auth::id())
                    ->onlyTrashed()->latest('id')
                        ->paginate(6)->withQueryString();
        return view('contact.trash', compact('trashItems'));
    }

    public function restore($id){

        $contact= Contact::where('user_id',Auth::id())
                    ->onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->back()->with('status','Contact is restored');
    }

    public function multipleDelete(Request $request){

        $contacts= Contact::where('user_id',Auth::id())
                    ->withTrashed()
                    ->whereIn('id',$request->checks)
                    ->get();


        //force Delete
           foreach ($contacts as $contact){
               if ($contact->trashed()){
                   if ($contact->image != null){
                       Storage::delete('public/'.$contact->image);
                   }
                   $contact->forceDelete();
               }
           }

           //softDelete
        Contact::destroy($request->checks);
        return  redirect()->route('contact.index')->with('status','contacts are deleted');
    }



    public function export(){
        return Excel::download(new TestExport, 'contact.csv');
    }

    public function import(Request $request){
         Excel::import(new TestImport, $request->file('contacts'));

        return redirect()->route('contact.index')->with('success');
    }

    public function clone($id){

        $contact= Contact::find($id);
       $newContact= $contact->replicate();
      $newContact->created_at = Carbon::now();
        $newContact->save();

        return redirect()->route('contact.index');
    }

    public function multipleClone(Request $request){

       $contacts= Contact::whereIn('id',$request->checks)->get();
       foreach ($contacts as $contact){
           $newContact= $contact->replicate();
           $newContact->created_at = Carbon::now();
           $newContact->save();
       }

       return redirect()->route('contact.index')->with('status','Copies done');
    }


}
