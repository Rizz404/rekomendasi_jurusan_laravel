<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Criteria;
use App\Models\User;
use Illuminate\Http\Request;

// Todo: Nanti tambahin apa kek jangan redirect
class HomeController extends Controller
{
    function index()
    {
        return view('pages.user.home.index');
    }
}
