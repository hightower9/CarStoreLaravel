@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if(Session::has('message'))
      <div class="alert alert-success">
        {{Session::get('message')}}
      </div>
      @endif

@if(Auth::user()->id == 1)
      <div class="card">
        <div class="card-header bg-primary text-white">Dashboard</div>
        <div class="card-body">
                   {{--  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! --}}
                    <form action="/store" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        {{ Form::label('carname', 'Car Name:', ['class' => 'control-label']) }}
                        {{ Form::text('carname',null,['class' => 'form-control']) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('price', 'Price:', ['class' => 'control-label']) }}
                        {{ Form::text('price',null,['class' => 'form-control']) }}
                      </div>

                      <div class="form-group">
                       {{ Form::label('type', 'Type:', ['class' => 'control-label']) }}
                       <div class="form-inline">
                         {{ Form::select('type', $cartypes,null,['class' => 'form-control','placeholder' => 'Pick a Type']) }}&nbsp;&nbsp;&nbsp;&nbsp;
                         <a href="/type" class="btn btn-warning">Add a Type</a>
                       </div>
                     </div>

                     <div class="form-group">
                      {{ Form::label('color', 'Color:', ['class' => 'control-label']) }}
                      <div class="form-inline">
                        {{ Form::select('color', $colors,null,['class' => 'form-control','placeholder' => 'Pick a Color']) }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/color" class="btn btn-warning">Add a Color</a>
                      </div>
                    </div>

                    <div class="form-group">
                      {{ Form::label('brand', 'Brand:', ['class' => 'control-label']) }}
                      <div class="form-inline">
                        {{ Form::select('brand', $brands,null,['class' => 'form-control','placeholder' => 'Pick a Brand']) }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/brand" class="btn btn-warning">Add a Brand</a>
                      </div>
                    </div>

                    <div class="form-group">
                      {{ Form::label('image', 'Image:', ['class' => 'control-label']) }}
                      <div class="form-inline">
                        {{ Form::file('image',['class' => 'form-control','onchange' => 'getImg(this,2048,"jpeg|png|jpg")']) }}&nbsp;&nbsp;
                        <span id="message" style="color: red;font-weight: bold;"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      {{ Form::label('year', 'Year:', ['class' => 'control-label']) }}
                      {{ Form::number('year','2018',['class' => 'form-control','min' =>'1900','max'=>'2099', 'step'=>'1']) }}
                    </div>

                    {{-- {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary','disabled' => 'true','id' => 'button'] )  }} --}}
                    <input type="submit" class="btn btn-primary" id="button" name="submit" value="Submit" disabled="true" />&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-primary" name="filterform" value="Filter Form" />
                  </form>
                </div>
              </div>

              @if(count($errors))
              <div class="alert alert-danger" style="margin-top: 20px;">
                <ul>
                  @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>

              </div>
              @endif
            </div>
            @endif
          </div>




          <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="col-md-12">
              @if(!$cars == null)
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <form class="form-inline" action="/filter" method="GET">
                    <div class="form-group">

                      {{ Form::label('colors', 'Color:&nbsp;', ['class' => 'control-label']) }}
                      {{ Form::select('colors', $colors,null,['class' => 'form-control','placeholder' => 'Pick Color']) }}&nbsp;&nbsp;&nbsp;&nbsp;

                      {{ Form::label('brands', 'Brand:&nbsp;', ['class' => 'control-label']) }}
                      {{ Form::select('brands', $brands,null,['class' => 'form-control','placeholder' => 'Pick Brand']) }}&nbsp;&nbsp;&nbsp;&nbsp;

                      {{ Form::label('types', 'Type:&nbsp;', ['class' => 'control-label']) }}
                      {{ Form::select('types', $cartypes,null,['class' => 'form-control','placeholder' => 'Pick Type']) }} &nbsp;&nbsp;&nbsp;&nbsp;

                      {{ Form::button('Filter', ['type' => 'submit', 'class' => 'btn btn-light'] )  }}&nbsp;&nbsp;&nbsp;&nbsp;

                      <button type="submit" formaction="/excel" class="btn btn-light">Download Excel</button>&nbsp;&nbsp;&nbsp;&nbsp;

                      {{-- <input type="submit" class="btn btn-light" name="filter" value="Filter" /> --}}

                      {{-- {{ Form::button('Filter Form', ['type' => 'submit', 'class' => 'btn btn-light','name' => 'action'] )  }} --}}
                      {{-- <a href="/filterform" type="submit" class="btn btn-light form-control"></a> --}}
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($cars as $car)
                      <tr>
                        <td>{{$car->name}}</td>
                        <td><img src="/images/{{$car->image}}" height="80" width="100" alt="image" /></td>
                        {{-- {{dd($car->image)}} --}}
                        <td>{{$car->price}}</td>
                        <td>{{$car->color->name}}</td>
                        <td>{{$car->brand->name}}</td>
                        <td>{{$car->car_type->name}}</td>
                        <td>{{$car->year}}</td>
                        <td>
                          <a href="/download/{{$car->id}}" class="btn btn-info" title="View"><i class="fa fa-download"></i></a>
                          <a href="/view/{{$car->id}}" class="btn btn-success" title="View"><i class="fa fa-eye"></i></a>
                          <a href="/edit/{{$car->id}}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                          <a href="/delete/{{$car->id}}" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure ??')"><i class="fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <h3 align="center" style="margin-top: 10px; font-weight: bold;">No Cars Available</h3>
                @endif
              </div>
            </div>
          </div>
        </div>


        <script>
          function getImg(input,max,accepted){
            var upImg=new Image(),test,size=input.form;
      // msg=msg.elements[0].children[0];

      return input.files?validate():
      (upImg.src=input.value,upImg.onerror=upImg.onload=validate);

      function validate(){
        test=(input.files?input.files[0]:upImg);
        size=(test.size||test.fileSize)/1024;
        mime=(test.type||test.mimeType);
        mime.match(RegExp(accepted,'i'))?
        size>max?(input.form.reset(),
          document.getElementById("message").innerHTML=max+"KB Exceeded!"):
        (document.getElementById("message").innerHTML="Upload ready",document.getElementById("button").disabled = false): 
        (input.form.reset(),document.getElementById("message").innerHTML=accepted+" file type(s) only!")
      }
    }
  </script> 
  @endsection