<?php

namespace App\Http\Controllers;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->middleware('auth');
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->index();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $this->permissionRepository->store($data);

        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->show($id);

        return view('permissions.edit', compact('permission'));
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $permissiom = $this->permissionRepository->show($request->id);
        $permissiom->update($data);
        return redirect()->route('permissions.index');
    }
    public function delete($id)
    {
        $permissiom = $this->permissionRepository->show($id);
        $permissiom->delete();
        return redirect()->route('permissions.index');
    }
}
