@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="text-xl font-bold card-title">Product Page</h1>
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            @endif
                            <form action="{{ route('update.product') }}" method="post" class="mt-4" id="myForm">
                                @csrf
                                <input type="text" class="hidden" name="id" value="">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name:</label>
                                    <div class="col-sm-8 form-group">
                                        {{-- dd($data); --}}
                                        <p class="pt-2"> {{ $data->name }} </p>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Supplier Name</label>
                                    <div class="col-sm-8">
                                        <p class="pt-2"> {{ $data->supplier->name }} </p>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-8">
                                        <p class="pt-2"> {{ $data->category->name }} </p>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">System Weight</label>
                                    <div class="col-sm-8">
                                        <p class="pt-2"> {{ $data->quantity }} </p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Sensor Weight </label>
                                    {{-- <div class="col-sm-8">
                                        <p class="pt-2"> {{ $purchases - $sells }} </p>
                                    </div> --}}
                                    @if ($purchases - $sells == $sensor)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} </p>
                                        </div>
                                    @elseif($purchases - $sells > $sensor + $waiting)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} waiting for {{ $waiting }} and
                                                missing
                                                {{ $purchases - $sells - $sensor - $waiting }} </p>
                                        </div>
                                    @elseif($purchases - $sells == $sensor + $waiting)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} waiting for {{ $waiting }}
                                            </p>
                                        </div>
                                    @elseif($purchases - $sells > $sensor)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} and missing
                                                {{ $purchases - $sells - $sensor }}
                                            </p>
                                        </div>
                                    @endif
                                    {{-- @php
                                        global $store;
                                        $store = $purchases - $sells;
                                        // dd(gettype($store));
                                        global $remain;
                                        $remain = $waiting + $sensor;
                                        // dd($remain);
                                        global $missing;
                                        $missing = $store - $remain;
                                    @endphp
                                    @if ($store == $sensor)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} </p>
                                        </div>
                                    @elseif($store == $remain)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} waiting for {{ $waiting }} </p>
                                        </div>
                                    @elseif($store > $remain)
                                        <div class="col-sm-8">
                                            <p class="pt-2"> {{ $sensor }} waiting for {{ $waiting }} and
                                                missing {{ $missing }}</p>
                                        </div>
                                    @endif --}}

                                </div>
                                <!-- end row -->

                                {{-- <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800">Update
                                        Product</button>
                                </div> --}}
                                <!-- end row -->
                            </form>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    unit_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Product name',
                    },
                    supplier_id: {
                        required: 'Please select supplier name',
                    },
                    category_id: {
                        required: 'Please select category name',
                    },
                    unit_id: {
                        required: 'Please select unit name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
