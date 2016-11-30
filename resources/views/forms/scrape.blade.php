<form method="POST" id="createScrape" action="/create">
	{{ csrf_field() }}

	<div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
		<div class="col-md-10">
			<input class="form-control input-lg" name="keyword" placeholder="Enter your keyword" value="{{ old('keyword') }}">
			@if ($errors->has('keyword'))
		        <span class="help-block">
		            <strong>{{ $errors->first('keyword') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary btn-lg">
				<i class="glyphicon glyphicon-search"></i>
			</button>
		</div>
	</div>

	<div class="col-md-12" id="loader" style="display:none">Right now we are downloading the top 100 search results from Google. One moment please...</div>
</form>