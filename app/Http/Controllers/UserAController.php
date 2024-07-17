<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAController extends Controller
{   
    public function homeA(){

        $casas = Casa::where('user_a_id', '!=', Auth::id())->limit(4)->get();
        $roomies = UserB::where('user_id', '!=', Auth::id())->limit(6)->get();
        return view('profile.home', compact('casas','roomies'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserA $userA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserA $userA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserA $userA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserA $userA)
    {
        //
    }
}
