@extends('layouts.app')
@section('title', 'Accounting')
@section('content')

<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center ">
        <div class="col-6">
            <div class="card text-center ">
                <div class="card-header"><h4>Accounting</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Category Report
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                <div class="card card-body">
                                    <h6>Enter From To</h6>
                                    <form method="get" action="{{route('start2')}}">
                                        @csrf
                                        <input id="start" name="start" type="text" value="{{$start}}">
                                        <input id="end" name="end" type="text" value="{{$end}}">
                                        <button type="submit" name="notes" value="notes"
                                                class="btn btn-success btn-sm text-xl-right">
                                            Ready Set Go
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        Update Simplicity Accounts
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordionExample">
                                <div class="card-body">
                                    <form  action="{{route('do_import')}}" name="importing" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group text-left">
                                            <label for="import_file">Import</label>
                                            <input class="form-control" name="import_file" type="file">
                                        </div>

                                        <div class="form-group text-left">
                                            <div class="col-3">
                                                <button id="printlabel" class="btn btn-lg btn-primary btn-block"
                                                        type="submit">Import
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <p class="text-muted text-center">&copy;
                        @php
                        $copyYear = 2018; // Set your website start date
                        $curYear = date('Y'); // Keeps the second year updated
                        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '')
                        @endphp
                        Oz Distribution, Inc.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>

</body>
</html>
@endsection
