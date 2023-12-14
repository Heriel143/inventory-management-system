@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Supplier Report </h4>
                        <a href="{{ route('all.invoices') }}"
                            class="justify-center inline-block float-right px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">

                                        <h3 class="flex font-bold">
                                            {{-- <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo"
                                                height="24" width="28" class="mr-2 " /> --}}
                                            PostHarvest Real Time
                                            Inventory Management System (PHRTIMS)
                                        </h3>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong>Inventory Management System</strong><br>
                                                Ilala, Dar-es-Salaam, Tanzania.<br>
                                                support@email.com
                                            </address>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Supplier Products Report
                                                    {{-- <span
                                                        class="btn btn-info">{{ date('d-m-Y', strtotime($start_date)) }}</span>
                                                    - <span
                                                        class="btn btn-warning">{{ date('d-m-Y', strtotime($end_date)) }}</span> --}}
                                                </strong>
                                            </h3>
                                        </div>
                                        <h4 class="text-center">Supplier Name: {{ $products[0]->supplier->name }} </h4>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">


                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Sl</th>
                                                            <th class="text-center">Category</th>
                                                            {{-- <th class="text-center">Current Stock</th> --}}
                                                            <th class="text-center">Product</th>
                                                            <th class="text-center">Unit</th>
                                                            <th class="text-center">Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($products as $key => $product)
                                                            <tr>

                                                                <td class="text-center">{{ $key + 1 }}</td>
                                                                <td class="text-center">{{ $product->category->name }}</td>
                                                                {{-- <td class="text-center">{{ $details->product->quantity }}</td> --}}
                                                                <td class="text-center">
                                                                    {{ $product->name }}</td>
                                                                <td class="text-center">
                                                                    {{ $product->unit->name }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($product->quantity) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                            @php
                                                $date = new DateTime('now', new DateTimeZone('Africa/Nairobi'));
                                            @endphp
                                            <i>Print Time: {{ $date->format('F j, Y, g:i a') }}</i>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-print"></i></a>
                                                    <a href="#"
                                                        class="btn btn-primary waves-effect waves-light ms-2">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
