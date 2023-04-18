<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        if ($user->status == 0) {
            $user->status = 2;
            $user->save();
            return back();
        }

        return back();
    }
}
