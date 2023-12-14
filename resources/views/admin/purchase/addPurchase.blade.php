@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="text-base card-title">Add Purchase</h1>
                            <div class="mt-3 row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input name="date" class="form-control example-date-input" type="date"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Purchase No</label>
                                        <input name="purchase_no" value="{{ $purchase_no }}"
                                            class="form-control example-date-input" type="text" readonly
                                            id="purchase_no">
                                    </div>
                                </div>
                                <div class="mb-2 col-md-4">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Supplier
                                            Name</label>
                                        <select name="supplier_id" class="form-select select2"
                                            aria-label="Default select example" id="supplier_id">
                                            <option selected="">select supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category
                                            Name</label>
                                        <select name="category_id" class="form-select select2"
                                            aria-label="Default select example" id="category_id">
                                            <option selected="">select</option>

                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Product
                                            Name</label>
                                        <select name="product_id" id="product_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="-ml-16 col-md-2">
                                    <div class="pt-[29px] md-3">
                                        <span
                                            class="justify-center inline-block float-right px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:cursor-pointer addeventmore hover:bg-blue-800">

                                            <i class="fas fa-plus-circle">
                                                Add
                                                More</i>
                                        </span>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.purchase') }}" method="post">
                                @csrf
                                <table class="border-blue-900 table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Description</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow" id="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="bg-gray-400 form-control estimated_amount"
                                                    readonly>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                <br>
                                <div class="flex justify-end form-group">
                                    <button type="submit"
                                        class="px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800">Add
                                        Purchase</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
    </div>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class = "delete_add_more_item"
        id = "delete_add_more_item" >
            <input type = "hidden"
        name = "date[]"
        value = "@{{ date }}">
            <input type = "hidden"
        name = "purchase_no[]"
        value = "@{{ purchase_no }}" >
            <td >
                <input type = "hidden"
        name = "supplier_id[]"
        value = "@{{ supplier_id }}" >
                @{{ supplier_name }}
                </td>
            <td >
            <input type = "hidden"
        name = "product_id[]"
        value = "@{{ product_id }}" >
            @{{ product_name }}
            </td>
            <td >
            <input type = "number"
        min = "1"
        class = "text-left form-control buying_qty"
        name = "buying_qty[]"
        value = "" >

            </td>
        <td >

            <input type = "number"
        class = "text-left form-control unit_price"
        name = "unit_price[]"
        value = "" >

        </td>
        <td >

            <input type = "text"
        class = " form-control"
        name = "description[]"
        value = "" >

        </td>
        <td >

            <input type = "number"
        class = "text-left form-control buying_price"
        name = "buying_price[]"
        value = "0"
        readonly >

        </td>
        <td >

            <i class = "btn btn-danger btn-sm fas fa-window-close removeeventmore" > </i>
                </td >
            </tr>
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.addeventmore', function() {
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var supplier_name = $('#supplier_id').find('option:selected').text();
                // var category_id = $('#category_id').val();
                // var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();

                if (date == '') {
                    $.notify('Date is required', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (purchase_no == '') {
                    $.notify('Purchase No is required', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                if (supplier_id == '') {
                    $.notify('Date is required', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }
                // if (category_id == '') {
                //     $.notify('Category is required', {
                //         globalPosition: 'top right',
                //         className: 'error'
                //     })
                //     return false;
                // }
                if (product_id == '') {
                    $.notify('Product is required', {
                        globalPosition: 'top right',
                        className: 'error'
                    })
                    return false;
                }

                var source = $('#document-template').html();
                var tamplate = Handlebars.compile(source);
                var data = {
                    date: date,
                    purchase_no: purchase_no,
                    supplier_name: supplier_name,
                    supplier_id: supplier_id,
                    // category_id: category_id,
                    // category_name: category_name,
                    product_id: product_id,
                    product_name: product_name
                };
                var html = tamplate(data);
                $('#addRow').prepend(html);

            });

            $(document).on('click', '.removeeventmore', function(event) {
                $(this).closest('.delete_add_more_item').remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price,.buying_qty', function() {
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.buying_qty').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('input.buying_price').val(total);
                totalAmountPrice();
            });

            function totalAmountPrice() {
                var sum = 0;
                $('.buying_price').each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }

        })
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#supplier_id', function() {
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-category') }}",
                    type: 'GET',
                    data: {
                        supplier_id: supplier_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.category_id +
                                '">' + v.category.name + '</option>'
                        });
                        $('#category_id').html(html);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(function() {

            $(document).on('change', '#supplier_id', function() {
                // var category_id = $(this).val();
                var supplier_id = $('#supplier_id').val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: 'GET',
                    data: {
                        // category_id: category_id,
                        supplier_id: supplier_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id +
                                '">' + v.name + '</option>'
                        });
                        $('#product_id').html(html);
                    }
                })
            })
        })
    </script>
@endsection
