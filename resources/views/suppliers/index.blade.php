@extends('master')

@section('title', 'Suppliers List')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
    <h2 class="text-center mb-4">Suppliers</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add New Supplier <i class="fa-solid fa-plus"></i></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->mobile_no }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this supplier?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
         
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
