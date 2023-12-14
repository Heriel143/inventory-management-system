<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReceivedPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceivedPurchaseController extends Controller
{
    public function all()
    {
        $purchases = Purchase::where('status', 1)->where('received', 0)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.receivePurchases', compact('purchases'));
    }

    public function receiveDetails($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('admin.purchase.receiveDetails', compact('purchase'));
    }
    public function receivedAllIncomplete()
    {
        $purchases = ReceivedPurchase::where('status', 0)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.receivedAllIncomplete', compact('purchases'));
    }
    public function receivedAllIncompletePrint()
    {
        $purchases = ReceivedPurchase::where('status', 0)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.printIncompleteReceived', compact('purchases'));
    }

    public function receiveDetailOn(Request $request)
    {
        $purchase = Purchase::findOrFail($request->purchase_id);
        // Product::where('id', $purchase->product_id)->increment('quantity', $request->quantity);
        ReceivedPurchase::insert([
            "purchase_id" => $request->purchase_id,
            'amount' => $request->quantity,
            'description' => $request->description,
            'status' => 0,
            "user_id" => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        $purchase->received = 1;
        $purchase->save();

        $notification = array(
            'message' => '' . $purchase->product->name . ' Received successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('receive.purchases.all')->with($notification);
    }

    public function receive($id)
    {
        $purchase = Purchase::findOrFail($id);
        // Product::where('id', $purchase->product_id)->increment('quantity', $purchase->buying_qty);
        ReceivedPurchase::insert([
            "purchase_id" => $id,
            'amount' => $purchase->buying_qty,
            'description' => 'received with great quality',
            'status' => 1,
            "user_id" => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        $purchase->received = 1;
        $purchase->save();

        $notification = array(
            'message' => '' . $purchase->product->name . ' Received successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
