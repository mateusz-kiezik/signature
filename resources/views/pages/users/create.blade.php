@extends('layouts.app')

@section('content')
    <div id="overlay">
        <div id="text">Loading</div>
    </div>

        <div class="row justify-content-center bg-light">
            <div class="col-6">

                <h2 class="fw-bold text-center my-4">{{ __('Create new user') }}</h2>
                <button class="btn btn-secondary btn-sm" id="fill-btn" type="button">FILL</button>

                <form method="POST" action="{{ route('users.store') }}" autocomplete="on" id="userForm">
                    @csrf

                    <label class="form-label mt-2">{{ __('Name') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" id="name">
                    @error('name')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('E-mail') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" id="email">
                    @error('email')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Position') }}<span class="text-danger"> *</span></label>
                    <input class="form-control @error('position') is-invalid @enderror" name="position"
                           value="{{ old('position') }}" id="position">
                    @error('position')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Position (ENG)') }}</label>
                    <input class="form-control @error('position_en') is-invalid @enderror" name="position_en"
                           value="{{ old('position_en') }}" id="position_en">
                    @error('position_en')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Phone number') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><img src="{{ asset('icons/phone-in-talk.svg') }}"></span>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                               value="{{ old('phone') }}" placeholder="0048 71 123 45 67" id="phone">
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
                               value="{{ old('mobile') }}" placeholder="0048 555 666 777" id="mobile">
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
                               value="{{ old('wechat') }}" id="wechat">
                    </div>
                    @error('wechat')
                    <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                    <label class="form-label mt-2">{{ __('Department') }}<span class="text-danger"> *</span></label>
                    <select class="form-select @error('department_id') is-invalid @enderror" name="department_id"
                            id="department_id">
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
                        <button class="btn btn-primary fw-bold w-50" type="button"
                                id="saveButton">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>

@endsection

@push('stylesheets.after')
    <style>
        #text {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 50px;
            color: white;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        #overlay {
            position: fixed; /* Sit on top of the page content */
            display: none; /* Hidden by default */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5); /* Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }
    </style>
@endpush

@push('scripts')
    <script>
        function on() {
            document.getElementById("overlay").style.display = "block";
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }

        const save = document.getElementById('saveButton');
        const form = document.getElementById('userForm');
        const fill = document.getElementById('fill-btn');
        save.onclick = function () {
            Swal.fire({
                title: 'Are you sure you want to create new user?',
                text: 'The user will receive the message with instructions for completing the registration.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#507023',
                cancelButtonColor: '#FF0000',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    on();
                    form.submit();
                }
            })
            off();
        };
        fill.onclick = function () {
            document.getElementById('name').value = 'Mateusz Kiezik';
            document.getElementById('email').value = 'mateusz.kiezik@gmail.com';
            document.getElementById('position').value = 'Spedytor Międzynarodowy';
            document.getElementById('position_en').value = 'International Freight Forwarder';
            document.getElementById('phone').value = '0048 71 154 25 44';
            document.getElementById('mobile').value = '0048 554 221 887';
            document.getElementById('wechat').value = 'MateuszRLT';
            document.getElementById('department_id').value = 4;
        };
    </script>
@endpush
