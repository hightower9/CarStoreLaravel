<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\CarType;
use App\Color;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Input;
use PDF;
use Maatwebsite\Excel\Excel;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::all();
     // echo phpinfo();
        $colors = Color::pluck('name', 'id')->all();
        $cartypes = CarType::pluck('name', 'id')->all();
        $brands = Brand::pluck('name', 'id')->all();

        return view('home', compact('cars', 'colors','cartypes','brands'));
    }

    public function store(Request $request)
    {

        if (isset($_POST['submit'])) {

           $this->validate(request(),[
            'carname' => 'required',
            'price' => 'required',
            'type' => 'required', 
            'color' => 'required', 
            'brand' => 'required', 
            'year' => 'required', 
            'image' => 'required', 
        ]);

           $cars= new Car();
           $cars->name= $request['carname'];
           $cars->price= $request['price'];
           $cars->year= $request['year'];
           $cars->car_type_id= $request['type'];
           $cars->color_id= $request['color'];
           $cars->brand_id= $request['brand'];
           $cars->image= $request['image'];

        $file = $request['image']->getClientOriginalName(); //get filename fullname
        $filename = pathinfo($file, PATHINFO_FILENAME); //get file name without extension

        $input = $filename . '_' . time() . '.' . $cars->image->getClientOriginalExtension();
        $destinationPath = public_path('/images'); //selects path
        $cars->image->move($destinationPath, $input); //moves file to destination

        $cars->image = $input; // stores file name

    // add other fields

        $cars->save();

        return redirect('/home')->with('message','Car has been added successfully');

    } else if (isset($_POST['filterform'])) 
    {
        // dd($_POST['filterform']);
     $data = [
        'carname' => $request['carname'],
        'price' => $request['price'],
        'color' => $request['colors'],
        'brand' => $request['brands'],
        'type' => $request['types'],
        'year' => $request['year'],
    ];

    $cars = Car::where(function($query) use ($data) {
        if($data['carname']) {
            $query->where('name', '=', $data['carname']);
        }
        if($data['price']) {
            $query->where('price', '=', $data['price']);
        }
        if($data['color']) {
            $query->where('color_id', '=', $data['color']);
        }
        if($data['brand']) {
            $query->where('brand_id', '=', $data['brand']);
        }
        if($data['type']) {
            $query->where('car_type_id', '=', $data['type']);
        }
        if($data['year']) {
            $query->where('year', '=', $data['year']);
        }
    })->get();

    $colors = Color::pluck('name', 'id')->all();
    $cartypes = CarType::pluck('name', 'id')->all();
    $brands = Brand::pluck('name', 'id')->all();

    return view('home', compact('cars', 'colors','cartypes','brands'));

}

}

public function filter(Request $request)
{
    $data = [
        'color' => $request['colors'],
        'brand' => $request['brands'],
        'type' => $request['types'],
    ];

    $cars = Car::where(function($query) use ($data) {
        if($data['color']) {
            $query->where('color_id', '=', $data['color']);
        }
        if($data['brand']) {
            $query->where('brand_id', '=', $data['brand']);
        }
        if($data['type']) {
            $query->where('car_type_id', '=', $data['type']);
        }
    })->get();

    $colors = Color::pluck('name', 'id')->all();
    $cartypes = CarType::pluck('name', 'id')->all();
    $brands = Brand::pluck('name', 'id')->all();

    return view('home', compact('cars', 'colors','cartypes','brands'));

}

public function download($id,Request $request)
{
    $cars = Car::find($id);
    return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('download',compact('cars'))->stream();
}

public function view($id,Request $request)
{
    $car = Car::find($id);
    $comments = Comment::where('car_id', '=', $id)->get();
    return view('view',compact('car','comments'));
}

public function edit($id)
{
    $car = Car::find($id);
    $colors = Color::pluck('name', 'id')->all();
    $cartypes = CarType::pluck('name', 'id')->all();
    $brands = Brand::pluck('name', 'id')->all();

    return view('edit',compact('car', 'colors','cartypes','brands'));
}

public function update($id,Request $request)
{
    $car = Car::find($id);

        // $car->update($request->all());
    $car->name=$request['name'];            
    $car->price=$request['price'];
    $car->color_id=$request['color_id'];
    $car->brand_id=$request['brand_id'];
    $car->car_type_id=$request['car_type_id'];

    if(!$request['image'] == null){
        $car->image=$request['image'];
        $file = $request['image']->getClientOriginalName(); //get filename fullname
        $filename = pathinfo($file, PATHINFO_FILENAME); //get file name without extension

        $input = $filename . '_' . time() . '.' . $car->image->getClientOriginalExtension();
        $destinationPath = public_path('/images'); //selects path
        $car->image->move($destinationPath, $input); //moves file to destination

        $car->image = $input; // stores file name
    }
    $car->year=$request['year'];
    $car->save();
    return redirect()->route('home')->with('message','Item updated Succesfully');
}

public function destroy(Car $id)
{
    $id->delete();
    $cars = Car::all();
    return redirect()->route('home')->with('message','Item deleted Succesfully');
}
}