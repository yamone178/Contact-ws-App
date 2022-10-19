@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12">

                <div class="card border-0 shadow-sm position-relative">

                    <a href="{{route('contact.index')}}" class="position-absolute p-3">
                        <svg width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe undefined"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg>
                    </a>

                    <div class="card-body p-5 ">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if($contact->image != null)
                                    <img src="{{asset(Storage::url($contact->image))}}" width="150px" height="150px" class="rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                @else

{{--                                    <img src="{{asset('localImages/profile.png')}}" width="150px" height="150px" class="rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}

                                    <div class="d-inline-block me-2">
                                        <span class="showNoImg " style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($contact->firstName))}}</span>

                                    </div>

                                @endif

                                <h3 @class('ms-4')>{{$contact->firstName}} {{$contact->lastName}}</h3>
                            </div>

                            <div class="" style="width: 100px;">
                                <a href="{{route('contact.edit',$contact->id)}}" class="btn btn-primary w-100 ">Edit</a>

                            </div>
                        </div>

                        <div class="card w-50 mt-4">
                            <div class="card-body">
                                <p class="fs-5 fw-bold">Contact Detail</p>
                                <div class=" d-flex align-items-center fs-6 ">
                                    <i class="bi bi-envelope me-3 fa-fw"></i>
                                    <span>{{$contact->email}}</span>

                                </div>

                                <div class=" d-flex align-items-center  ">
                                    <i class="bi bi-phone-vibrate me-3 fa-fw"></i>
                                    <span>{{$contact->phone}}</span>

                                </div>

                                @isset($contact->birthday)
                                    <div class=" d-flex align-items-center  ">
                                        <i class="bi bi-calendar-date me-3 fa-fw"></i>
                                        <span>{{$contact->birthday}}</span>

                                    </div>
                                @endisset


                                @isset($contact->jobTitle)
                                    <div class=" d-flex align-items-center  ">
                                        <i class="bi bi-person-workspace me-3 fa-fw"></i>
                                        <span>{{$contact->jobTitle}}</span>

                                    </div>
                                @endisset



                                @isset($contact->note)
                                    <div class=" d-flex align-items-center  ">
                                        <i class="bi bi-node-plus me-3 fa-fw"></i>
                                        <span>{{$contact->note}}</span>

                                    </div>
                                @endisset


                            </div>
                        </div>

                    </div>




                </div>

            </div>


        </div>


    </div>



@endsection
