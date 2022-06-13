<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class UserController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return $this->data();
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'E-mail'],
            ['data' => 'mobile', 'name' => 'mobile', 'title' => 'Mobile number'],
            ['data' => 'department', 'name' => 'department.short', 'title' => 'Department'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false, 'width' => '20%']
        ]);

        return view('pages.users.index', compact('html'));
    }

    public function data(): JsonResponse
    {
        $data = User::where('role_id', 1)->get();
        return DataTables::collection($data)
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
                return '<span class="badge ' . $color . '">' . $user->status() . '</span>';
            })
            ->addColumn('action', 'actions.users')
            ->rawColumns(['status', 'action'])
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
            $user = User::create([
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
            ])->sendEmailVerificationNotification();

//            $token = Password::broker('users')->createToken($user);
//
//            Notification::send($user, new WelcomeEmailNotification($user, $token));

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
        return view('pages.users.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('pages.users.edit', [
            'user' => User::findOrFail($id),
            'departments' => Department::all()
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            if ($request['password'] != null) {
                $req = $request->all();
            } else {
                $req = $request->except(['password', 'password_confirmation']);
            }
            User::findOrFail($id)->update($req);
            Alert::success('Success', 'Your profile updated successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Error', 'Failed to update data. Please try again.');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function disable($id)
    {
        try {
            User::findOrFail($id)->update(['status' => 0]);
            return response()->json([
                'success' => true
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function enable($id)
    {
        try {
            User::findOrFail($id)->update(['status' => 1]);
            return response()->json([
                'success' => true
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false
            ]);
        }
    }
}
