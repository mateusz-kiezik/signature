<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(int $id): View
    {
        return view('pages.profile', [
            'user' => User::findOrFail($id),
            'departments' => Department::all()
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            if ($request['password'] != null) {
                $req = $request->all();
            } else {
                $req = $request->except(['password', 'password_confirmation']);
            }
            User::findOrFail($request['id'])->update($req);
            Alert::success('Success', 'Your profile updated successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Error', 'Failed to update data. Please try again.');
            return redirect()->back();
        }
    }
}
