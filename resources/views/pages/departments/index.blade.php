@extends('layouts.app')

@section('content')
    <a href="{{ route('departments.create') }}" class="btn btn-success">Add</a>
    <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th>Short</th>
            <th>Name</th>
            <th>City</th>
            <th></th>
        </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('departments') }}',
                columns: [
                    { data: 'short', name: 'short' },
                    { data: 'name', name: 'name' },
                    { data: 'city', name: 'city' }
                ]
            });
        });
    </script>
@endpush
