@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice</h4>

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
                                        <h4 class="float-end font-size-16"><strong>Invoice No
                                                #{{ $invoice->invoice_no }}</strong></h4>
                                        <h3 class="flex">
                                            {{-- <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo"
                                                height="24" width="28" class="mr-2" /> --}}
                                            PostHarvest Real Time
                                            Inventory Management System (PHRTIMS)
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class=" col-6">
                                            <address>
                                                <strong>Inventory Management System</strong><br>
                                                Ilala, Dar-es-Salaam, Tanzania.<br>
                                                support@email.com
                                            </address>
                                        </div>
                                        <div class=" col-6 text-end">
                                            <address>
                                                <strong>Invoice Date:</strong><br>
                                                {{ date('d-m-Y', strtotime($invoice->date)) }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Proforma Invoice</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td>
                                                                <p>Customer Info</p>
                                                            </td>
                                                            <td>
                                                                <p>Name:
                                                                    <strong>{{ $invoice->payment->customer->name }}</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>Mobile:
                                                                    <strong>{{ $invoice->payment->customer->mobile_no }}</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>Email:
                                                                    <strong>{{ $invoice->payment->customer->email }}</strong>
                                                                </p>
                                                            </td>

                                                        </tr>
                                                    </thead>

                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Sl</th>
                                                            {{-- <th class="text-center">Category</th> --}}
                                                            <th class="text-center">Product Name</th>
                                                            {{-- <th class="text-center">Current Stock</th> --}}
                                                            <th class="text-center">Quatity</th>
                                                            <th class="text-center">Unit Price</th>
                                                            <th class="text-center">Total Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_sum = '0';
                                                        @endphp
                                                        @foreach ($invoice->invoiceDetail as $key => $details)
                                                            <tr>

                                                                <td class="text-center">{{ $key + 1 }}</td>
                                                                {{-- <td class="text-center">{{ $details->category->name }}</td> --}}
                                                                <td class="text-center">{{ $details->product->name }}</td>
                                                                {{-- <td class="text-center">{{ $details->product->quantity }}</td> --}}
                                                                <td class="text-center">{{ $details->selling_qty }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($details->unit_price) }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($details->selling_price) }}</td>
                                                            </tr>
                                                            @php
                                                                $total_sum += $details->selling_price;
                                                            @endphp
                                                        @endforeach
                                                        {{-- <tr>
                                                            <td colspan="3"></td>
                                                            <td colspan="1">Sub Total</td>
                                                            <td class="text-center">{{ number_format($total_sum) }}</td>
                                                        </tr>
                                                        @if ($invoice->payment->discount_amount)
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td colspan="1">Discount</td>
                                                                <td class="text-center">
                                                                    {{ number_format($invoice->payment->discount_amount) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td colspan="1">Paid Amount</td>
                                                            <td class="text-center">
                                                                {{ number_format($invoice->payment->paid_amount) }}</td>
                                                        </tr>
                                                        @if ($invoice->payment->due_amount)
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td colspan="1">Due Amount</td>
                                                                <td class="text-center">
                                                                    {{ number_format($invoice->payment->due_amount) }}</td>
                                                            </tr>
                                                        @endif --}}
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td colspan="1">
                                                                <h4>Grand Total</h4>
                                                            </td>
                                                            <td colspan="2">
                                                                <h4>Tsh
                                                                    {{ number_format($invoice->payment->total_amount, 1) }}
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
