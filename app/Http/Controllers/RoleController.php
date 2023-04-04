<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class RoleController extends Controller
{
    public function admin() {
        if (Gate::allows('is-admin')) {
            return view('roles.adminPage');
        } else {
            abort(403);
        }
    }

    public function usersList() {
        $data = User::all();

        if (Gate::allows('is-admin')) {
            return view('roles.usersList', [
            'users' => $data
        ]);
        } else {
            abort(403);
        }
    }

    public function approve($id) {
        $user = User::find($id);
        $user->isAdmin = 2;
        $user->save();
        return back();
    }

    public function approvedUser() {
        if (Gate::allows('is-approved-user')) {
            return view('roles.approvedUserPage');
        } else {
            abort(403);
        }
    }
}
