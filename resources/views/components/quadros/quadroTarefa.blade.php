<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2" id="card-{{$item->id}}"
         style="background-size: cover; position: relative;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center">
                        <div style="margin-right: 8px; font-size: 15px;"
                             class="font-weight-bold text-primary text-uppercase mb-1">
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="ml-2" href="{{route($route,$id)}}">
            <input type="button" class="btn btn-primary font-weight-bold shadow" value="Board">
        </a>
        <div class="position-absolute m-0">
            <div
                class="bg-gradient-light px-2 font-weight-bold text-primary">{{$nome}}
            </div>
        </div>

    </div>
</div>
