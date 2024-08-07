<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBController extends Controller
{
    
    public function homeB(){

        $casas = Casa::with(['archivos' => function ($query) {
            $query->where('clasificacion_archivo', 'img_cuarto');
        }])->limit(4)->get();

        $roomies = UserA::with(['user.archivos' => function($query){
            $query->where('archivo_type', 'img_perf');
        }])->limit(6)->get();
        
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
    public function show(UserB $userB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserB $userB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserB $userB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserB $userB)
    {
        //
    }
}
