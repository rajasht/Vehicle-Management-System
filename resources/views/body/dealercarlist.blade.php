<!doctype html>
<html lang="en">
  <head>
    <title>Vehicle Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

        <table class="table">
            <thead>
                <tr>
                    <th>VIN</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Model year</th>
                    <th>Fuel type</th>
                    <th>Transmission</th>
                    <th>Mileage</th>
                    <th>Colors available</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $dt)
                <tr>
                    <td>{{$dt->vin}}</td>
                    <td>{{$dt->car_name}}</td>
                    <td>{{$dt->brand}}</td>
                    <td>{{$dt->model_year}}</td>
                    <td>{{$dt->fuel_type}}</td>
                    <td>{{$dt->transmission}}</td>
                    <td>{{$dt->mileage_kmpl}}</td>
                    <td>{{$dt->colors_available}}</td>
                    <td>{{$dt->price_rs}}</td>
                    <td>
                        <a href="/">
                            <button class="btn  btn-primary">Sell Car</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </body>
</html>