@extends('master')

@section('title', 'Edit Supplier')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
    <h2 class="text-center mb-4">Edit Supplier</h2>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" value="{{ $supplier->mobile_no }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $supplier->address }}">
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $supplier->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$supplier->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Supplier</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
</div>
</div>
@endsection
