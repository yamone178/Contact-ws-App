<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreContactRequest;
use App\Http\Requests\UpdateStoreContactRequest;
use App\Models\Contact;
use App\Models\StoreContact;
use App\Models\User;

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
    public function destroy(StoreContact $storeContact)
    {
        //
    }
}
