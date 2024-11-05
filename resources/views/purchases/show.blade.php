@extends('master')

@section('content')
<div class="container mt-5">
    <h2>Purchase Orders Details</h2>
    <div class="card shadow-lg">
        <div class="card-body">

 
    <div class="d-flex justify-content-end mb-3">
        <button onclick="window.print()" class="btn btn-primary">Print <i class="fa-solid fa-print"></i></button>
    </div>

    <!-- Supplier and Order Info -->
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Supplier:</strong> {{ $purchase->supplier->name }}</p>
        </div>
        <div class="col-md-6 text-end">
            <p><strong>ORDER NO.:</strong> {{ $purchase->order_no }}</p>
            <p><strong>DATE:</strong> {{ $purchase->date->format('d-m-Y') }}</p>
        </div>
    </div>

    <!-- Purchase Items Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>S/L</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Product</th>
                <th>Code</th>
                <th>Unit</th>
                <th>Pur. Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($purchase->purchaseItems as $index => $item)
                @php
                    $totalPrice = $item->quantity * $item->unit_price;
                    $grandTotal += $totalPrice;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->brand ?? 'N/A' }}</td>
                    <td>{{ $item->product->category ?? 'N/A' }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->code ?? 'N/A' }}</td>
                    <td>{{ $item->product->unit ?? 'N/A' }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end ">{{ number_format($totalPrice, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-end fw-bold">Total</td>
                <td class="text-center fw-bold">{{ $purchase->purchaseItems->sum('quantity') }}</td>
                <td class="text-end fw-bold">{{ number_format($grandTotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-end fw-bold">Payment</td>
                <td></td>
                <td class="text-end fw-bold">{{ number_format($purchase->paid, 2) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-end fw-bold">Due</td>
                <td></td>
                <td class="text-end fw-bold">{{ number_format($grandTotal - $purchase->paid, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Footer Information -->
    <div class="row mt-4">
        <div class="col-md-4 col-lg-4 text-center">
            <strong>Warehouse</strong>
        </div>
        <div class="col-md-4 col-lg-4 text-center">
            <strong>Created By</strong>
        </div>
        <div class="col-md-4 col-lg-4 text-center">
            <strong>Checked By</strong>
        </div>
    </div>
</div>
</div>
</div>

<!-- Add CSS to hide non-printable elements during printing -->
<style>
    @media print {
        .btn, .d-flex { display: none; }
    }
</style>
@endsection
