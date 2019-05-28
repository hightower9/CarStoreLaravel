<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;
use App\Http\Controllers\Controller;
use App\Car;

class UserController extends Controller
{
	 // private $excel;

  //   public function __construct(Excel $excel)
  //   {
  //       $this->excel = $excel;
  //   }

	public function index()
	{
		return view('user');
	}

	public function show()
	{
		return view('display');
	}

	public function currency()
	{
		return view('currency');
	}

	 public function export(Request $request) 
    {
    	  $data = [
        'color' => $request['colors'],
        'brand' => $request['brands'],
        'type' => $request['types'],
    ];

   
// dd($cars);
    // $var = [
    // 	'cars' => $cars,
    // ];
        return Excel::download(new UsersExport($data), 'details.xlsx');
    }

}