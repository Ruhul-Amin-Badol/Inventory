@extends('master')

@section('title', 'Add New Supplier')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">

        
    <h2 class="text-center mb-4">Add New Supplier</h2>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Supplier</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
</div>
</div>
@endsection
