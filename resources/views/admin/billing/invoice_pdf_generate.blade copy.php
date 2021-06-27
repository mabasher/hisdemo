<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <style type="text/css">
    @page {
        margin: 10 auto;
    }


    .img {
        margin-top: 15px;
    }

    .imgsize {
        width: 50px;
    }
    </style>

</head>

<body>
    <div class="card header">
        <div class="">
            <h5 class="text-center text-success">Darco Technologies Ltd.</h5>
            <hr>
        </div>
        <div class="card-body">

            <div class="my-2">
                <div class="card-body">
                    <h6 class="card-title">Patient Name: <span class="text-success">{{$registration->ful_name}}</span>
                    </h6>
                    <h6 class="card-title">PID: <span class="text-success">{{$registration->reg_no}}</span></h6>
                </div>

            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Investigation</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->invoicedetails as $inv)
                    <tr>
                        <th scope="row">{{$loop->iteration}} </th>
                        <td>{{$inv->investigations?$inv->investigations->test_name:'Total'}}</td>
                        <td>{{$inv->bill_amt}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-6 col-sm-6">

                </div>

                <div class="col-6 col-sm-6">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Gross Total</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Net Amount</th>
                                <th scope="col">Received Amount</th>
                                <th scope="col">
                                    {{$invoice->invoicedetails->sum('bill_amt')> $netAmt->dr_amt?'Due ':'Return '}}Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoice->invoicedetails->sum('bill_amt') }}</td>
                                <td>{{ !is_null($discount)?$discount->dr_amt:0}}</td>
                                <td>{{ $invoice->invoicedetails->sum('bill_amt') - (!is_null($discount)?$discount->dr_amt:0)}}
                                </td>
                                <td>{{ $netAmt->dr_amt}}</td>
                                <td>{{ $invoice->invoicedetails->sum('bill_amt') - ($netAmt->dr_amt+(!is_null($discount)?$discount->dr_amt:0))}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</body>

</html>