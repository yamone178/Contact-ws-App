

<div class="bg-white shadow-sm p-3 position-relative min-vh-100  position-fixed" style="z-index: 1; width: 270px">

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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <span class="bi bi-plus"></span>
                                    Create Label
                                </button>
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




        </div>
    </div>

</div>
