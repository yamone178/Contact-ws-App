@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                         <div class="d-table table-borderless table-hover w-100 ">

                            <div class="d-table-row ">
                                <h6 class=" fw-bold d-table-cell">#</h6>
                                <h6 class=" fw-bold d-table-cell">Name</h6>
                                <h6 class=" fw-bold d-table-cell">Email</h6>
                                <h6 class=" fw-bold d-table-cell">Phone</h6>
                                <h6 class=" fw-bold d-table-cell">Job Title</h6>
                                <h6 class=" fw-bold d-table-cell">Action</h6>
                            </div>




                            <tbody>

                            @forelse($contacts as $contact)



                                <a href="{{route('contact.show',$contact->id)}}"  class="tr  text-decoration-none text-black  d-table-row contact-item" style="cursor: pointer">
                                    <div class="d-table-cell">{{$contact->id}}</div>
                                    <div class="d-table-cell ">


{{--                                        @if($contact->image != null)--}}
{{--                                            <img src="{{asset('storage/images/'.$contact->image)}}" width="40px" height="40px" class=" contact-img{{$contact->id}} rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}

{{--                                        @else--}}



{{--                                            <div class="d-inline-block me-2">--}}
{{--                                                <span class="noImg " style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($contact->firstName))}}</span>--}}

{{--                                            </div>--}}

{{--                                        @endif--}}
                                        {{ucwords($contact->firstName)}}
                                    </div>
                                    <div class="d-table-cell">{{$contact->email}}</div>
                                    <div class="d-table-cell">{{$contact->phone}}</div>
                                    <div class="d-table-cell">{{$contact->job}}</div>

                                    <div class="d-table-cell position-relative">



                                        <div class="d-flex">

                                            <form action="{{route('contact.edit',$contact->id)}}" method="get">
                                                <button class="btn btn-sm btn-outline-dark">Edit</button>
                                            </form>


                                            <form action="{{route('contact.destroy',$contact->id)}}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-dark">
                                                    Del
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </a>



                            @empty
                            </tbody>
                        </div>




                        <h2 @class('text-center mt-5')>No posts to show</h2>
                        @endforelse

                        </tbody>
                    </div>


                   <div class="mt-5">{{$contacts->links()}}</div>
                </div>

            </div>

        </div>


    </div>


    </div>



@endsection
