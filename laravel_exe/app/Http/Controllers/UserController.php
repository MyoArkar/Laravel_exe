<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }
    public function index()
    {

        $users = $this->userRepository->index();

        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }
    public function store(UserRequest $request)
    {
        //dd($request);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('userImages'), $imageName);

            $data = array_merge($data, ['image' => $imageName]);
        }
        $data['password'] = Hash::make($data['password']);
        $data['status'] = $request->has('status') ? true : false;
        $user = $this->userRepository->store($data);
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index');
    }
    public function edit($id)
    {
        $user = $this->userRepository->show($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }
    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($request['password']);
        } else {
            unset($data['password']);
        }

        if ($request->old_image && !($request->hasFile('image'))) {
            $data = array_merge($data, ['image' => $request->old_image]);
        } else {
            if ($request->hasFile('image')) {
                File::delete(public_path('userImages/' . $request->old_image));
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('userImages'), $imageName);

                $data = array_merge($data, ['image' => $imageName]);
            }
        }
        $data['status'] = $request->has('status') ? true : false;
        $user = $this->userRepository->show($request->id);
        $user->update($data);
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index');
    }
    public function delete($id)
    {
        $user = $this->userRepository->show($id);

        $user->delete();

        return redirect()->route('users.index');
    }
}
