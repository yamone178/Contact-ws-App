@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between align-items-end ">
                            <div class="d-inline-block position-relative create-contact-img">
                                <img src="{{asset('localImages/profile.png')}}" class="rounded-circle contact-Img-area position-relative" width="150px" alt="">

                                <img src=""  class=" outputImg rounded-circle contact-Img-area position-relative d-none" width="150px" height="150px" style="object-fit: cover" alt="">

                                <div class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class=""><path d="M0 0h24v24H0z" fill="none"></path><path d="M20 10h-2V7h-3V5h3V2h2v3h3v2h-3v3zm-4 3c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4zm4-1v7H4V7h9V3H9L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-7h-2z"></path></svg>

                                </div>


                            </div>

                            <input type="file"
                                   form="contactCreateForm"
                                   hidden name="image"
                                   class="contact-imgInput"

                            >

                            <div  class="">
                                <button form="contactCreateForm" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class=" mb-3">

                                <label class="form-label">First Name</label>

                                <input
                                    form="contactCreateForm"
                                    type="text"
                                    name="firstName"
                                    value="{{old('firstName')}}"

                                    class="form-control
                                    @error('firstName') is-invalid @enderror
                                     ">

                                    @error('firstName')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                    @enderror

                            </div>

                            <div class=" mb-3">
                                <label class="form-label">Last Name</label>
                                <input
                                    form="contactCreateForm"
                                    type="text"
                                       name="lastName"
                                       class="form-control
                                       @error('lastName') is-invalid @enderror"
                                    value="{{old('lastName')}}"
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
                                    value="{{old('email')}}"
                                    form="contactCreateForm"
                                    type="email"
                                    name="email"
                                    class="form-control
                                    @error('email') is-invalid @enderror"
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
                                    value="{{old('phone')}}"
                                    form="contactCreateForm"
                                    type="number"
                                    name="phone"
                                    class="form-control
                                    @error('firstName') is-invalid @enderror
                                    "
                                >
                                @error('phone')
                                <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                @enderror

                            </div>

                            <div class=" mb-3">
                                <label class="form-label" for="">job Title</label>

                                <input
                                    value="{{old('jobTitle')}}"
                                    form="contactCreateForm"
                                    type="text"
                                    name="jobTitle"
                                    class="form-control">

                            </div>

                            <div class="">
                                <label class="form-label" for="">Birthday</label>

                                <input
                                    value="{{old('birthday')}}"
                                    form="contactCreateForm"
                                    type="text"
                                    name="birthday"
                                    class="form-control">
                            </div>

                            <div class="mt-3">
                                <label  class="form-label">note</label>
                                <textarea

                                    form="contactCreateForm"
                                    type="text"
                                    name="note" class="form-control " >
                                    {{old('note')}}
                                </textarea>

                            </div>

                            </textarea>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('contact.store')}}" id="contactCreateForm" method="post" enctype="multipart/form-data">
            @csrf
        </form>
    </div>
@endsection
