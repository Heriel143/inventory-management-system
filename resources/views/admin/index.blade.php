@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="m-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-truncate font-size-14">Total Purchase</p>
                                    <h4 class="mb-2">{{ number_format($purchase) }}</h4>
                                    <p class="mb-0 text-muted"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="align-middle ri-arrow-right-up-line me-1"></i>9.23%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-truncate font-size-14">Total Sales</p>
                                    <h4 class="mb-2">{{ number_format($sales) }}</h4>
                                    <p class="mb-0 text-muted"><span class="text-danger fw-bold font-size-12 me-2"><i
                                                class="align-middle ri-arrow-right-down-line me-1"></i>1.09%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-truncate font-size-14">New Users</p>
                                    <h4 class="mb-2">8246</h4>
                                    <p class="mb-0 text-muted"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="align-middle ri-arrow-right-up-line me-1"></i>16.2%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-truncate font-size-14">Unique Visitors</p>
                                    <h4 class="mb-2">29670</h4>
                                    <p class="mb-0 text-muted"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="align-middle ri-arrow-right-up-line me-1"></i>11.7%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col --> --}}
            </div><!-- end row -->
            <div class="mb-4">

                <iframe width="450" height="260" style="border: 1px solid #cccccc;"
                    src="https://thingspeak.com/channels/2223180/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
                {{-- <iframe width="450" height="260" style="border: 1px solid #cccccc;"
                    src="https://thingspeak.com/channels/2223347/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe> --}}
            </div>
            {{-- <div>
                <h1>
                    Thingspeak graph
                </h1>
                <div class="container" style="background-color:#f3f4f7;
            width: 80%;
            margin: auto;">
                    <canvas id="myChart">

                    </canvas>

                    <script>
                        $(document).ready(function() {
                            function getData() {


                                var url =
                                    "https://api.thingspeak.com/channels/2217276/fields/1.json?api_key=QU5B71PBFSVRCJ1B&results=20";

                                $.getJSON(url, function(data) {
                                    var field1Values = [];
                                    // var field2Values = [];
                                    var timestamps = [];

                                    $.each(data.feeds, function(index, feed) {
                                        field1Values.push(feed.field1);
                                        // field2Values.push(feed.field2);
                                        timestamps.push(feed.created_at);
                                    });
                                    //dealing the the graph
                                    var ctx = document.getElementById('myChart').getContext('2d');

                                    var chart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: timestamps,
                                            datasets: [{
                                                    label: 'Weight',
                                                    data: field1Values,
                                                    borderColor: '#999',
                                                    backgroundColor: '#84bd00',
                                                    fill: false

                                                    // borderWidth: 1
                                                },
                                                // {
                                                //     label: 'Humidity',
                                                //     data: field2Values,
                                                //     borderColor: '',
                                                //     backgroundColor: '#00205b',
                                                //     borderWidth: 1
                                                // }
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                // yAxes: [{
                                                //     thicks: {
                                                //         beginAtZero: true
                                                //     }
                                                // }],
                                                x: {
                                                    type: 'linear'
                                                }

                                            }
                                        }
                                    });




                                });

                            }
                            getData();

                        });
                    </script>
                </div> --}}
            {{--  --}}
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                            </div>

                            <h4 class="mb-4 card-title">Latest Sales</h4>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle table-centered table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Invoice no.</th>
                                            <th>Date</th>
                                            <th>Amount(Tsh)</th>
                                            <th>Action</th>
                                            {{-- <th style="width: 120px;">Salary</th> --}}
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0"> {{ $invoice->payment->customer->name }} </h6>
                                                </td>
                                                <td>{{ $invoice->invoice_no }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($invoice->date)) }}
                                                </td>
                                                <td>
                                                    {{ number_format($invoice->payment->total_amount) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('view.invoice', $invoice->id) }}"
                                                        class="btn btn-success sm" title="Print Invoice" id="print"> <i
                                                            class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                                {{-- <td>$42,450</td> --}}
                                            </tr>
                                        @endforeach

                                        <!-- end -->

                                        <!-- end -->
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                {{-- !-- end col --> --}}
            </div>
            <!-- end row -->
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('get-data') }}",
                type: 'GET',
                data: {
                    // category_id: category_id,
                    supplier_id: supplier_id
                },
                success: function(data) {
                    console.log(data);
                    // var html = '<option value="">Select Product</option>';
                    // $.each(data, function(key, v) {
                    //     html += '<option value="' + v.id +
                    //         '">' + v.name + '</option>'
                    // });
                    // $('#product_id').html(html);
                }
            })

        });
    </script>
@endsection
