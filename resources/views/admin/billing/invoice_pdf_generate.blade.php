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
                    <h6 class="card-title">Invoice No: <span class="text-success">{{$invoice->invoice_no}}</span></h6>
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
                <div class="col-md-12 m-auto">
                    <table class="table table-sm">
                        <tbody>
                            @if ( ! empty($calculateAmount['GS']) )
                            <tr>
                                <td>Gross Total:</td>
                                <td>{{ $calculateAmount['GS'] }}</td>
                            </tr>
                            @endif
                            @if ( ! empty($calculateAmount['DC']) )
                            <tr>
                                <td>Discount:</td>
                                <td>{{ $calculateAmount['DC'] }}</td>
                            </tr>
                            @endif
                            
                            @if ( ! empty($calculateAmount['DC']) )
                            <tr>
                                <td>Net Amount:</td>
                                <td>{{ $calculateAmount['GS'] - $calculateAmount['DC'] }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>Net Amount:</td>
                                <td>{{ $calculateAmount['GS']}}</td>
                            </tr>
                            @endif
                            @if ( ! empty($calculateAmount['PM']) )
                            <tr>
                                <td>Received Amount:</td>
                                <td>{{ $calculateAmount['PM'] }}</td>
                            </tr>
                            @endif
                            @if ( ! empty($calculateAmount['DC']) )
                            <tr>
                                <td>{{ ($calculateAmount['GS'] - $calculateAmount['DC']) > $calculateAmount['PM'] || abs(($calculateAmount['PM']+$calculateAmount['DC']) - $calculateAmount['GS']) == 0?'Due ':'Return '}}Amount:
                                </td>
                                <td>{{ abs(($calculateAmount['PM']+$calculateAmount['DC']) - $calculateAmount['GS']) }}
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $calculateAmount['GS'] > $calculateAmount['PM'] || $calculateAmount['PM'] - $calculateAmount['GS'] == 0?'Due ':'Return '}}Amount:
                                </td>
                                <td>{{ $calculateAmount['PM']- $calculateAmount['GS'] }}
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>




</body>

</html>