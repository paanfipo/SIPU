@if(count($errors))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if(isset($errors_detail) && count($errors_detail) > 0)
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		<ul>
			@foreach($errors_detail as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if(session()->has('error'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		<ul>
			{{session('error')}}
		</ul>
	</div>
@endif
