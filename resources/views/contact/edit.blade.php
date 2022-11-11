@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">

                    <a href="{{route('contact.index')}}" class="position-absolute p-3 " style="z-index: 1000; top: -20px; left: -10px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe undefined"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg>
                    </a>
                    <div class="card-body">

                        <div class=" d-flex justify-content-between align-items-end ">
                            <div class="d-inline-block position-relative create-contact-img">

                                <img src="{{asset('localImages/profile.png')}}" class="rounded-circle contact-Img-area position-relative
                                    {{$contact->image != null ? 'd-none': 'd-block'}}" width="150px" height="150px" alt="">




                                <img src="{{old('image',$contact->image)}}"  class=" outputImg rounded-circle contact-Img-area position-relative
                               {{$contact->image != null ? 'd-block': 'd-none'}}" width="150px" height="150px" style="object-fit: cover" alt="">


                                <div class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class=""><path d="M0 0h24v24H0z" fill="none"></path><path d="M20 10h-2V7h-3V5h3V2h2v3h3v2h-3v3zm-4 3c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4zm4-1v7H4V7h9V3H9L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-7h-2z"></path></svg>

                                </div>
                            </div>


                            <input

                                type="file"
                                form="contactUpdateForm"
                                   hidden name="image"
                                class="contact-imgInput"

                            >

                            @foreach(\App\Models\Label::latest('id')->get() as $label)
                                <div class="form-check">
                                    <input form="contactUpdateForm" name="labels[]" class="form-check-input"  type="checkbox" value="{{$label->id}}" id="flexCheckDefault{{$label->id}}">
                                    <label   class="form-check-label" for="flexCheckDefault{{$label->id}}">
                                        {{$label->name}}
                                    </label>
                                </div>


                            @endforeach

                            <div  class="">
                                <button form="contactUpdateForm" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class=" mb-3">

                                <label class="form-label">First Name</label>

                                <input
                                    value="{{old('firstName', $contact->firstName)}}"
                                    form="contactUpdateForm"
                                    type="text"
                                    name="firstName"

                                    class="form-control
                                   @error('firstName') is-invalid @enderror"
                                >
                                @error('firstName')
                                <span class="invalid-feedback">
                                       {{$message}}
                                   </span>
                                @enderror
                            </div>

                            <div class=" mb-3">
                                <label class="form-label">Last Name</label>
                                <input
                                    value="{{old('lastName',$contact->lastName)}}"
                                    form="contactUpdateForm"
                                    type="text"
                                    name="lastName"
                                    class="form-control @error('lastName') is-invalid @enderror"
                                >
                                @error('lastName')
                                <span class="invalid-feedback">
                                       {{$message}}
                                   </span>
                                @enderror
                            </div>

                            <div class=" mb-3">
                                <label class="form-label">Email</label>

                                <input
                                    value="{{old('email', $contact->email)}}"
                                    form="contactUpdateForm"
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                >
                                @error('email')
                                <span class="invalid-feedback">
                                       {{$message}}
                                   </span>
                                @enderror
                            </div>

                            <div class=" mb-3">
                                <label class="form-label" for="">phone</label>
                                <input
                                    value="{{old('phone',$contact->phone)}}"
                                    form="contactUpdateForm"
                                    type="number"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                >
                                @error('phone')
                                <span class="invalid-feedback">
                                       {{$message}}
                                   </span>
                                @enderror</div>

                            <div class=" mb-3">
                                <label class="form-label" for="">job Title</label>

                                <input
                                    value="{{old('jobTitle', $contact->jobTitle)}}"
                                    form="contactCreateForm"
                                    type="text"
                                    name="jobTitle"
                                    class="form-control" placeholder="Password">

                            </div>

                            <div class="">
                                <label class="form-label" for="">Birthday</label>

                                <input
                                    value="{{old('birthday', $contact->birthday)}}"
                                    form="contactCreateForm"
                                    type="text"
                                    name="birthday"
                                    class="form-control" >
                            </div>

                            <div class="mt-3">
                                <label  class="form-label">note</label>
                                <textarea  form="contactUpdateForm"
                                           type="text"
                                           name="note" class="form-control " placeholder="Password"
                                >
                                    {{old('note',$contact->note)}}
                                </textarea>

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>

        <form
            action="{{route('contact.update',$contact->id)}}"
            id="contactUpdateForm"
              method="post"
            enctype="multipart/form-data"
        >

            @csrf
            @method('put')
        </form>
    </div>
@endsection
