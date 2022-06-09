@extends('layouts.app')

@section('content')
    <div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <input class="d-none" name="id" value="{{ auth()->user()->id }}">

            <label class="form-label">Name</label>
            <input class="form-control" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">

            <label class="form-label">E-mail</label>
            <input class="form-control" name="email" placeholder="E-mail" value="{{ old('email', $user->email) }}">

            <label class="form-label">Position</label>
            <input class="form-control" name="position" placeholder="Position"
                   value="{{ old('position', $user->position) }}">

            <label class="form-label">Position EN</label>
            <input class="form-control" name="position_en" placeholder="Position EN"
                   value="{{ old('position_en', $user->position_en) }}">

            <label class="form-label">Phone</label>
            <input class="form-control" name="phone" placeholder="Phone" value="{{ old('phone', $user->phone) }}">

            <label class="form-label">Mobile</label>
            <input class="form-control" name="mobile" placeholder="Mobile" value="{{ old('mobile', $user->mobile) }}">

            <label class="form-label">WeChat</label>
            <input class="form-control" name="wechat" placeholder="WeChat" value="{{ old('wechat', $user->wechat) }}">

            <label class="form-label">Department</label>
            <input class="form-control" name="department_id" placeholder="Department ID"
                   value="{{ old('department_id', $user->department_id) }}">

            <label class="form-label">Password</label>
            <input class="form-control" name="password" type="password">

            <label class="form-label">Confirm password</label>
            <input class="form-control" name="password_confirmation" type="password">

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
