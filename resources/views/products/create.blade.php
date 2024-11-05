@extends('master')

@section('title', 'Add New Product')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">


                <h2 class="text-center mb-4">Add New Product</h2>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </div>
@endsection
