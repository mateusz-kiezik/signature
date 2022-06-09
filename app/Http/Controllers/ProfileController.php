<?php

namespace App\Http\Controllers;

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
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request)
    {
        try {
            User::findOrFail($request['id'])->update(array_filter($request->all()));
            Alert::success('Success', 'Your profile updated successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Error', 'Failed to update data. Please try again.');
            return redirect()->back();
        }

    }
}
