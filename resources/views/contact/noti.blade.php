@extends('layouts.app')



@section('content')



        <div class="row mt-5">
            @forelse($notis as $noti)

                <?php

                    $shared_Contact = json_decode($noti->shared_Contact,true)
                    ?>
            <div class="col-6 notiBox">
                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast d-block mb-3" data-bs-autohide="false">
                    <div class="toast-header">
                        <strong class="me-auto">Would you like to accept ?</strong>
                        <small>{{$noti->created_at->diffforHumans()}}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <div class="d-flex justify-content-between justify-content-center">
                            <p class="mb-0 badge bg-black">Contact name : {{$shared_Contact['firstName']}} {{$shared_Contact['lastName']}}  </p>
                            <p class="badge bg-dark mb-0">from {{\App\Models\User::find($noti->sender)->name}}</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">

                            @if($noti->isAccepted == 0)
                                <form action="{{route('contact.acceptContact', $noti->id )}}" method="post" id="accept{{$noti->id}}">
                                    @csrf
{{--                                    <input type="text" name="contact_id" value="{{$shared_Contact['id']}}" form="accept{{$noti->id}}" hidden >--}}
                                    <button class="btn btn-dark close" form="accept{{$noti->id}}">Accept</button>
                                </form>

                                <form action="{{route('contact.declineContact', $noti->id )}}" method="post" id="decline{{$noti->id}}">
                                    @csrf
{{--                                    <input type="text" name="contactStore_id" value="{{$noti->id}}" form="decline{{$noti->id}}" hidden >--}}
                                    <button class="btn btn-dark close" form="decline{{$noti->id}}">Decline</button>
                                </form>


                            @else

                                <button disabled class="badge bg-success">Accepted</button>

                            @endif



                        </div>
                    </div>

                </div>

            </div>

            @empty

                <h2>There is no notification</h2>

            @endforelse


{{--            @forelse($notis as $noti)--}}



{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex justify-content-between">--}}

{{--                            <div class=" d-flex  align-items-center">--}}

{{--                                <input--}}
{{--                                    class="form-check-input  me-3 check-box contact-select "--}}
{{--                                    name="checks[]"  form="deleteMultipleForm" type="checkbox"--}}
{{--                                    value="{{ json_decode($noti->shared_Contact, true)['id'] }}" id="flexCheckDefault{{json_decode($noti->shared_Contact, true)['id']}}"--}}

{{--                                >--}}


{{--                                <label  for="flexCheckDefault{{json_decode($noti->shared_Contact, true)['id']}}" class="row-label">--}}
{{--                                    @if(json_decode($noti->shared_Contact, true)['image'] != null)--}}
{{--                                        --}}{{--                                                    <img src="{{asset(Storage::url($contact->image))}}" width="40px" height="40px" class=" contact-img{{$contact->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}
{{--                                        <img src="{{asset('storage/image/'.json_decode($noti->shared_Contact, true)['image'])}}" width="40px" height="40px" class=" contact-img{{json_decode($noti->shared_Contact, true)['id']}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}

{{--                                    @else--}}



{{--                                        <div class=" me-2 d-inline-block image-container">--}}
{{--                                            <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter(json_decode($noti->shared_Contact, true)['firstName']))}}</span>--}}

{{--                                        </div>--}}

{{--                                    @endif--}}
{{--                                    {{ucwords(json_decode($noti->shared_Contact, true)['firstName'])}}--}}
{{--                                </label>--}}



{{--                            </div>--}}

{{--                            <div class="">--}}

{{--                                <p class="mb-0 ">from => <span class="fw-bold ">{{\App\Models\User::find($noti->sender)->name}}</span></p>--}}
{{--                            </div>--}}

{{--                            <div class=" d-flex justify-content-between">--}}

{{--                                    <form action="{{route('contact.acceptContact', json_decode($noti->shared_Contact, true)['id'] )}}" method="post" id="accept{{$noti->id}}">--}}
{{--                                        @csrf--}}
{{--                                        <input type="text" name="contactStore_id" value="{{$noti->id}}" form="accept{{$noti->id}}" hidden >--}}
{{--                                        <button class="btn btn-dark" form="accept{{$noti->id}}">Accept</button>--}}
{{--                                    </form>--}}

{{--                                    <form class="ms-3" action="{{route('contact.declineContact', json_decode($noti->shared_Contact, true)['id'] )}}" method="post" id="decline{{$noti->id}}">--}}
{{--                                        @csrf--}}
{{--                                        <input type="text" name="contactStore_id" value="{{$noti->id}}" form="decline{{$noti->id}}" hidden >--}}
{{--                                        <button class="btn btn-dark" form="decline{{$noti->id}}">Decline</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @empty--}}


{{--                @endforelse--}}


        </div>



@endsection
