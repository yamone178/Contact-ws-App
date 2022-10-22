@extends('layouts.app')



@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <table class="table table-borderless table-hover align-middle ">
                            <thead class="table-light ">
                            <tr class="">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Job Title</th>
                                <th>Action</th>
                            </tr>

                            </thead>

                            <tbody>

                            @forelse($trashItems as $trashItem)
                                <tr>
                                    <td>
                                        @if($trashItem->image != null)
                                            <img src="{{asset('public/image/'.$trashItem->image)}}" width="40px" height="40px" class="rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                                        @else

                                            <div class="d-inline-block me-2">
                                                <span class="noImg " style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($trashItem->firstName))}}</span>

                                            </div>

                                        @endif
                                        {{ucwords($trashItem->name)}}
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




                        <h2 @class('text-center')>No photos to show</h2>
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
