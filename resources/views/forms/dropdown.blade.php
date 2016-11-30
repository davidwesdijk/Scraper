


<form method="POST" action="/history">
	{{ csrf_field() }}

	<div class="form-group">
		<div class="col-md-10">
			<select class="selectpicker" name="keyword_id" data-live-search="true" data-width="100%" title="Choose one of the following keywords...">
			@foreach ($keywords as $keyword)
				<option value="{{ $keyword->id }}" data-subtext="{{ $keyword->created_at }}">{{ $keyword->keyword }}</option>
			@endforeach
</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary btn-lg">
				<i class="glyphicon glyphicon-search"></i>
			</button>
		</div>
	</div>
</form>