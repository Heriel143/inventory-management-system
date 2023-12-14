@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Credit Customers Report </h4>

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
                            <h5 class="font-bold">Credit Customers Report</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div>

                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">


                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Sl</th>
                                                            <th class="text-center">Customer Name</th>
                                                            <th class="text-center">Invoice No</th>
                                                            <th class="text-center">Date</th>
                                                            <th class="text-center">Due Amount</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_sum = '0';
                                                        @endphp
                                                        @foreach ($payments as $key => $payment)
                                                            <tr>

                                                                <td class="text-center">{{ $key + 1 }}</td>
                                                                <td class="text-center">
                                                                    {{ $payment->customer->name }}</td>
                                                                <td class="text-center">#{{ $payment->invoice->invoice_no }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ date('d-m-Y', strtotime($payment->invoice->date)) }}
                                                                </td>

                                                                <td class="text-center">
                                                                    {{ number_format($payment->due_amount) }}
                                                                </td>

                                                            </tr>
                                                            @php
                                                                $total_sum += $payment->due_amount;
                                                            @endphp
                                                        @endforeach

                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td colspan="1">
                                                                <h4>Grand Total</h4>
                                                            </td>
                                                            <td colspan="1">
                                                                <h4>Tsh
                                                                    {{ number_format($total_sum, 2) }}
                                                                </h4>
                                                            </td>
                                                        </tr>
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
