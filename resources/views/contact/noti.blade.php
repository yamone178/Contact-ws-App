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
                <p class="">Contact name : {{ json_decode($noti->shared_Contact, true)['firstName'] }} {{ json_decode($noti->shared_Contact, true)['lastName'] }}</p>
                <hr>
                <div class="">
                    <form action="{{route('contactStore.addContact', json_decode($noti->shared_Contact, true)['id'] )}}" method="get">
                        <button class="btn btn-dark">Accept</button>
                    </form>
                </div>
            </div>

        </div>
    @endforeach
@endsection
