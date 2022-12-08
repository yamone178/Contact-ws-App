@extends('layouts.app')



@section('content')



        <div class=" m-5 w-100">


            @forelse($notis as $noti)

                    <?php

                        $shared_Contact = json_decode($noti->shared_Contact,true)
                    ?>

               <div class="card mb-3  shadow border-primary">
                   <div class="card-body">
                       <div class="row-label d-flex align-items-center justify-content-between">
                          <div class="">
                              @if($shared_Contact['image'] != null)
                                  {{--                                                    <img src="{{asset(Storage::url($contact->image))}}" width="40px" height="40px" class=" contact-img{{$contact->id}} imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">--}}
                                  <img src="{{$shared_Contact['image']}}" width="40px" height="40px" class="  imgArea rounded-circle border border-1 border-primary me-2" style="object-fit: cover" alt="">

                              @else



                                  <div class=" me-2 d-inline-block image-container">
                                      <span class="noImg imgArea" style="background: {{\App\Models\Contact::randBackgroundColor()}}"> {{ucfirst(\App\Models\Contact::getFirstLetter($shared_Contact['firstName']))}}</span>

                                  </div>

                              @endif
                              {{ucwords($shared_Contact['firstName'])}} {{ucwords($shared_Contact['lastName'])}}

                          </div>
                           @isset($shared_Contact['phone'])
                               <p class="d-inline mb-0 "> {{$shared_Contact['phone']}}</p>
                               @endisset

                           @isset($shared_Contact['email'])
                               <p class="d-inline mb-0 "> {{$shared_Contact['email']}}</p>
                           @endisset

                           <div class="d-flex">

                               @if($noti->isAccepted == 0 )
                                   <form action="{{route('contact.acceptContact', $noti->id )}}" method="post" id="accept{{$noti->id}}">
                                       @csrf
                                       <input type="text" name="contact_id" value="{{$shared_Contact['id']}}" form="accept{{$noti->id}}" hidden >
                                       <button class="btn btn-sm btn-dark close" form="accept{{$noti->id}}">Accept</button>
                                   </form>


                               @else

                                   <button disabled class="badge bg-success">Accepted</button>

                               @endif

                                   <form action="{{route('contactStore.destroy',$noti->id)}}" id="removeNoti{{$noti->id}}" method="post">
                                       @csrf
                                       @method('delete')
                                       <button type="submit" class="btn ms-1 btn-sm btn-dark" form="removeNoti{{$noti->id}}" >Remove</button>

                                   </form>
                           </div>
                       </div>
                   </div>
               </div>

            @empty
            @endforelse



        </div>



@endsection
