<?php

namespace App\Http\Controllers;

use App\Models\CollegeMajor;
use Illuminate\Http\Request;

class MyCollegeMajorController extends Controller
{
    public function index()
    {
        $collegeMajors = CollegeMajor::orderByDesc('created_at')->paginate(10);

        return view('user.my-college-major.index', compact('collegeMajors'));
    }

    public function show(CollegeMajor $collegeMajor)
    {
        $collegeMajor->load('universities');

        return view(
            'user.my-college-major.show',
            compact('collegeMajor')
        )->with('universities', $collegeMajor->universities()->paginate(10));
    }
}
