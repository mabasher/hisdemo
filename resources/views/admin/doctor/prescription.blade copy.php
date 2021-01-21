@extends('layouts.app')
@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<style>
body {
    background-color: #f9f9fa
}

.flex {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

@media (max-width:991.98px) {
    .padding {
        padding: 1.5rem
    }
}

@media (max-width:767.98px) {
    .padding {
        padding: 1rem
    }
}

.padding {
    padding: 5rem
}

.card {
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none
}

.pl-3,
.px-3 {
    padding-left: 1rem !important
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #d2d2dc;
    border-radius: 0
}

.card .card-title {
    color: #000000;
    margin-bottom: 0.625rem;
    font-size: 0.875rem;
    font-weight: 500
}

.card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f
}

p {
    font-size: 0.875rem;
    margin-bottom: .5rem;
    line-height: 1.5rem
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar
}

.table,
.jsgrid .jsgrid-table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent
}

.table thead th,
.jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: 500;
    font-size: .875rem;
    text-transform: uppercase
}

.table td,
.jsgrid .jsgrid-table td {
    font-size: 0.875rem;
    padding: .475rem 0.4375rem
}

.mt-10 {
    padding: 0.875rem 0.3375rem !important
}

button {
    outline: 0 !important
}

.form-control:focus {
    box-shadow: 0 0 0 0rem rgba(0, 123, 255, .25) !important
}

.badge {
    border-radius: 0;
    font-size: 12px;
    line-height: 1;
    padding: .375rem .5625rem;
    font-weight: normal;
    border: none
}
</style>
@endsection
@section('content')
<div class="content">
    <div class="row">
        <aside class="col-md-10 m-auto">
            <div class="widget category-widget">
                <h5>Patient Information</h5>
                <!-- <form class="search-form">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form> -->
            </div>
        </aside>
        <div class="col-md-12 m-auto">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form autocomplete="off" method="POST" action="{{url('SaveDoctor')}}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="Mobile/Phone No">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>Office Phone</label>
                                    <input class="form-control" type="text" name="office_phone" placeholder="Office Phone">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>Chamber/Room</label>
                                    <select class="custom-select" id="room" name="doc_chember">
                                        <option value="">Select Doctor Chamber</option>
                                    

                                    </select>
                                    <!-- <input class="form-control" type="text" name="doc_chember" placeholder="Chamber/Room"> -->
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>Floor</label>
                                    <input class="form-control" type="text" placeholder="Floor" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Building</label>
                                <input class="form-control" type="text" placeholder="Building" >
                            </div> 
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{url('doctormenu')}}" class="btn btn-success">Back</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-box">
                <!-- <h6 class="card-title">Bottom line justified</h6> -->
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1"
                            data-toggle="tab">Medication</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2"
                            data-toggle="tab">Investigation</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3" data-toggle="tab">Messages</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="bottom-justified-tab1">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center"><button onclick="addfaqs();" class="badge badge-success"><i
                                            class="fa fa-plus"></i> ADD NEW</button></div>
                                <!-- <h4 class="card-title text-center">Add and remove row in table using jquery</h4> -->
                                <hr>
                                <div class="table-responsive">
                                    <table id="faqs" class="table table-hover">
                                        <!--<thead>
                                            <tr>
                                                <th>Therapeutic Group</th>
                                                <th>Generic</th>
                                                <th>Brand</th>
                                                <th>Dis.Form</th>
                                                 <th>Stock</th>
                                                <th>Dose/Take</th>
                                                <th>Frequency</th>
                                                <th>Duration</th>
                                                <th>Dpt. Detail</th> 
                                            </tr>
                                        </thead>-->
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="text" class="form-control" placeholder="Therapeutic Group">
                                                    <!-- <input type="text" placeholder="Brand" class="form-control" style="width:120px; float:right;"> -->
                                            
                                                    <input type="text" placeholder="Generic" class="form-control">
                                                    <input type="text" placeholder="Brand Name" class="form-control">
                                                    <!-- <input type="text" placeholder="Product name" class="form-control"> -->
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Dis. Form" class="form-control">
                                                    <input type="text" placeholder="Stock" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Dose/Take" class="form-control">
                                                    <select class="custom-select" name="frequency" >
                                                        <option value="">Frequency</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Duration" class="form-control">
                                                    <select class="custom-select" name="frequency" >
                                                        <option value="">Hour's</option>
                                                        <option value="">Days</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="DPT.Detail" class="form-control">
                                                    <input type="text" placeholder="Pres.Qty" class="form-control">
                                                </td>
                                                <td>
                                                    <select class="custom-select" name="frequency" >
                                                        <option value="">Route</option>
                                                    </select>
                                                    <select class="custom-select" name="frequency" >
                                                        <option value="">Instruction</option>
                                                        <option value="">hs</option>
                                                        <option value="">ad</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Start At" class="form-control">
                                                    <select class="custom-select" name="frequency" >
                                                        <option value="">Priority</option>
                                                        <option value="">Routine</option>
                                                        <option value="">Urgent</option>
                                                        <option value="">Stat</option>
                                                    </select>
                                                </td>
                                                <td class="mt-10"><button class="badge badge-danger"><i
                                                            class="fa fa-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        Tab content 2
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab3">
                        Tab content 3
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
// $(function() {
//     var date = new Date();
//     var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 4);
//     var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());


//     $('#toDate').datepicker({
//         format: "dd-M-yyyy DD",
//         autoclose: true,
//         todayHighlight: true,
//         changeMonth: true,
//         changeYear: true,
//         startDate: fstday,
//         endDate: date,
//         inline: true

//     });
//     $('#toDate').datepicker('setDate', today);

// });

var faqs_row = 0;
function addfaqs() {
html = '<tr id="faqs-row' + faqs_row + '">';
    html += '<td><input type="text" class="form-control" placeholder="User name"></td>';
    html += '<td><input type="text" placeholder="Product name" class="form-control"></td>';
    html += '<td><input type="text" placeholder="Product name" class="form-control"></td>';
    html += '<td class="mt-10"><button class="badge badge-danger" onclick="$(\'#faqs-row' + faqs_row + '\').remove();"><i class="fa fa-trash"></i></button></td>';

    html += '</tr>';

$('#faqs tbody').append(html);

faqs_row++;
}
</script>
@endsection