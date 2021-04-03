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
    
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


@endsection
@section('content')
<div class="content">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card w-100 p-3">
                        <div class="row">
                            <div class="col">
                                <label for="">PID</label>
                                <input type="text" id="pid" class="form-control" placeholder="Search PID" autofocus autocomplete="off">
                            </div>
                            <div class="col">
                                <label for="">CID</label>
                                <input type="text" id="cid" class="form-control" readonly placeholder="CID">
                            </div>
                            <div class="col">
                                <label for="">Patient Name</label>
                                <input type="text" id="fulName" class="form-control" readonly placeholder="Patient Name">
                            </div>
                            <div class="col">
                                <label for="">Age & Gender</label>
                                <input type="text" id="dob" class="form-control" readonly placeholder="Age">
                            </div>
                            <!-- <div class="col">
                                    <label for="">Gender</label>
                                    <input type="text" class="form-control" placeholder="Gender">
                                </div> -->
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Contact No</label>
                                <input type="text" id="mobile" class="form-control" readonly placeholder="Contact No">
                            </div>
                            <div class="col">
                                <label for="">Cash Point</label>
                                <select class="form-control" id="exampleFormControlSelect1" readonly>
                                    <option value="OC">OPD Billing</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Ref By</label>
                                <input type="text" class="form-control" readonly placeholder="Referred by">
                            </div>
                            <div class="col">
                                <label for="">Care Giver</label>
                                <input type="text" id="doctor" class="form-control" readonly placeholder="Care Giver">
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
                            <h6 class="">Cashier</h6>
                            <h6 class="">Total Amount</h6>
                            <h6 class="">Total Invoice</h6>
                            <a href="#" class="btn btn-xs btn-success">Show Details</a>
                        </div>
                        <!-- <div class="card-footer text-muted">
                                2 days ago
                            </div> -->
                    </div>
                </div>
            </div>
            <div class="card w-100 p-3">
                <div class="col-md-5 m-auto">
                    <div class="row">

                        <div class="col">
                            <h3 class="text-center text-success">
                                <select class="form-control" id="testName2" style="height:22px">
                                    <option value="">PRESS CTRL + SPACE BAR or MOUSE CLICK</option>

                                    @foreach($testshow as $ts)
                                    <option value="{{$ts->test_no}}">{{$ts->test_name.' Tk.'.$ts->rate}}</option>
                                    @endforeach
                                </select>
                            </h3>
                        </div>
                        <!-- <div class="col">
                            <select id="testName2" class="form-control">
                                <option value="">Please Press CTRL+X or Mouse click</option>
                                @foreach($testshow as $ts)
                                <option value="{{$ts->test_no}}">{{$ts->test_name}}</option>
                                @endforeach
                            </select>
                        </div> -->
                    </div>
                </div>

                <form class="form-inline" role="form">
                    <table id="p_scents">
                        <thead id="prompt" style="display:none">
                            <tr class="text-center">
                                <th>Investigation</th>
                                <th>Department</th>
                                <th>Rate</th>
                                <th>Discount%</th>
                                <th>Discount Fixed</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="frm_scents">

                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card w-100 p-3">
                <div class="row">

                    <div class="col-sm-12 col-md-10 col-lg-6 m-auto">
                        <div class="card">
                            <!-- <div class="card-header text-success border-bottom">
                                    <b>TODAYS SUMMARY</b>
                                </div> -->
                            <div class="card-body border border-info">
                                <div class="text-center mb-2">
                                    <button type="button" class="btn btn-sm btn-success">Invoice</button>
                                    <button type="button" id="newBill" class="btn btn-sm btn-success">New Bill</button>
                                    <button type="button" class="btn btn-sm btn-success">Make Quick PID </button>
                                    <button type="button" class="btn btn-sm btn-success">Cancel Order</button>
                                </div>
                                <div class="form-group row">
                                    <label for="grantTotal" class="col-sm-4 col-form-label col-form-label-sm">Grant Total</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control grantTotal" value="0" readonly id="grantTotal" name="total" placeholder="Grant Total" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="grantTotal" class="col-sm-4 col-form-label col-form-label-sm">Receivable Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control receivableAmt" value="0" readonly id="receivableAmt" name="total" placeholder="Grant Total" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="discount" class="col-sm-4 col-form-label col-form-label-sm">Discount</label>
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" min="0" id="overalldiscount" placeholder="Fixed Discount" />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" min="0" id="overalldisPercent" placeholder="Discount %" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="paidAmt" class="col-sm-4 col-form-label col-form-label-sm">Paid Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" value="0" readonly id="paidAmt" placeholder="Paid Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="receiveAmt" class="col-sm-4 col-form-label col-form-label-sm">Received Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" min="0" id="receiveAmt" placeholder="Received Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="discount" class="col-sm-4 col-form-label col-form-label-sm">Return || Due Amount</label>
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                            <input type="number" class="form-control" readonly id="returnAmt" placeholder="Return Amount" />
                                            </div>
                                            <div class="col-md-6">
                                            <input type="number" class="form-control" readonly id="dueAmt" placeholder="Due Amount" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                    <label for="returnAmt" class="col-sm-4 col-form-label col-form-label-sm">Change Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" value="0" readonly id="returnAmt" placeholder="Change Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dueAmt" class="col-sm-4 col-form-label col-form-label-sm">Due Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" value="0" readonly id="dueAmt" placeholder="Due Amount" />
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="card-footer text-muted">
                                    2 days ago
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
    $('#newBill').on('click', function() {
        $('#pid').val('');
        $('#cid').val('');
        $('#fulName').val('');
        $('#mobile').val('');
        $('#doctor').val('');
        $('#dob').val('');
    })


    $(document).on('keyup', '.disPercent', function() {
        let discount = $(this).val();
        if ($(this).attr('data-id') === 'disPercent') {
            let id = $(this).attr('data-dept');

            let amount = $('#totalAmt_d_' + id).attr('data-original');
            let disAmount = amount * discount / 100;
            let amountAfterDiscount = amount - disAmount;
            $('#totalAmt_d_' + id).val(amountAfterDiscount);
        } else {
            let id = $(this).attr('id').split('_');

            let amount = $('#totalAmt_' + id[1]).attr('data-original');
            let disAmount = amount * discount / 100;
            let amountAfterDiscount = amount - disAmount;
            $('#totalAmt_' + id[1]).val(amountAfterDiscount);
        }
        invoiceSum();
    })

    $(document).on('keyup', '.disFixed', function() {
        let discount = $(this).val();
        if ($(this).attr('data-id') === 'disFixed') {
            let id = $(this).attr('data-dept');
            let amount = $('#totalAmt_d_' + id).attr('data-original');
            let amountAfterDiscount = amount - discount;
            $('#totalAmt_d_' + id).val(amountAfterDiscount);
        } else {
            let id = $(this).attr('id').split('_');

            let amount = $('#totalAmt_' + id[1]).attr('data-original');
            let amountAfterDiscount = amount - discount;
            $('#totalAmt_' + id[1]).val(amountAfterDiscount);

        }
        invoiceSum();
    })

    $('#pid').keypress(function(e) {
        var pid = $('#pid').val();
        if (e.which == 13) {
            getPatientInfo(pid);
        }
        console.log(pid);
    })


    function getPatientInfo(regNo) {
        $.ajax({
            url: "{{url('patientBilling')}}/" + regNo,
            type: 'get',
            success: function(data) {
                var gender = data.Billing.pat_appinfo.gender == 'M' ? 'Male' : (data.Billing.pat_appinfo.gender == 'F' ? 'Female' : 'Others');
                $('#pid').val(data.Billing.reg_no);
                $('#cid').val(data.Billing.consult_no);
                $('#fulName').val(data.Billing.pat_appinfo.salutation_id + ' ' + data.Billing.pat_appinfo.ful_name);
                $('#mobile').val(data.Billing.pat_appinfo.mobile);
                $('#doctor').val(data.Billing.consultation.designation + ' ' + data.Billing.consultation.doctor_name);
                $('#dob').val(data.Age + ', ' + gender);
                getPrescripTest(regNo);

            }
        })
    }

    function getPrescripTest(regNo) {
        $.ajax({
            url: "{{url('patientTest')}}/" + regNo,
            type: 'get',
            success: function(data) {
                $('#p_scents').html(data);
                invoiceSum();

            }
        })
    }

    function getTestRelatedVal(testNo) {
        $.ajax({
            url: "{{url('testsearchGetVal')}}/" + testNo,
            type: 'get',
            success: function(data) {
                $('#prompt').show();
                $("#frm_scents").append(data);
                $('#testName2').val(null).trigger('change');
                $('#testName2').select2('open');
                invoiceSum();
                getDuplicateRemove();
            }
        })
    }



    /// Select 2 Search
    function matchCustom(params, data) {
        if ($.trim(params.term) === '') {
            return data;
        }

        if (typeof data.text === 'undefined') {
            return null;
        }

        if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
            var modifiedData = $.extend({}, data, true);
            return modifiedData;
        }
        return null;
    }


    $("#testName2").select2({
        matcher: matchCustom
    });


    $('#testName2').on('select2:closing', function(event) {
        var value = $(this).val();
        getTestRelatedVal(value);
                
    });

    $(document).keydown(function(event) {
        if (event.ctrlKey && event.which === 32) {
            $('#testName2').select2('open');
            e.preventDefault();
        }
    });

    function invoiceSum() {
        var sum = 0;
        $(".totalAmt").each(function() {
            sum += +$(this).val();
        });
        $("#grantTotal").val(sum);
        $("#receivableAmt").val(sum)
    }

    $(document).on("change", ".totalAmt", function() {
        invoiceSum();

    });


    $(document).on('keyup', '#overalldiscount', function() {
        let discount = 0;
        let totalAmt = 0;
        let receivableAmt = 0;
        let paidAmt = 0;
        let disval = $(this).val();
        let rcvAmt = $('#receiveAmt').val();
        let changAmt = 0;
        let dueAmt = 0;

        if (disval == '' || disval == null) {
            disval = 0;
        }
        discount = parseInt(disval);
        totalAmt = parseInt($('#grantTotal').val());
        receivableAmt = totalAmt - discount;
        netAmt = totalAmt - dueAmt;
        $("#receivableAmt").val(receivableAmt);

        if (rcvAmt > receivableAmt) {
            changAmt = rcvAmt - receivableAmt
            $("#paidAmt").val(receivableAmt);
            $("#returnAmt").val(changAmt);
            $("#dueAmt").val(0);
        } else {
            dueAmt = receivableAmt - rcvAmt;
            $("#dueAmt").val(dueAmt);
            $("#paidAmt").val(rcvAmt);
            $("#returnAmt").val(0);
        }
    });

    $(document).on('keyup', '#overalldisPercent', function() {
        let discount = 0;
        let totalAmt = 0;
        let receivableAmt = 0;
        let paidAmt = 0;
        let disPercent = 0;
        let disval = $(this).val();
        let rcvAmt = $('#receiveAmt').val();
        let changAmt = 0;
        let dueAmt = 0;

        if (disval == '' || disval == null) {
            disval = 0;
        }
        discount = parseInt(disval);
        totalAmt = parseInt($('#grantTotal').val());
        disPercent = totalAmt * discount / 100;
        receivableAmt = totalAmt - disPercent;
        $("#receivableAmt").val(receivableAmt);

        if (rcvAmt > receivableAmt) {
            changAmt = rcvAmt - receivableAmt
            $("#paidAmt").val(receivableAmt);
            $("#returnAmt").val(changAmt);
            $("#dueAmt").val(0);
        } else {
            dueAmt = receivableAmt - rcvAmt;
            $("#dueAmt").val(dueAmt);
            $("#paidAmt").val(rcvAmt);
            $("#returnAmt").val(0);
        }
    });

    $(document).on('keyup', '#receiveAmt', function() {
        let rcvAmt = 0;
        let receivableAmt = 0;
        let paidAmt = 0;
        let changAmt = 0;
        let dueAmt = 0;
        let totalAmt = 0;
        let discount = 0;
        let rcvval = $(this).val();

        receivableAmt = parseInt($('#receivableAmt').val())


        if (rcvval == '' || rcvval == null) {
            rcvval = 0;
        }
        rcvAmt = parseInt(rcvval);
        // receivableAmt = totalAmt - discount;

        if (rcvAmt > receivableAmt) {
            // paidAmt = totalAmt - discount;
            changAmt = rcvAmt - receivableAmt
            $("#paidAmt").val(receivableAmt);
            $("#returnAmt").val(changAmt);
            $("#dueAmt").val(0);
        } else {
            dueAmt = receivableAmt - rcvAmt;
            $("#dueAmt").val(dueAmt);
            $("#paidAmt").val(rcvAmt);
            $("#returnAmt").val(0);
        }
    });


    // function getDuplicateRemove() {
    //     for (var i = 0; i < $('table tbody tr').length; i++) {
    //         for (var j = 0; j < $('table tbody tr').length; j++) {
    //             if ($('table tbody tr').eq(i).html() == $('table tbody tr').eq(j).html() && i != j) {
    //                 $('table tbody tr').eq(j).remove();
    //                 invoiceSum();
    //             }
    //         }
    //     }
    // }

</script>
@stop