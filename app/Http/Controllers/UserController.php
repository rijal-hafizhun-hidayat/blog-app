<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::with('roles')->get()
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'roles' => Role::all()
        ]);
    }

    public function show($id)
    {
        return view('user.show', [
            'user' => User::with('roles')->find($id),
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {

        $payload = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'role_id' => 'required|numeric'
        ]);
        
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $payload['name'],
                'username' => $payload['username'],
                'password' => Hash::make($payload['password']),
            ]);

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $payload['role_id']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('simpan data berhasil');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string',
            'role_id' => 'required|numeric'
        ]);

        $user = User::with('roles')->find($id);
        $role_id = $user->roles[0]->pivot->role_id;

        try {
            DB::beginTransaction();
            $user->update([
                'name' => $payload['name'],
                'username' => $payload['username'],
                'password' => $payload['password'] ? Hash::make($payload['password']) : $user->password,
            ]);

            UserRole::where('user_id', $user->id)->where('role_id', $role_id)->delete();
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $payload['role_id']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('ubah data berhasil');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            User::destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('hapus data berhasil');
    }
}
