<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Car;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct($data = "")
    {
        $this->data = $data;
    }


    public function collection()
    {
         $cars = Car::where(function($query) {
         	// dd($this->data);
        if($this->data['color']) {
            $query->where('color_id', '=', $this->data['color']);
        }
        if($this->data['brand']) {
            $query->where('brand_id', '=', $this->data['brand']);
        }
        if($this->data['type']) {
            $query->where('car_type_id', '=', $this->data['type']);
        }
    })->select('name', 'price', 'color_id', 'brand_id', 'car_type_id', 'year', 'created_at')->get();
        
        foreach ($cars as $car) {
            $car->color_id = $car->color->name;
            $car->brand_id = $car->brand->name;
            $car->car_type_id = $car->car_type->name;
        }
        // dd($cars);
          return $cars;
    }

     public function headings(): array
    {
        return [
            'Name',
            'Price',
            'Color',
            'Brand',
            'Type',
            'Year',
            'Created'
        ];
    }
}
