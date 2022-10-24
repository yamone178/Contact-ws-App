@extends('layouts.app')



@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form class="mb-3" action="{{route('contact.multipleDelete')}}" method="post" id="deleteMultipleForm">
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

                            @forelse($trashItems as $trashItem)
                                <tr class="table-row">
                                    <td>
                                        <div class=" d-flex   align-items-center">

                                            <input
                                                class="form-check-input  me-3 check-box contact-select "
                                                name="checks[]" form="deleteMultipleForm" type="checkbox"
                                                value="{{$trashItem->id}}" id="flexCheckDefault{{$trashItem->id}}"
                                            >


                                            <label for="flexCheckDefault{{$trashItem->id}}" class="">
                                                @if($trashItem->image != null)
                                                    <img src="{{asset(Storage::url($trashItem->image))}}" width="40px" height="40px" class=" contact-img{{$trashItem->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                                @else



                                                    <div class="d-inline-block me-2">
                                                        <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($trashItem->firstName))}}</span>

                                                    </div>

                                                @endif
                                                {{ucwords($trashItem->firstName)}}
                                            </label>



                                        </div>
                                    </td>
                                    <td>{{$trashItem->email}}</td>
                                    <td>{{$trashItem->phone}}</td>
                                    <td>{{$trashItem->jobTitle}}</td>
                                    <td>

                                        <div class="d-flex">
                                            <form  class="me-1" action="{{route('contact.restore',$trashItem->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-dark">Restore</button>
                                            </form>

                                            <form action="{{route('contact.destroy',$trashItem->id)}}" method="post">
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


                        <div class="">{{$trashItems->links()}}</div>
                    </div>

                </div>

            </div>


        </div>


    </div>



@endsection
