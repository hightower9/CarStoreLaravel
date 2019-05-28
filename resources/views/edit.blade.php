@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Form</div>
        <div class="card-body">
          
          <form action="/update/{{$car->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              {{ Form::label('name', 'Car Name:', ['class' => 'control-label']) }}
              {{ Form::text('name',$car->name,['class' => 'form-control']) }}
            </div>

            <div class="form-group">
              {{ Form::label('price', 'Price:', ['class' => 'control-label']) }}
              {{ Form::text('price',$car->price,['class' => 'form-control']) }}
            </div>

            <div class="form-group">
             {{ Form::label('car_type_id', 'Type:', ['class' => 'control-label']) }}
             {{ Form::select('car_type_id', $cartypes, $car->car_type->id,['class' => 'form-control','placeholder' => 'Pick a Car Type']) }}
           </div>

           <div class="form-group">
            {{ Form::label('color_id', 'Color:', ['class' => 'control-label']) }}
            {{ Form::select('color_id',$colors,$car->color->id,['class' => 'form-control','placeholder' => 'Pick a Color']) }}
          </div>

          <div class="form-group">
            {{ Form::label('brand_id', 'Brand:', ['class' => 'control-label']) }}
            {{ Form::select('brand_id',$brands,$car->brand->id,['class' => 'form-control','placeholder' => 'Pick a Brand']) }}
          </div>

          <div class="form-group">
            {{ Form::label('image', 'Image:', ['class' => 'control-label']) }}
            {{ Form::file('image',['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('year', 'Year:', ['class' => 'control-label']) }}
            {{ Form::number('year',$car->year,['class' => 'form-control','min' =>'1900','max'=>'2099', 'step'=>'1']) }}
          </div>

          {{ Form::button('Edit', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
        </form>

      </div>
    </div>
  </div>
</div>
</div>
@endsection
