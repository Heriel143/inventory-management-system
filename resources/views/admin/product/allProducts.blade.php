@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Products</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="pb-4">

                                <a href="{{ route('add.product') }}"
                                    class="justify-center inline-block float-right px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800"><i
                                        class="fas fa-plus-circle"></i> Add
                                    Product</a>

                                <h4 class="text-base font-semibold">All Products Data </h4>
                            </div>

                            <form action="{{ route('view.product') }}" method="post">
                                @csrf
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Sensor</th>
                                            <th>Unit</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Action</th>

                                    </thead>


                                    <tbody>

                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td class=""> {{ $key + 1 }} </td>
                                                <td> {{ $product->name }} </td>
                                                <td> {{ $product->quantity }} </td>
                                                <td class={{ $product->id == 1 ? 'sensor' : '' }}></td>
                                                @if ($product->id == 1)
                                                    <input type="hidden" value="" class="sensor" name="sensor">
                                                    <input type="hidden" value="{{ $product->id }}" class=""
                                                        name="product_id">
                                                @endif
                                                {{-- <td> <input type="text" value="" class={{$product->id==1 ? 'sensor' : ''}}  disabled>  </td> --}}
                                                <td> {{ $product->unit->name }} </td>
                                                <td> {{ $product->category->name }} </td>
                                                <td> {{ $product->supplier->name }} </td>


                                                <td>
                                                    {{-- @if ($product->id == 1) --}}
                                                    {{-- <input type="submit" value="View" class="btn btn-success"> --}}
                                                    <button type="submit" class="btn btn-success sm">
                                                        View</button>
                                                    {{-- <a href="{{ route('edit.product', $product->id) }}"
                                                                class="btn btn-info sm" title="Edit Data"><i
                                                                    class="fas fa-edit"></i></a> --}}
                                                    {{-- @endif --}}
                                                    <a href="{{ route('edit.product', $product->id) }}"
                                                        class="btn btn-info sm" title="Edit Data"><i
                                                            class="fas fa-edit"></i></a>

                                                    <a href="{{ route('delete.product', $product->id) }}"
                                                        class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                            class="fas fa-trash-alt"></i>
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            {{-- <input type="hidden"> --}}

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <script>
        $(document).ready(function() {

            var url =
                "https://api.thingspeak.com/channels/2223180/feeds.json?results=1";

            $.getJSON(url, function(data) {
                console.log(data.feeds[0].field1);
                $('.sensor').val(data.feeds[0].field1);
                $('.sensor').html(data.feeds[0].field1);
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {

            // $('#sensor').change(function() {

            // var url = "http://127.0.0.1:8000/getdata";

            // $.getJSON(url, function(data) {
            //     console.log(data);
            //     // $('#sensor').html(data.feeds[0].field1);
            // });
            $.ajax({
                url: "{{ route('get-data') }}",
                type: 'GET',
                data: {
                    // category_id: category_id,
                    // supplier_id: supplier_id
                },
                success: function(data) {
                    console.log(data);
                    // var html = '<option value="">Select Product</option>';
                    // $.each(data, function(key, v) {
                    //     html += '<option value="' + v.id +
                    //         '">' + v.name + '</option>'
                    // });
                    $('#sensor').append(data);
                }
            });
            // });
        });
    </script> --}}
@endsection
