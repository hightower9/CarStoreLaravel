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
        <table class="table table-striped" style="border: 2px solid;">
          <thead>
            <tr>
              <th>Name</th>
              <th>ID</th>
              <th>Brand</th>
              <th>Price</th>
              <th>Color</th>
              <th>Type</th>
              <th>Year</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$cars->name}}</td>
              <td>{{$cars->id}}</td>
              <td>{{$cars->brand->name}}</td>
              <td>{{$cars->price}}</td>
              <td>{{$cars->color->name}}</td>
              <td>{{$cars->car_type->name}}</td>
              <td>{{$cars->year}}</td>
              <td><img class="card-img-bottom" src="/images/{{$cars->image}}" alt="image"></td>
            </tr>
          </tbody>
        </table>
        
      </div>
    </div>

  </body>
  </html>
