<!-- resources/views/purchases/index.blade.php -->
@extends('master')

@section('content')
<div class="container mt-5">
    <h2>Purchase Orders</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('purchases.create') }}" class="btn btn-primary">Add Purchase Orders</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Order No.</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->order_no }}</td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ number_format($purchase->total, 2) }}</td>
                        <td>{{ number_format($purchase->paid, 2) }}</td>
                        <td>{{ number_format($purchase->due, 2) }}</td>
                        <td>
                            <span class="badge {{ $purchase->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                {{ $purchase->status == 1 ? 'Received' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $purchase->notes }}</td>
                        <td>
                            <!-- Action Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('purchases.show', $purchase->id) }}">View</a></li>
                                    <li><a class="dropdown-item" href="{{ route('purchases.edit', $purchase->id) }}">Edit</a></li>
                                    <li>
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this purchase?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total</td>
                    <td>{{ number_format($purchases->sum('total'), 2) }}</td>
                    <td>{{ number_format($purchases->sum('paid'), 2) }}</td>
                    <td>{{ number_format($purchases->sum('due'), 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Pagination -->
    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $purchases->links() }}
    </div> --}}
</div>
@endsection
