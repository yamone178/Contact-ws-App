

<div class="bg-white shadow-sm p-3  min-vh-100 sidebar">

    <div class="">
        <div class="list-group fs-base">
            <a href="{{route('contact.create')}}" class="list-group-item p-2">

                <div class=" p-2 rounded-pill shadow-sm" style="width: 200px">
                    <svg width="36" height="36" viewBox="0 0 36 36"><path fill="#34A853" d="M16 16v14h4V20z"></path><path fill="#4285F4" d="M30 16H20l-4 4h14z"></path><path fill="#FBBC05" d="M6 16v4h10l4-4z"></path><path fill="#EA4335" d="M20 16V6h-4v14z"></path><path fill="none" d="M0 0h36v36H0z"></path></svg>
                    <span>Create Contact</span>
                </div>

            </a>
            <a href="{{route('contact.index')}}" class="list-group-item fs-5">
                <span class=" me-3">
                    <svg width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe undefined"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 9c2.7 0 5.8 1.29 6 2v1H6v-.99c.2-.72 3.3-2.01 6-2.01m0-11C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"></path></svg>
                </span>
                <span>Contacts</span>
            </a>

            <a href="{{route('contact.noti')}}" class="list-group-item fs-5">
                <span>Noti</span>
            </a>


            <hr>





            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button fs-base" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <i class=" me-2 bi bi-file-richtext"></i>
                            Labels
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body px-0">
                            <div class="list-group ">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#labelModal">
                                    <span class="bi bi-plus"></span>
                                    Create Label
                                </button>

                                @foreach(\App\Models\Label::latest('id')->get() as $label)

                                    <span>
                                        <div class="position-relative">
                                            <a href="{{route('label.show',$label->id)}}" id="renameForm" class="list-group-item d-flex justify-content-between ">


                                                <span class="">
                                                    <i class=" me-2 bi bi-journal-arrow-up"></i>
                                                    <span>
                                                        {{$label->name}}
                                                    </span>
                                                </span>



                                            </a>



                                        <div class="position-absolute d-flex align-items-center h-100" style="right: 0; z-index: 2; top: 0">
                                           <span  class="renameBtn me-2" data-bs-toggle="modal" data-bs-target="#editLabelModal{{$label->id}}">
                                               <i class="bi bi-pencil"></i>
                                            </span>
                                            <form action="{{route('label.destroy',$label->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>

                                        </div>
                                    </span>


                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

            </div>


            <a href="{{route('contact.index')}}" class="list-group-item fs-5">

            </a>

            <form action="{{route('contact.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="contacts">

                <button class="btn btn-lg">

                     <span class=" me-3">
                    <svg width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe null"><path d="M4 15h2v3h12v-3h2v3c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2m4.41-7.59L11 7.83V16h2V7.83l2.59 2.59L17 9l-5-5-5 5 1.41 1.41z"></path></svg>                </span>
                    <span>Import</span>

                </button>


            </form>

            <a href="{{route('contact.export')}}" class="list-group-item fs-5">
                <span class=" me-3">
                    <i class="bi bi-cloud-arrow-down"></i>
                </span>
                    <span>Export</span>
            </a>

            <a href="" class="list-group-item fs-5">
                <span class=" me-3">
                    <i class="bi bi-printer"></i>
                </span>
                <span>Print</span>
            </a>

            <hr>

            <a href="{{route('contact.trash')}}" class="list-group-item fs-5">
                <span class=" me-3">
                    <i class="bi bi-trash3"></i>
                </span>
                <span>Trash</span>
            </a>




        </div>
    </div>

</div>

<div class="modal" id="labelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Label</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('label.store')}}" id="createLabelForm" method="post">
                    @csrf
                    <label for="Form Label">name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                    @error('name')
                    <span class="invalid-feedback">
                      {{$message}}
                    </span>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button form="createLabelForm"  class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@foreach(\App\Models\Label::latest('id')->get() as $label)
    <div class="modal" id="editLabelModal{{$label->id}}" tabindex="-1" aria-labelledby="editLabelModal{{$label->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabelModal{{$label->id}}">Rename Label</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('label.update',$label->id)}}" id="updateLabelForm{{$label->id}}" method="post">
                        @method('put')
                        @csrf
                        <label for="Form Label">name</label>
                        <input form="updateLabelForm{{$label->id}}" value="{{old('name',$label->name)}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name')
                        <span class="invalid-feedback">
                      {{$message}}
                    </span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="updateLabelForm{{$label->id}}"  class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endforeach

