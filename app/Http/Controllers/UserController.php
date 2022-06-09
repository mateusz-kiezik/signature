<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users.index');
    }

    public function data(): JsonResponse
    {
        $model = User::where('role_id', 1)->get();
        return DataTables::collection($model)
            ->addColumn('department', function (User $user) {
                return $user->department->short;
            })
            ->addColumn('status', function (User $user) {
                if ($user->status() == 'Active') {
                    $color = 'bg-success';
                } elseif ($user->status() == 'Not confirmed') {
                    $color = 'bg-warning';
                } else {
                    $color = 'bg-secondary';
                }
                return '<span class="badge '. $color .'">'. $user->status() .'</span>';
            })
            ->rawColumns(['status'])
            ->toJson();
    }

    public function create(): View
    {
        return view('pages.users.create', [
            'departments' => Department::all()
        ]);
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'position' => $request['position'],
                'position_en' => $request['position_en'],
                'phone' => $request['phone'],
                'mobile' => $request['mobile'],
                'wechat' => $request['wechat'],
                'department_id' => $request['department_id'],
                'role_id' => 1,
                'password' => 'password'
            ]);
            Alert::success('Success', 'New user created successfully.');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Alert::error('Error', 'Failed to create new user. Please try again.');
            return redirect()->route('users.index');
        }
    }

    public function show($id): View
    {
        try {
            return view('pages.users.show', [
                'user' => User::findOrFail($id)
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
