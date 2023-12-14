@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Invoices</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="pb-4">

                                <a href="{{ route('add.invoice') }}"
                                    class="justify-center inline-block float-right px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800">
                                    <i class="fas fa-plus-circle"></i> Add
                                    Invoice</a>

                                <h4 class="text-base font-semibold">All Invoice Data </h4>
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

                                                <a href="{{ route('view.proforma', $invoice->id) }}"
                                                    class="btn btn-primary sm" title="Print Proforma" id="print"> <i
                                                        class="fas fa-print"></i>
                                                </a>
                                                <a href="{{ route('view.invoice', $invoice->id) }}"
                                                    class="btn btn-success sm" title="Print Invoice" id="print"> <i
                                                        class="fas fa-print"></i>
                                                </a>
                                                <a href="{{ route('view.delivery', $invoice->id) }}"
                                                    class="btn btn-warning sm" title="Print Delivery Note" id="print">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                @if ($invoice->status == 0)
                                                    <a href="#" class="btn btn-warning sm" title="Print Invoice"
                                                        id="print"> Pending
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
