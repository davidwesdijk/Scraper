@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Scraper</h1>

        <p>The first page will have a simple input field for a keyword and a button on which click action will scrape google for the first 100 results for a certain search keyword then save them in a database.</p>
        <p>The second page will have a dropdown which will have all the previously used keywords that were saved.</p>
        <p>When selecting a keyword from the dropdown a grid will be presented which will list all the 100 urls that were scraped from google.</p>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                @include('forms.scrape')
            </div>
        </div>
    </div>
@endsection
