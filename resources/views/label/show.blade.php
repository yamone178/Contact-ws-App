@extends('layouts.app')



@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        {{--                     multiple Select Form for Delete and Duplicate --}}

                        <form class="mb-3 d-flex align-items-center multipleForm" action="{{route('contact.multipleDelete')}}" method="post" id="deleteMultipleForm">
                            @csrf

                            <input
                                class="form-check-input me-3 checkAll"
                                type="checkbox"
                                value=""
                                id="flexCheckDefault"
                            >
                            <button
                                disabled=true
                                class="btn btn-danger multipleDelBtn"
                                form="deleteMultipleForm"
                            >
                                Delete
                            </button>
                        </form>
                        {{--       End  multiple Select Form for Delete and Duplicate --}}



                        <table class="table table-hover table-borderless table-hover align-middle ">
                            <thead class="table-light">
                            <tr class="">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Job Title</th>
                                <th>Action</th>
                            </tr>

                            </thead>


                            <tbody>

                            <tr>
                                <td>
                                    <p class="badge bg-dark"> Selected :
                                        <span class="count">0</span>
                                        in  {{\App\Models\Contact::where('user_id',Auth::id())->onlyTrashed()->count()}}

                                    </p>
                                </td>
                            </tr>

                            @forelse($label->contacts as $contact)
                                <tr class="" >
                                    <td>
                                        <div class=" d-flex  align-items-center">

                                            <input
                                                class="form-check-input  me-3 check-box contact-select "
                                                name="checks[]"  form="deleteMultipleForm" type="checkbox"
                                                value="{{$contact->id}}" id="flexCheckDefault{{$contact->id}}"

                                            >


                                            <label  for="flexCheckDefault{{$contact->id}}" class="row-label">
                                                @if($contact->image != null)
                                                    {{--                                                    <img src="{{asset(Storage::url($contact->image))}}" width="40px" height="40px" class=" contact-img{{$contact->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}
                                                    <img src="{{$contact->image}}" width="40px" height="40px" class=" contact-img{{$contact->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                                @else



                                                    <div class="d-inline-block me-2">
                                                        <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($contact->firstName))}}</span>

                                                    </div>

                                                @endif
                                                {{ucwords($contact->firstName)}}
                                            </label>



                                        </div>
                                    </td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->jobTitle}}</td>
                                    <td>

                                        <div class="d-flex">
                                            <form action="{{route('contact.destroy',$contact->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-dark">Del</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                            </tbody>
                        </table>




                        <h2 @class('text-center')>No posts to show</h2>
                        @endforelse

                        </tbody>
                        </table>


                    </div>

                </div>

            </div>


        </div>


    </div>



@endsection
