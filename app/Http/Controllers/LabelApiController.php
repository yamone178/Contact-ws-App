<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelApiController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $label= new Label();
        $label->name= $request->name;
        $label->save();
        return $label->name;
        return  response()->json([
            'message'=> "Label is created",
            'name'=> $label->name
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $label = Label::find($id);
        if (is_null($label)){
            return  response()->json([
                'message'=> 'Contact not found',
            ],404);
        }
        $contacts = $label->contacts;
        return response()->json([
            'label' => $label,
            'contact' => ContactResource::collection($contacts)
        ],200);
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

        $label = Label::find($id);
        if (is_null($label)){
            return  response()->json([
                'message'=> 'Contact not found',
            ],404);
        }
        $label->name= $request->name;
        $label->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $label = Label::find($id);
        if (is_null($label)){
            return  response()->json([
                'message'=> 'Contact not found',
            ],404);
        }
        $label->delete();
        return response()->json([
           'message'=> "Label is deleted"
        ],200);
    }
}
