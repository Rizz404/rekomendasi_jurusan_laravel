<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\University;
use Illuminate\Http\Request;

class MyUniversityController extends Controller
{
    public function index()
    {
        $universities = University::orderByDesc('created_at')->paginate(10);

        return view('pages.user.my-university.index', compact('universities'));
    }

    public function show(University $university)
    {
        return view(
            'pages.user.my-university.show',
            compact('university')
        );
    }
}
