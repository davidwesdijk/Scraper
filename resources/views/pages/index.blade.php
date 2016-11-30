@extends('layout')

@section('scripts.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="jumbotron">
        <h1>Display earlier results</h1>

        <p>Select a keyword from the dropdown below and the first 100 results will be retrieved from the database.</p>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                @include('forms.dropdown')
            </div>
        </div>
    </div>
@endsection

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
@endsection