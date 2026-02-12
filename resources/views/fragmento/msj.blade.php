@if(session()->has('warning'))
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		<ul>
			{{session('warning')}}
		</ul>
	</div>
@endif

@if(session()->has('info'))
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		<ul>
			{{session('info')}}
		</ul>
	</div>
@endif
