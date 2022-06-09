@extends('layouts.app')

@section('content')
    <div class="row justify-content-center bg-light">
        <div class="col-6">

            <h2 class="fw-bold text-center my-4">{{ __('Create new user') }}</h2>

            <form method="POST" action="{{ route('users.store') }}" autocomplete="off" id="userForm">
                @csrf

                <label class="form-label mt-2">{{ __('Name') }}<span class="text-danger"> *</span></label>
                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label class="form-label mt-2">{{ __('E-mail') }}<span class="text-danger"> *</span></label>
                <input class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label class="form-label mt-2">{{ __('Position') }}<span class="text-danger"> *</span></label>
                <input class="form-control @error('position') is-invalid @enderror" name="position"
                       value="{{ old('position') }}">
                @error('position')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label class="form-label mt-2">{{ __('Position (ENG)') }}</label>
                <input class="form-control @error('position_en') is-invalid @enderror" name="position_en"
                       value="{{ old('position_en') }}">
                @error('position_en')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label class="form-label mt-2">{{ __('Phone number') }}</label>
                <div class="input-group">
                    <span class="input-group-text"><img src="{{ asset('icons/phone-in-talk.svg') }}"></span>
                    <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                           value="{{ old('phone') }}">
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
                           value="{{ old('mobile') }}">
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
                           value="{{ old('wechat') }}">
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
                        <option value="{{ $department->id }}">
                            [{{ $department->short }}] {{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="text-center my-5">
                    <button class="btn btn-primary fw-bold w-50" type="button" id="saveButton">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const save = document.getElementById('saveButton');
        const form = document.getElementById('userForm');
        save.onclick = function () {
            Swal.fire({
                title: 'Are you sure you want to create new user?',
                text: 'The user will receive the message with instructions for completing the registration.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#507023',
                cancelButtonColor: '#FF0000',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        };
    </script>
@endpush
