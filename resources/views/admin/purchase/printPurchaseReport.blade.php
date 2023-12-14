@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daily Purchase Report </h4>

                        <div class="page-title-right">
                            <ol class="m-0 breadcrumb">
                                <li class="breadcrumb-item"></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>

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
                                        <div class="mt-4 col-6">
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
                                            <h3 class="font-size-16"><strong>Purchase Report from
                                                    <span
                                                        class="btn btn-info">{{ date('d-m-Y', strtotime($start_date)) }}</span>
                                                    - <span
                                                        class="btn btn-success">{{ date('d-m-Y', strtotime($end_date)) }}</span>
                                                </strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">


                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Sl</th>
                                                            <th class="text-center">Purchase No</th>
                                                            <th class="text-center">Date</th>
                                                            <th class="text-center">Product Name</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Unit Price</th>
                                                            <th class="text-center">Total Price</th>
                                                            <th class="text-center">Approved By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_sum = '0';
                                                        @endphp
                                                        @foreach ($purchases as $key => $purchase)
                                                            <tr>

                                                                <td class="text-center">{{ $key + 1 }}</td>
                                                                <td class="text-center">
                                                                    {{ $purchase->purchase_no }}</td>
                                                                <td class="text-center">
                                                                    {{ date('d-m-Y', strtotime($purchase->date)) }}</td>
                                                                <td class="text-center">{{ $purchase->product->name }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $purchase->buying_qty }}
                                                                    {{ $purchase->product->unit->name }} </td>
                                                                <td class="text-center">
                                                                    {{ $purchase->unit_price }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($purchase->buying_price) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $purchase->user->name }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total_sum += $purchase->buying_price;
                                                            @endphp
                                                        @endforeach

                                                        <tr>
                                                            <td colspan="5"></td>
                                                            <td colspan="1">
                                                                <h4>Grand Total</h4>
                                                            </td>
                                                            <td colspan="2">
                                                                <h4>Tsh
                                                                    {{ number_format($total_sum, 2) }}
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

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
