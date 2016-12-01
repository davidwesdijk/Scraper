@extends('layout')

@section('content')
	<div class="jumbotron">
        <h1>Keyword: {{ $keyword->keyword }}</h1>

        <p>When selecting a keyword from the dropdown a grid will be presented which will list all the 100 urls that were scraped from google.</p>
    </div>

	<div class="row">
		<div class="col-md-12 result">
			<table class="table table-striped">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>URL</th>
				</thead>
				<tbody>
					@foreach ($results as $result)
						<tr>
							<td class="id">{{ $loop->iteration + ($results->currentPage() * 10 - 10) }}</td>
							<td class="title">{{ $result->title }}</td>
							<td class="url">
								<a href="{!! $result->url !!}" target="_blank" title="{!! $result->url !!}">
									@if (strlen($result->url) >= 40)
										{{ substr($result->url, 0, 40) }}...
									@else
										{{ $result->url }}
									@endif
								</a>
							</td>
							<td class="description">{{ $result->description }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="pagination pull-right">{{ $results->links() }}</div>
		</div>
	</div>
@stop