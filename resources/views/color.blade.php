@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header bg-primary text-white">Add Car Color</div>
        <div class="card-body">

          <form action="/store/color" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              {{ Form::label('color', 'Car Color:', ['class' => 'control-label']) }}
              {{ Form::text('color',null,['class' => 'form-control']) }}
            </div>

            {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
          </form>
        </div> 
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center" style="margin-top: 20px;">
  <div class="col-md-6">

    <div class="card">
      @if(!$colors == null)
      <div class="card-header bg-primary text-white">
        Details
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Color</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($colors as $color)
            <tr>
              <td>{{$color->name}}</td>
              <td>
                <a href="/delete/color/{{$color->id}}" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure ??')"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <h3 align="center" style="margin-top: 10px; font-weight: bold;">No Types Available</h3>
      @endif
    </div>
  </div>
</div>

</div>
@endsection