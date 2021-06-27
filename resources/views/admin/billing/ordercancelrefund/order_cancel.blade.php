@extends('layouts.app')
@section('css')
<style>
body {
    background: #74ebd5;
    background: -webkit-linear-gradient(to right, #74ebd5, #ACB6E5);
    background: linear-gradient(to right, #74ebd5, #ACB6E5);
    min-height: 100vh;

}

#addScnt {
    color: #fff;
}

.form-control {
    border-radius: 0px;
}

#addScnt,
#remScnt {
    text-decoration: none;
    padding: 5px 25px;
}

#addScnt {
    color: #fff;
}

#remScnt {
    color: #c23f44;
}

/* .tx-lg {
        width: 175px !important;
    }

    .tx-md {
        width: 130px !important;
    }

    .tx-sm {
        width: 80px !important;
    } */

.col-md {
    position: relative;
    width: 100%;
    padding-right: 0px;
    padding-left: 15px;
}

input[type=text] {
    width: 100% !important;
}

.form-group {
    margin-bottom: 0.1rem !important;
}

.form-control {
    min-height: 38px;
}

.bootstrap-select>.dropdown-toggle {
    width: 220px !important;

}

.red {
    background-color: #EE2436;
}
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


@endsection
@section('content')
<div class="content">
    <div class="row m-auto">
        <div class="col-md-12">
            <form autocomplete="off" method="POST" action="{{url('dueCollectionSave')}}">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card w-100 p-3">
                            <div class="row">
                                <div class="col">
                                    <label for="">Invoice No</label>
                                    <input type="text" id="invoiceNo" class="form-control" name="invoice_no"
                                        placeholder="Search Invoice" required autofocus autocomplete="off">
                                </div>
                                <div class="col">
                                    <label for="">PID</label>
                                    <input type="text" id="pid" class="form-control" name="reg_no" placeholder="PID"
                                        readonly autofocus autocomplete="off">
                                </div>
                                <div class="col">
                                    <label for="">CID</label>
                                    <input type="text" id="cid" class="form-control" name="consult_no" readonly
                                        placeholder="CID">
                                </div>
                                <div class="col">
                                    <label for="">Patient Name</label>
                                    <input type="text" id="fulName" class="form-control" readonly
                                        placeholder="Patient Name">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Age & Gender</label>
                                    <input type="text" id="dob" class="form-control" readonly placeholder="Age">
                                </div>
                                <div class="col">
                                    <label for="">Contact No</label>
                                    <input type="text" id="mobile" class="form-control" readonly
                                        placeholder="Contact No">
                                </div>
                                <div class="col">
                                    <label for="">Cash Point</label>
                                    <select class="form-control" id="exampleFormControlSelect1" readonly>
                                        <option value="OC">OPD Billing</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Care Giver</label>
                                    <input type="text" id="doctor" class="form-control" readonly
                                        placeholder="Care Giver">
                                    <input type="hidden" id="doctorNo" class="form-control" name="consult_by" readonly
                                        placeholder="Care Giver">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header text-success border-bottom">
                                <b>TODAYS SUMMARY</b>
                            </div>
                            <div class="card-body">
                                <h6 class="">Cashier :<span class="ml-2">{{auth()->user()->name}}</span></h6>
                                <h6 class="">Total Amount :<span class="ml-2">{{ $totalAmount->sum('dr_amt') }}</span>
                                </h6>
                                <h6 class="">Total Invoice :<span class="ml-2">{{ $totalInvoice->count() }}</span></h6>
                                <a href="" class="btn btn-xs btn-success">Show Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-100 p-3">
                    <div class="col-md-5 m-auto">
                        <div class="row">
                            <div class="col text-center">
                                <h4 class="text-primary">Order Cancel</h4>
                            </div>
                        </div>
                    </div>
                    <div id="serviceShow"></div>
                </div>
                <div class="card w-100 p-3">

                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 m-auto">
                            <div class="card">
                                <div class="card-body d-flex justify-content-around">
                                    <button type="submit" class="btn btn-outline-primary">Order Cancel</button>
                                    <button type="button" class="btn btn-outline-secondary">Refund</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
$(function() {

});


$('#invoiceNo').keypress(function(e) {
    var invoiceNo = $('#invoiceNo').val();
    if (e.which == 13) {
        getPatientInfo(invoiceNo);
        event.preventDefault();
        return false;
    }
})


function getPatientInfo(invoiceNo) {
    $.ajax({
        url: "{{url('duecollectionHistory')}}/" + invoiceNo,
        type: 'get',
        success: function(data) {
            var gender = data.patientDemgraphy.patientinfo.gender == 'M' ? 'Male' : (data.patientDemgraphy
                .patientinfo.gender == 'F' ? 'Female' : 'Others');
            // var receivable = data.prvCollectAmt[1].cramt - (data.prvCollectAmt[2].dramt + data.prvCollectAmt[0].dramt);
            var receivable = parseInt(data.prvCollectAmt[1].cramt) - parseInt(data.prvCollectAmt[2].dramt) -
                parseInt(data.prvCollectAmt[0].dramt);
            $('#pid').val(data.patientDemgraphy.patientinfo.reg_no);
            $('#cid').val(data.patientDemgraphy.consult_no);
            $('#fulName').val(data.patientDemgraphy.patientinfo.salutation_id ? data.patientDemgraphy
                .patientinfo.salutation_id + ' ' + data.patientDemgraphy
                .patientinfo.ful_name : '' + ' ' + data.patientDemgraphy
                .patientinfo.ful_name);
            $('#mobile').val(data.patientDemgraphy.patientinfo.mobile);
            $('#doctor').val(data.patientDemgraphy.consultation.designation + ' ' + data.patientDemgraphy
                .consultation.doctor_name);
            $('#doctorNo').val(data.patientDemgraphy.consultation.id);
            $('#dob').val(data.Age + ', ' + gender);
            $('#grantTotal').val(data.prvCollectAmt[1].cramt);
            $('#discountAmt').val(data.prvCollectAmt[0].dramt);
            $('#paidAmt').val(data.prvCollectAmt[2].dramt);
            $('#receivableAmt').val(receivable);
            $('#dueAmt').val(receivable);
            getTestForCancelOrder(invoiceNo);

        }
    })
}

function getTestForCancelOrder(invoiceNo) {
    $.ajax({
        url: "{{url('cancelServices')}}/" + invoiceNo,
        type: 'get',
        success: function(data) {
            $('#serviceShow').html(data);
        }
    })
}


</script>
@stop