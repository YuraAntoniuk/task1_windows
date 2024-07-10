<?php

namespace App\Http\Controllers\Watermelon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Watermelon\StoreRequest;
use App\Http\Requests\Watermelon\UpdateRequest;
use App\Models\Watermelon;
use Illuminate\Http\Request;

class WatermelonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watermelons = Watermelon::all();
        return view('watermelon.index', compact('watermelons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('watermelon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Watermelon::firstOrCreate($data);

        return redirect()->route('watermelon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Watermelon $watermelon)
    {
        return view('watermelon.show', compact('watermelon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watermelon $watermelon)
    {
        return view('watermelon.edit', compact('watermelon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Watermelon $watermelon)
    {
        $data = $request->validated();
        $watermelon->update($data);

        return view('watermelon.show', compact('watermelon'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watermelon $watermelon)
    {
        $watermelon->delete();
        return redirect()->route('watermelon.index');
    }
}
