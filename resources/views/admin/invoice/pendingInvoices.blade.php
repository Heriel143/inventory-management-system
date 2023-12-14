@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Pending Invoices</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="pb-4">

                                {{-- <a href="{{ route('add.invoice') }}"
                                    class="justify-center inline-block float-right px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800">
                                    <i class="fas fa-plus-circle"></i> Add
                                    Invoice</a> --}}

                                <h4 class="text-base font-semibold">Invoice Data </h4>
                            </div>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount(Tsh)</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($invoices as $key => $invoice)
                                        <tr>
                                            <td class=""> {{ $key + 1 }} </td>
                                            <td> {{ $invoice->payment->customer->name }}</td>
                                            <td> #{{ $invoice->invoice_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($invoice->date)) }} </td>
                                            <td> {{ $invoice->description }} </td>
                                            <td> {{ number_format($invoice->payment->total_amount) }} </td>
                                            <td>
                                                <span class="btn btn-warning ">Pending</span>
                                            </td>
                                            <td>
                                                @if ($invoice->status == '0')
                                                    <a href="{{ route('approve.invoice', $invoice->id) }}"
                                                        class="btn btn-success sm" title="Approve Invoice!" id="">
                                                        <i class="fas fa-check-circle "></i>
                                                    </a>
                                                    <a href="{{ route('delete.invoice', $invoice->id) }}"
                                                        class="btn btn-danger sm" title="Delete!" id="delete"> <i
                                                            class="fas fa-trash-alt "></i>
                                                    </a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
