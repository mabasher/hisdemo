@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
<style>
.tree li {
    list-style-type: none;
    margin: 0;
    padding: 10px 5px 0 5px;
    position: relative
}

.tree li::before,
.tree li::after {
    content: '';
    left: -20px;
    position: absolute;
    right: auto
}

.tree li::before {
    border-left: 2px solid #000;
    bottom: 50px;
    height: 100%;
    top: 0;
    width: 1px
}

.tree li::after {
    border-top: 2px solid #000;
    height: 20px;
    top: 25px;
    width: 25px
}

.tree li span {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border: 2px solid #000;
    border-radius: 3px;
    display: inline-block;
    padding: 3px 8px;
    text-decoration: none;
    cursor: pointer;
}

.tree>ul>li::before,
.tree>ul>li::after {
    border: 0
}

.tree li:last-child::before {
    height: 27px
}

/* 
.tree li span:hover {
    background: hotpink;
    border: 2px solid #94a0b4;
} */

[aria-expanded="false"]>.expanded,
[aria-expanded="true"]>.collapsed {
    display: none;
}
</style>
@endsection
@section('content')

<div class="content">
    <div class="row">
        <div class="col-sm-5 col-5">
            <h4 class="page-title">Role Wise Menu Information</h4>
        </div>
    </div>
    <!-- start -->
    <div class="tree ">

        <ul>
            @foreach($menus as $m)
            <li>
                <span>
                    <a href="#Web" aria-expanded="true" aria-controls="Web">
                        <input type="checkbox" id="menuId" value="{{$m->id}}" />
                        <label class="checkbox-inline" aria-describedby="ProcessingConsultantYN"
                            id="" for="ProcessingConsultantYN">{{$m->name}}</label>
                    </a>
                </span>
                <div id="Web">
                    <ul>
                        @foreach($m->submenus as $sm)
                        <li><span><a style="color:#000; text-decoration:none;" href="#page1" aria-expanded="false">
                                    <input type="checkbox" id="submenuId" value="{{$sm->id}}" />
                                    <label class="checkbox-inline" aria-describedby="ProcessingConsultantYN"
                                        id=""
                                        for="ProcessingConsultantYN">{{$sm->name}}</label></a></span>
                            <ul>
                                <div id="page1">
                                    @foreach($sm->ssubmenus as $ssm)
                                    <li>
                                        <span>
                                            <input type="checkbox" id="ssubmenuId" value="{{$ssm->id}}" />
                                            <label class="checkbox-inline" aria-describedby="ProcessingConsultantYN"
                                                id="" for="ProcessingConsultantYN">{{$ssm->name}}</label>
                                        </span>
                                    </li>
                                    @endforeach
                                    <!-- <li><span><i class="far fa-file"></i><a href="#!"> Link 2</a></span></li>
                                    <li><span><i class="far fa-file"></i><a href="#!"> Link 3</a></span></li>
                                    <li><span><i class="far fa-file"></i><a href="#!"> Link 4</a></span></li> -->
                                </div>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
    <!-- end -->
</div>


<div id="delete_department" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('admin/img/sent.png')}}" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Department?</h3>
                <input id="deleteId" type="hidden">
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <a class="btn btn-danger deleteConfirm">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
// $(function(){
//     $('.dlt').on('click',function(e){
//     e.preventDefault();
//     $('#deleteId').val($(this).attr('data-id'));
//     $('#delete_department').modal('show');
//     });

//     $('.deleteConfirm').on('click',function(e){
//     e.preventDefault();
//     var id = $('#deleteId').val();
//     var url = "{{url('deptDelete')}}/" + id;
//     $(this).prop("href", url);
//     $('#delete_department').modal('hide');
//     })
// })
</script>
@endsection