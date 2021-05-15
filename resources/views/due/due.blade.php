@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <style></style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h5>Due Accounts</h5>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-responsive-md">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Sales Order</th>
                                <th>To send</th>
                                <th>Due Date</th>
                                <th>Days Due</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dues as $due)
                                <tr>
                                    <td>{{$due->invoice->customer_name}}</td>
                                    <td>{{$due->invoice->sales_order}}</td>
                                    <td>{{$due->sent_date}}</td>
                                    <td>{{$due->due_date}}</td>
                                    <td>{{$due->days_due}}</td>
                                    <td>{{$due->comments}}</td>
                                    <td></td>
                                </tr>

                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

    </script>
@endsection

