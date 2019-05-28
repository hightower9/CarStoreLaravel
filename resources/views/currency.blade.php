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

    <div class="card">
      <div class="card-header bg-primary text-white">Add Car Type</div>
      <div class="card-body">

        <form enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="CURR_FR">From:</label>
            <select class="form-control" id="CURR_FR" name="CURR_FR">
              <option disabled selected>Choose a Value</option>
              <option value="INR">Indian Rupee</option>
              <option value="USD">US Dollar</option>
              <option value="GBP">British Pound</option>
              <option value="EUR">Euro</option>
              <option value="AUD">Austrailan Dollar</option>
            </select>
          </div>

          <div class="form-group">
            {{ Form::label('CURR_FR_VAL', 'Amount:', ['class' => 'control-label']) }}
            {{ Form::text('CURR_FR_VAL',null,['class' => 'form-control','id' => 'CURR_FR_VAL']) }}
          </div>

          <div class="form-group">
            <label for="CURR_TO">To:</label>
            <select class="form-control" id="CURR_TO" name="CURR_TO">
              <option disabled selected>Choose a Value</option>
              <option value="INR">Indian Rupee</option>
              <option value="USD">US Dollar</option>
              <option value="GBP">British Pound</option>
              <option value="EUR">Euro</option>
              <option value="AUD">Austrailan Dollar</option>
            </select>
          </div>

          <div class="form-group">
            {{ Form::label('CURR_VAL', 'Value:', ['class' => 'control-label','id' => 'value']) }}
            {{ Form::text('CURR_VAL',null,['class' => 'form-control','id' => 'CURR_VAL']) }}
          </div>

          <button type="button" class="btn btn-primary" onclick="getCurrencyUsingJQuery()">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection