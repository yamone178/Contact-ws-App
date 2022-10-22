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

                            @forelse($trashItems as $trashItem)

                                <a href="{{route('contact.show',$trashItem->id)}}"  class="tr  text-decoration-none text-black  d-table-row trashItem-item" style="cursor: pointer">
                                    <div class="d-table-cell ">


                                        <div class=" d-flex  align-items-center">

                                            <input

                                                class="form-check-input  me-3 check-box trashItem-select"
                                                name="checks[]" form="deleteMultipleForm"
                                                type="checkbox" value="{{$trashItem->id}}"
                                                id="flexCheckDefault{{$trashItem->id}}"
                                            >

                                            <label for="check{{$trashItem->id}}" class="checkLabel">
                                                @if($trashItem->image != null)
                                                    <img src="{{asset(Storage::url($trashItem->image))}}" width="40px" height="40px" class=" trashItem-img{{$trashItem->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                                @else



                                                    <div class="d-inline-block me-2">
                                                        <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($trashItem->firstName))}}</span>

                                                    </div>

                                                @endif
                                                {{ucwords($trashItem->firstName)}}
                                            </label>



                                        </div>
                                    </div>
                                    <div class="d-table-cell">{{$trashItem->email}}</div>
                                    <div class="d-table-cell">{{$trashItem->phone}}</div>
                                    <div class="d-table-cell">{{$trashItem->jobTitle}}</div>

                                    <div class="d-table-cell position-relative">



                                        <div class="d-flex action align-items-center justify-content-evenly">

                                            <i class="bi bi-star"></i>

                                            <form id="restoreForm" action="{{route('contact.restore',$trashItem->id)}}" method="post">
                                                @csrf
                                                <button class="btn  btn-sm btn-primary " form="restoreForm">
                                                   Restore
                                                </button>
                                            </form>



                                            <div class="dropdown d-inline ">
                                                <span class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots-vertical"></i>
                                                </span>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{route('contact.destroy',$trashItem->id)}}" id="delContact" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')

                                                            <button class="btn btn-sm btn-light w-100" form="delContact">
                                                                Del {{$trashItem->id}}
                                                            </button>

                                                        </form>

                                                    </li>

                                                </ul>
                                            </div>




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


                    <div class="mt-5">{{$trashItems->links()}}</div>


                </div>


            </div>

        </div>


    </div>


    </div>



@endsection
