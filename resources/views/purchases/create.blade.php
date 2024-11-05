@extends('master')

@section('content')
<div class="container mt-5">
    <h2>Purchase Create</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Purchase Form -->
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Product Information Section -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                <h5>Product Information</h5>
                <div class="row">
                    <div class="col-6">
                         <!-- Product Dropdown -->
                <div class="form-group mb-3">
                    <label>Product *</label>
                    <select id="product" class="form-control">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                    </div>
                    <div class="col-2">
                          <!-- Quantity Input -->
                <div class="form-group mb-3">
                    <label>Quantity *</label>
                    <input type="number" id="quantity" class="form-control" >
                </div>

                    </div>
                    <div class="col-2">
                         <!-- Unit Price Input -->
                <div class="form-group mb-3">
                    <label>Unit Price *</label>
                    <input type="number" id="unit_price" class="form-control"  >
                </div>

                    </div>
                    <div class="col-2">
                         <!-- Add Item Button -->
                         <div class="mt-4">
                            <button type="button" class="btn btn-primary mb-3" onclick="addItem()"><i class="fa-solid fa-plus"></i></button>
                         </div>
               

                    </div>
                </div>
                
                <!-- Items Table -->
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>S/L</th>
                            <th>Item Details</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="items-table">
                        <!-- Dynamically added rows will appear here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                            <td colspan="2" id="grand-total">0.00</td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
            </div>

            <!-- Other Information Section -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                <h5>Other Information</h5>

                <!-- Date Input -->
                <div class="form-group mb-3">
                    <label>Date *</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <!-- Supplier Dropdown -->
                <div class="form-group mb-3">
                    <label>Supplier *</label>
                    <select name="supplier_id" class="form-control" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Notes Textarea -->
                <div class="form-group mb-3">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>

                <!-- Submit and Cancel Buttons -->
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-danger">Cancel</a>
                
            </div>
        </div>
            </div>
        </div>
    </form>
</div>

<!-- jQuery to Handle Dynamic Item Addition -->
<script>
    let grandTotal = 0;
    let itemIndex = 0;

    function addItem() {
        let productSelect = $('#product');
        let productId = productSelect.val();
        let productName = productSelect.find('option:selected').text();
        let quantity = $('#quantity').val();
        let unitPrice = $('#unit_price').val();
        let totalPrice = (quantity * unitPrice).toFixed(2);

        // Validation
        if (!productId) {
            alert('Please select a product.');
            return;
        }
        if (!quantity || quantity < 1) {
            alert('Please enter a valid quantity.');
            return;
        }
        if (!unitPrice || unitPrice < 0) {
            alert('Please enter a valid unit price.');
            return;
        }

        // Create Table Row
        let row = `
            <tr>
                <td>${itemIndex + 1}</td>
                <td>${productName}</td>
                <td>${quantity}</td>
                <td>${unitPrice}</td>
                <td>${totalPrice}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this, ${itemIndex}, ${totalPrice})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            <input type="hidden" name="product_items[${itemIndex}][product_id]" value="${productId}">
            <input type="hidden" name="product_items[${itemIndex}][quantity]" value="${quantity}">
            <input type="hidden" name="product_items[${itemIndex}][unit_price]" value="${unitPrice}">
        `;
        $('#items-table').append(row);

        // Update Grand Total
        grandTotal += parseFloat(totalPrice);
        $('#grand-total').text(grandTotal.toFixed(2));

        // Reset Inputs
        productSelect.val('');
        $('#quantity').val('');
        $('#unit_price').val('');

        itemIndex++;
    }

    function removeItem(button, index, totalPrice) {
        // Remove the table row
        $(button).closest('tr').remove();

        // Remove the corresponding hidden inputs
        $(`input[name="product_items[${index}][product_id]"]`).remove();
        $(`input[name="product_items[${index}][quantity]"]`).remove();
        $(`input[name="product_items[${index}][unit_price]"]`).remove();

        // Update Grand Total
        grandTotal -= parseFloat(totalPrice);
        $('#grand-total').text(grandTotal.toFixed(2));
    }
</script>

@endsection
