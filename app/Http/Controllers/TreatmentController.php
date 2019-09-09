<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TreatmentForms;

class TreatmentController extends Controller
{
    public function create()
    {

        if(true == DB::connection('mongodb')) {
           echo "if conditio";
        }else{
            echo "else conditon";
        }
        return view('Treatments/treatment');
    }

    public function store(Request $request)
    {
        echo $request->get('carcompany');
        echo $request->get('model');
        echo $request->get('price');

        $car = new TreatmentForms();
        $car->name = $request->get('carcompany');
        $car->dob = $request->get('model');
        $car->gender = $request->get('price');        
        $car->save();
        return redirect('car')->with('success', 'Car has been successfully added');
    }
}
