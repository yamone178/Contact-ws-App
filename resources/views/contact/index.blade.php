@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">



                        <form action="{{route('contact.multipleDelete')}}" method="post" id="deleteMultipleForm">
                            @csrf

                            <input
                                class="form-check-input me-3 checkAll"
                                type="checkbox"
                                value=""
                                id="flexCheckDefault"
                            >
                            <button
                                class="btn btn-danger multipleDelBtn"
                                form="deleteMultipleForm"
                            >
                                Delete
                            </button>
                        </form>



                         <div class="d-table table-borderless table-hover w-100 ">

                            <div class="d-table-row ">
                                <h6 class=" fw-bold d-table-cell">Name</h6>
                                <h6 class=" fw-bold d-table-cell">Email</h6>
                                <h6 class=" fw-bold d-table-cell">Phone</h6>
                                <h6 class=" fw-bold d-table-cell">Job Title</h6>
                                <h6 class=" fw-bold d-table-cell">Action</h6>
                            </div>

                             <div class="">
                                 <p class="badge bg-dark"> Contacts : {{\App\Models\Contact::count()}}</p>

                                 <p class="badge bg-dark"> SelectedItems :


                                 </p>

                             </div>



                            <tbody>

                            @forelse($contacts as $contact)



                                <a href="{{route('contact.show',$contact->id)}}"  class="tr  text-decoration-none text-black  d-table-row contact-item" style="cursor: pointer">
                                    <div class="d-table-cell ">


                                           <div class=" d-flex  align-items-center">

                                               <input
                                                   id="check{{$contact->id}}"
                                                   class="form-check-input  me-3 check-box contact-select"
                                                   name="checks[]" form="deleteMultipleForm" type="checkbox"
                                                   value="{{$contact->id}}" id="flexCheckDefault{{$contact->id}}"
                                               >


                                               <label for="check{{$contact->id}}" class="checkLabel">
                                                   @if($contact->image != null)
                                                       <img src="{{asset(Storage::url($contact->image))}}" width="40px" height="40px" class=" contact-img{{$contact->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                                   @else



                                                       <div class="d-inline-block me-2">
                                                           <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($contact->firstName))}}</span>

                                                       </div>

                                                   @endif
                                                   {{ucwords($contact->firstName)}}
                                               </label>



                                           </div>
                                    </div>
                                    <div class="d-table-cell">{{$contact->email}}</div>
                                    <div class="d-table-cell">{{$contact->phone}}</div>
                                    <div class="d-table-cell">{{$contact->jobTitle}}</div>

                                    <div class="d-table-cell position-relative">



                                        <div class="d-flex action align-items-center justify-content-evenly">

                                            <i class="bi bi-star"></i>

                                            <form action="{{route('contact.edit',$contact->id)}}" method="get">
                                                <button class="btn  btn-lg">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </form>



                                            <div class="dropdown d-inline ">
                                                <span class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots-vertical"></i>
                                                </span>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="btn btn-sm btn-light w-100" form="delContactForm">
                                                            Del
                                                        </button>
                                                    </li>

                                                </ul>
                                            </div>




                                        </div>

                                    </div>

                                </a>

                                <form action="{{route('contact.destroy',$contact->id)}}" id="delContactForm" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')

                                </form>




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
