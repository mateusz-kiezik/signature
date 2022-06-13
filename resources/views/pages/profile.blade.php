@extends('layouts.app')

@section('content')
    <div class="row justify-content-center bg-light">


        <h2 class="fw-bold text-center my-4">{{ __('Edit my profile') }}</h2>

        <form method="POST" action="{{ route('profile.update') }}" autocomplete="off" id="userForm">
            @csrf
            <input class="d-none" name="id" value="{{ auth()->user()->id }}">

            <div class="row">
                <div class="col-6">
                    <label class="form-label mt-2">{{ __('Name') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name', $user->name) }}">
                    @error('name')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('E-mail') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email', $user->email) }}">
                    @error('email')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Position') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('position') is-invalid @enderror" name="position"
                           value="{{ old('position', $user->position) }}">
                    @error('position')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Position (ENG)') }}</label>
                    <input class="form-control @error('position_en') is-invalid @enderror" name="position_en"
                           value="{{ old('position_en', $user->position_en) }}">
                    @error('position_en')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Phone number') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><img src="{{ asset('icons/phone-in-talk.svg') }}"></span>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                               value="{{ old('phone', $user->phone) }}" placeholder="0048 71 123 45 67">
                    </div>
                    @error('phone')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Mobile number') }}<span class="text-danger"> *</span></label>
                    <div class="input-group">
                    <span class="input-group-text @error('mobile') border-danger @enderror"><img
                            src="{{ asset('icons/cellphone.svg') }}"></span>
                        <input class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                               value="{{ old('mobile', $user->mobile) }}" placeholder="0048 555 666 777">
                    </div>
                    @error('mobile')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('WeChat ID') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><img src="{{ asset('icons/wechat.svg') }}"></span>
                        <input class="form-control @error('wechat') is-invalid @enderror" name="wechat"
                               value="{{ old('wechat', $user->wechat) }}">
                    </div>
                    @error('wechat')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Department') }}<span class="text-danger"> *</span></label>
                    <select class="form-select @error('department_id') is-invalid @enderror" name="department_id">
                        <option value="" readonly>-- {{ __('Select department') }} --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                    @if($department->id == $user->department->id) selected @endif>
                                [{{ $department->short }}] {{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="form-label mt-2">{{ __('Current password') }}</label>
                    <input class="form-control @error('current_password') is-invalid @enderror" name="current_password" type="password">
                    @error('current_password')
                    <span class="invalid-feedback d-flex" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('New Password') }}</label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password">
                    @error('password')
                    <span class="invalid-feedback d-flex" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Confirm new password') }}</label>
                    <input class="form-control" name="password_confirmation" type="password">
                </div>
            </div>

            <div class="text-center my-5">
                <button class="btn btn-primary fw-bold w-50" type="submit" id="update-btn">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
@endsection
