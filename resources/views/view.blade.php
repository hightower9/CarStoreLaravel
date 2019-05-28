<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12">


        <div class="card" style="width:700px;margin: auto;margin-top: 40px;margin-bottom: 40px;">
          <img class="card-img-top" src="/images/{{$car->image}}" alt="image">
          <div class="card-body">
            <h1 class="card-title">{{$car->name}}</h1>
            <p class="card-text">
              <h4>ID:  <small>{{$car->id}}</small></h4>
              <h4>Brand: <small>{{$car->brand->name}}</small></h4>
              <h4>Price: <small>{{$car->price}}</small></h4>
              <h4>Color: <small>{{$car->color->name}}</small></h4>
              <h4>Type: <small>{{$car->car_type->name}}</small></h4>
              <h4>Year: <small>{{$car->year}}</small></h4>
            </p>
          </div>
        </div>


        <div class="card" style="margin-bottom: 40px;">
          <div class="card-header bg-primary text-whitep">Comments</div>
          <div class="card-body">

            @foreach($comments as $comment)

            <div class="card" style="margin-bottom: 40px;">
              <div class="card-header">{{$comment->user->name}}
              @if(Auth::user()->id == 1)
              <a href="/deletecom/{{$comment->id}}/{{$car->id}}" class="btn btn-danger" style="float: right;" title="Delete" onclick="return confirm('Are you sure ??')">Delete <i class="fa fa-trash-o"></i></a>
              @endif
              </div>
              <div class="card-body">{{$comment->comment}}
                <p style="float: right;">{{$comment->created_at}}</p></div> 
              </div>

              @endforeach

              <div class="card bg-light text-dark">
                <div class="card-header">Add Comment</div>
                <div class="card-body">

                  <form action="/comment/{{$car->id}}" method="GET" enctype="multipart/form-data">
                    <div class="form-group">

                      {{ Form::textarea('comment',null,['class' => 'form-control']) }}&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    {{ Form::button('Add Comment', ['type' => 'submit', 'class' => 'btn btn-success'] )  }}

                  </form>

                </div> 
              </div>

            </div> 
          </div>


        </div>
      </div>

    </body>
    </html>
