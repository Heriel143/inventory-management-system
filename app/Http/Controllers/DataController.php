<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getData()
    {
        $data1 = Product::findOrFail(1);
        $purchases = Purchase::where('product_id', 1)->where('status', 1)->selectRaw('SUM(buying_qty) as quantity')->get();
        $waiting = Purchase::where('product_id', 1)->where('status', 1)->where('received', 0)->selectRaw('SUM(buying_qty) as quantity')->get();
        $sells = InvoiceDetail::where('product_id', 1)->where('status', 1)->selectRaw('SUM(selling_qty) as quantity')->get();
        // dd($purchases[0]->quantity);
        $data = [$data1[0]->quantity, $purchases[0]->quantity, $waiting[0]->quantity, $sells[0]->quantity];
        return response()->json($data);
    }
}
