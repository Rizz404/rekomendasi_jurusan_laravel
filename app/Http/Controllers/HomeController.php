<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        // $criteriaData = [
        //     'name' => 'test',
        //     'description' => 'test',
        //     'weight' => '12',
        //     'type' => 'benefit',
        //     'school_type' => 'SMA',
        //     'is_active' => 'true',
        // ];

        // $criteria = new Criteria($criteriaData);
        // $criteria->save();

        // $criteria = Criteria::factory()->count(10)->create();
        // dd($criteria);

        // * Manual
        // User::factory()->count(10)->state([
        //     'email_verified_at' => null
        // ]);

        // * Chaining buat function dulu
        // $users = User::factory()->count(5)->unverified()->create();

        // dump($users);

        return view('user.home.index');
    }
}
