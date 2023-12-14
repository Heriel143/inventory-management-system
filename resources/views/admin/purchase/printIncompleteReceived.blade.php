@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Incomplete Received Purchases </h4>

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

                                        <h3 class="flex">
                                            {{-- <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo"
                                                height="24" width="28" class="mr-2" /> --}}
                                            PostHarvest Real Time
                                            Inventory Management System (PHRTIMS)
                                        </h3>
                                    </div>
                                    <hr>

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
                            <h5 class="font-bold">Purchase Report</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div>

                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">


                                                    <thead>
                                                        <tr>

                                                            <th>P No.</th>
                                                            <th>Product Name</th>
                                                            <th>Received Date</th>
                                                            <th>Supplier</th>
                                                            <th>Received</th>
                                                            <th>Expected</th>
                                                            <th>Price</th>
                                                            <th>Description</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($purchases as $key => $purchase)
                                                            <tr>
                                                                {{-- <td class=""> {{ $key + 1 }} </td> --}}
                                                                <td> {{ $purchase->purchase_id }} </td>
                                                                <td> {{ $purchase->purchase->product->name }} </td>
                                                                <td> {{ date('d-m-Y', strtotime($purchase->created_at)) }}
                                                                </td>
                                                                <td> {{ $purchase->purchase->supplier->name }} </td>
                                                                {{-- <td> {{ $purchase->user->name }} </td> --}}
                                                                <td> {{ $purchase->amount }} </td>
                                                                <td> {{ number_format($purchase->purchase->buying_qty) }}
                                                                </td>
                                                                <td> {{ number_format($purchase->purchase->buying_price) }}
                                                                </td>
                                                                <td> {{ $purchase->description }} </td>


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
