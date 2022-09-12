<!doctype html>
<html lang="en">
  <head>
    <title>Car Details For Dashboard Listing</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .required label::after{
            content:" *";
            color: red;
        }
    </style> 
  </head>

  <body>
    <form action="{{url('/')}}/addcar" method="POST">
    @csrf
    <div class="container">
        <h2 class="text-center text-primary">Car Details</h2>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="">Car Name</label>
                <input type="text" name="car_name" id="" class="form-control" value="{{old('car_name')}}"/>
                <span class="text-danger">
                    @error('car_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Brand</label>
                <input type="text" name="brand" id="" class="form-control" value="{{old('brand')}}"/>
                <span class="text-danger">
                    @error('brand')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Transmission</label>
                <select class="form-control" id="winner">
                  <option>Manual</option>
                  <option>Automatic</option>
                </select>
            </div>  
        </div>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="">Model</label>
                <input type="text" name="model" id="" class="form-control" value="{{old('model')}}"/>
                <span class="text-danger">
                    @error('model')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Model Year</label>
                <input type="text" name="model_year" id="" class="form-control" value="{{old('model_year')}}"/>
                <span class="text-danger">
                    @error('model_year')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Seating Capacity</label>
                <select class="form-control" id="winner">
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                </select>
              </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="">Fuel Type</label>
                <select class="form-control" id="winner">
                  <option>Petrol</option>
                  <option>Diesel</option>
                </select>
              </div>
              <div class="form-group col-md-4 required">
                <label for="">Fuel Tank Capacity</label>
                <input type="text" name="fuel_tank_capacity_litres" id="" class="form-control" value="{{old('fuel_tank_capacity_litres')}}"/>
                <span class="text-danger">
                    @error('fuel_tank_capacity_litres')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Milage</label>
                <input type="text" name="mileage_kmpl" id="" class="form-control" value="{{old('mileage_kmpl')}}"/>
                <span class="text-danger">
                    @error('mileage_kmpl')
                        {{$message}}
                    @enderror
                </span>
            </div>  
        </div>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="">CC</label>
                <input type="text" name="engine_displacement_cc" id="" class="form-control" value="{{old('engine_displacement_cc')}}"/>
                <span class="text-danger">
                    @error('engine_displacement_cc')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Body Type</label>
                <select class="form-control" id="winner">
                  <option>Hatchback</option>
                  <option>Sedan</option>
                  <option>SUV</option>
                </select>
              </div>
            <div class="form-group col-md-4">
                <label for="">Wheel Base</label>
                <input type="text" name="wheel_base_mm" id="" class="form-control" value="{{old('wheel_base_mm')}}"/>
                <span class="text-danger">
                    @error('wheel_base_mm')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">RPM</label>
                <input type="text" name="rpm" id="" class="form-control" value="{{old('rpm')}}"/>
                <span class="text-danger">
                    @error('rpm')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="">Max Power</label>
                <input type="text" name="max_power" id="" class="form-control" value="{{old('max_power')}}"/>
                <span class="text-danger">
                    @error('max_power')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="">Max Torque</label>
                <input type="text" name="max_torque" id="" class="form-control" value="{{old('max_torque')}}"/>
                <span class="text-danger">
                    @error('max_torque')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Length</label>
                <input type="text" name="length_mm" id="" class="form-control" value="{{old('length_mm')}}"/>
                <span class="text-danger">
                    @error('length_mm')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="">Width</label>
                <input type="text" name="width_mm" id="" class="form-control" value="{{old('width_mm')}}"/>
                <span class="text-danger">
                    @error('width_mm')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="">Height</label>
                <input type="text" name="height_mm" id="" class="form-control" value="{{old('height_mm')}}"/>
                <span class="text-danger">
                    @error('height_mm')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="">VIN</label>
                <input type="text" name="vin" id="" class="form-control" value="{{old('vin')}}"/>
                <span class="text-danger">
                    @error('vin')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Engine Number</label>
                <input type="text" name="engine_number" id="" class="form-control" value="{{old('engine_number')}}"/>
                <span class="text-danger">
                    @error('engine_number')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-4 required">
                <label for="">Price</label>
                <input type="text" name="price" id="" class="form-control" value="{{old('price')}}"/>
                <span class="text-danger">
                    @error('price')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>


        <button class="btn btn-primary col-md-12" >
            List Car
        </button>
    </div>
</form>
  </body>
</html>