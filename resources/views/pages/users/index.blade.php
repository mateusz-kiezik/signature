@extends('layouts.app')

@section('content')
    <div class="row justify-content-center bg-light">
        <div class="col-12">

            <h2 class="fw-bold text-center my-4 w-auto">{{ __('Users list') }}</h2>

            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('users.create') }}" class="btn btn-success w-auto">
                    <img src="{{ asset('icons/account-plus.svg') }}" class="filter-white">
                </a>
            </div>

            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('stylesheets.after')
    <style>
        .filter-white {
            filter: invert(93%) sepia(100%) saturate(0%) hue-rotate(248deg) brightness(106%) contrast(106%);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('data/users') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'department', name: 'department.short'},
                    {data: 'status', name: 'status'}
                ]
            });
        });
    </script>
@endpush
