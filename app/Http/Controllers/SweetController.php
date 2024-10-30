<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class SweetController extends Controller
{
    public function index(){
        Alert::success('Success Title', 'Success Message');

        return view("welcome
        ");
    }
}
