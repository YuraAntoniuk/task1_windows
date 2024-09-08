<?php

namespace App\Http\Controllers\Watermelon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Watermelon\StoreRequest;
use App\Http\Requests\Watermelon\UpdateRequest;
use App\Models\Category;
use App\Models\Watermelon;
use Illuminate\Http\Request;
use App\Services\ApiService;

class WatermelonController extends Controller
{

    protected $apiService;

    /**
     * Display a listing of the resource.
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $users = $this->apiService->getUsers();

        return view('watermelon.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {
        $user = $this->apiService->getUser($id);

        return view('watermelon.show', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'job']);
        $user = $this->apiService->createUser($data['name'], $data['job']);

        return redirect()->route('watermelon.show', ['id' => $user['id']]);
    }
    public function create()
    {
        return view('watermelon.create');
    }

    public function edit($id)
    {
        $user = $this->apiService->getUser($id);

        return view('watermelon.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'job']);
        $this->apiService->updateUser($id, $data['name'], $data['job']);

        return redirect()->route('watermelon.index');
    }

    public function destroy($id)
    {
        $this->apiService->deleteUser($id);
        return redirect()->route('watermelon.index');
    }
}

