@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('departments.store') }}">
    @csrf
    <input class="form-control" name="short" placeholder="Short">
    <input class="form-control" name="name" placeholder="Name">
    <input class="form-control" name="legal_form" placeholder="Legal form">
    <input class="form-control" name="street" placeholder="Street">
    <input class="form-control" name="postal_code" placeholder="Postal code">
    <input class="form-control" name="city" placeholder="City">
    <input class="form-control" name="country" placeholder="Country">
    <input class="form-control" name="vat_id" placeholder="Vat ID">
    <input class="form-control" name="regon" placeholder="Regon">
    <input class="form-control" name="krs" placeholder="KRS">
    <input class="form-control" name="aeo" placeholder="AEO">
    <input class="form-control" name="fmc" placeholder="FMC">
    <input class="form-control" name="phone" placeholder="Phone number">
    <button class="btn btn-primary" type="submit">Save</button>
</form>
@endsection
