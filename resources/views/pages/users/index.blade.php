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

            {!! $html->table() !!}

        </div>
    </div>
@endsection

@push('stylesheets.after')
    <style>
        .filter-white {
            filter: invert(93%) sepia(100%) saturate(0%) hue-rotate(248deg) brightness(106%) contrast(106%);
        }

        #dataTableBuilder {
            text-align: center;
            vertical-align: middle;
        }

        .delete-icon:hover {
            filter: invert(20%) sepia(93%) saturate(5391%) hue-rotate(355deg) brightness(94%) contrast(111%);
        }

        .disable-icon:hover {
            filter: invert(74%) sepia(26%) saturate(7335%) hue-rotate(352deg) brightness(95%) contrast(108%);
        }

        .enable-icon:hover {
            filter: invert(64%) sepia(92%) saturate(591%) hue-rotate(46deg) brightness(108%) contrast(105%);
        }

        .edit-icon:hover {
            filter: invert(86%) sepia(97%) saturate(6766%) hue-rotate(346deg) brightness(103%) contrast(109%);
        }

        .details-icon:hover {
            filter: invert(12%) sepia(100%) saturate(4501%) hue-rotate(233deg) brightness(104%) contrast(111%);
        }
    </style>
@endpush

@push('scripts')
    {!! $html->scripts() !!}
    <script>
        function deleteUser (id) {
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: 'Deleting a user is irreversible. All data will be lost,',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#507023',
                cancelButtonColor: '#FF0000',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'users/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            let oTable = $('#dataTableBuilder').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        }

        function enableUser (id) {
            Swal.fire({
                title: 'Are you sure you want to enable this user?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#507023',
                cancelButtonColor: '#FF0000',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'users/' + id + '/enable',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            let oTable = $('#dataTableBuilder').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        }

        function disableUser (id) {
            Swal.fire({
                title: 'Are you sure you want to disable this user?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#507023',
                cancelButtonColor: '#FF0000',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'users/' + id + '/disable',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            let oTable = $('#dataTableBuilder').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        }
    </script>
@endpush
