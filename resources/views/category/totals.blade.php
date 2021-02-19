@extends('layouts.app')
@section('title', 'Initialize Monthly Bonus')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class='card-header'>
                <h4>Category Totals </h4>
                <h6>From {{$start}} to {{$end}}</h6>
                <div class="col-auto">
                    <a class="btn btn-success" href="{{route('totals',[$start,$end])}}">
                        Export to Excel
                    </a>
                </div>

            </div>
            <div class="card card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="get" action="">
                    @csrf
                    <table id="accounts" class="table table-bordered table-hover table-sm">
                        <thead>
                        <th>Odoo Product Category</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Category</th>
                        <th>Total</th>
                        </thead>
                        <tbody>
                        @foreach ($results as $result)
                            @php
                                //  dd($result);
                            @endphp
                            <tr>
                                <td>{{$result[0]}}</td>

                                @for ($i=1; $i <= 6;$i++)
                                    @if ($i  < count($result))
                                        <td class="text-xl-left">{{$result[$i][0]}}</td>
                                        <td class="text-xl-right">{{number_format($result[$i][1],2)}}</td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif

                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </tbody>
                    </table>
                    <table class="table table-sm">
                        <tr>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
