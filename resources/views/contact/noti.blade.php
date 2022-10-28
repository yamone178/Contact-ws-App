@extends('layouts.app')



@section('content')
    @foreach($notis as $noti)

        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast d-block" data-bs-autohide="false">
            <div class="toast-header">
                <strong class="me-auto">Would you like to accept ?</strong>
                <small>{{$noti->created_at->diffforHumans()}}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="d-flex justify-content-between justify-content-center">
                    <p class="mb-0 badge bg-black">Contact name : {{ json_decode($noti->shared_Contact, true)['firstName'] }} {{ json_decode($noti->shared_Contact, true)['lastName'] }}  </p>
                    <p class="badge bg-dark mb-0">from {{\App\Models\User::find($noti->receiver)->name}}</p>
                </div>
                <hr>
                <div class="">

                    <form action="{{route('contactStore.addContact', json_decode($noti->shared_Contact, true)['id'] )}}" method="post" id="accept{{$noti->id}}">
                        @csrf
                        <input type="text" name="contactStore_id" value="{{$noti->id}}" form="accept{{$noti->id}}" hidden >
                        <button class="btn btn-dark" form="accept{{$noti->id}}">Accept</button>
                    </form>
                </div>
            </div>

        </div>
    @endforeach
@endsection
