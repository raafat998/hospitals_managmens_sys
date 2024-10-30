<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class errorPageController
{


    public function acconterrorPage()
    {
        return view('pages/error-page', [
            'layout' => 'side-menu'
        ]);
    }
}
