<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;
use App\Http\Resources\ContactResource;
use App\Imports\TestImport;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts= Contact::where('user_id',Auth::id())
                ->latest('id')->get();
//              ->paginate(6)->withQueryString();
        return response()->json([
            'success'=> true,
            'status' => 200,
            'contacts' => ContactResource::collection($contacts)
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

//        if ($request->hasFile('image')){
//            $newPath= $request->file('image')->store('public/image');
//            $contact->image= $newPath;
//        }

        if ($request->hasFile('image')){

            $newName= uniqid().'contact_img.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public/image', $newName);

            $contact->image = $newName;
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
        Gate::authorize('view',$contact);
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

        Gate::authorize('update',$contact);

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
//        if ($request->hasFile('image')){
//            $newPath= $request->file('image')->store($request->image);
//            $contact->image= $newPath;
//        }

        if ($request->hasFile('image')){

            $newName= uniqid().'contact_img.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public/image', $newName);

            $contact->image = $newName;
        }

        if ($request->has('note')){
            $contact->note= $request->note;
        }

        $contact->update();

        return response()->json([
            'message'=> 'Contact is updated',
            'status'=> 200,
            'success'=> true,
            'contact'=> new ContactResource($contact)
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
        $contact= Contact::where('user_id',Auth::id())
                ->withTrashed()->find($id);
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

    public function trash(){

        $trashItems=  Contact::where('user_id',Auth::id())
            ->onlyTrashed()->latest('id')
            ->paginate(6)->withQueryString();
       return response()->json([
           'status' => 200,
           'contacts' => ContactResource::collection($trashItems)
       ]);
    }

    public function restore($id){

        $contact= Contact::where('user_id',Auth::id())
            ->onlyTrashed()->findOrFail($id);

        if (is_null($contact)){
            return  response()->json([
                'message'=> 'Contact not found',
                'status'=> 404
            ]);
        }
        $contact->restore();

        return  response()->json([
            'message'=> 'Contact is restored',
            'status'=>200,
            'success'=> true,


        ]);
    }

    public function clone($id){

        $contact= Contact::where('user_id',Auth::id())->find($id);
        if (is_null($contact)){
            return  response()->json([
                'message'=> 'Contact not found',
                'status'=> 404
            ]);
        }
        $newContact= $contact->replicate();
        $newContact->created_at = Carbon::now();
        $newContact->save();

        return  response()->json([
            'message'=> 'Contact is cloned',
            'status'=>200,
            'success'=> true,


        ]);

    }

    public function multipleDelete(Request $request){

        $contacts= Contact::where('user_id',Auth::id())
            ->withTrashed()
            ->whereIn('id',$request)
            ->get();


        //force Delete
        foreach ($contacts as $contact){
            if ($contact->trashed()){
                if ($contact->image != null){
                    Storage::delete($contact->image);
                }
                $contact->forceDelete();
            }

            $contact->delete();
        }

        //softDelete
//        Contact::destroy($request);

        return  response()->json([
            'message'=> count($contacts)." Contacts are cloned",
            'status'=>200,
            'success'=> true,

        ]);

    }

    public function multipleClone(Request $request){

        $contacts= Contact::where('user_id',Auth::id())
                    ->whereIn('id',$request)->get();
        foreach ($contacts as $contact){
            $newContact= $contact->replicate();
            $newContact->created_at = Carbon::now();
            $newContact->save();
        }

        return  response()->json([
            'message'=> count($contacts)." Contacts are cloned",
            'status'=>200,
            'success'=> true,

        ]);
    }

    public function export(){
        return Excel::download(new TestExport, 'contact.csv');
    }

    public function import(Request $request){
       return Excel::import(new TestImport, $request->file('contacts'));

    }

}
