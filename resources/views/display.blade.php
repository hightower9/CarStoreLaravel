@extends('user')

@section('content')

<div class="col-sm-8 blog-main">

	
<div class="row">
	<div class="col-md-3 col-sm-6 pull-left">
		<div class="form-group">
			<label for="sel1">Select list:</label>
			<select class="form-control" id="sel1">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
			</select>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-md-4">
			
		</div>
	</div>	
	

	<nav class="blog-pagination">
		<a class="btn btn-outline-primary" href="#">Older</a>
		<a class="btn btn-outline-secondary" href="#">Newer</a>
	</nav>

</div><!-- /.blog-main -->

@endsection