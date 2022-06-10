<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(string $token): View
    {
        return view('auth.completeRegister', [
            'token' => $token,
            'email' => request()->get('email')
        ]);
    }

    public function store(Request $request)
    {
        try {
            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => $request['email'],
                    'token' => $request['token']
                ])->first();

            if(!$updatePassword){
                return back()->withInput()->with('error', 'Invalid token!');
            }

            $user = User::where('email', $request->email)
                ->update(['password' => $request->password]);

            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            return redirect()->route('profile.index', $user->id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
