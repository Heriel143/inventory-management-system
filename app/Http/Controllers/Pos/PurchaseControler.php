<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseControler extends Controller
{
    public function allPurchases()
    {
        $purchases = Purchase::where('region_id', Auth::user()->region_id)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.allPurchases', compact('purchases'));
    }
    public function pendingPurchases()
    {
        $purchases = Purchase::where('status', 0)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.pendingPurchases', compact('purchases'));
    }

    public function receivePurchases()
    {
        $purchases = Purchase::where('status', 1)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.pendingPurchases', compact('purchases'));
    }

    public function approvePurchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        Product::where('id', $purchase->product_id)->increment('quantity', $purchase->buying_qty);
        $purchase->status = '1';
        $purchase->updated_by = Auth::user()->id;
        $purchase->save();

        $notification = array(
            'message' => 'Purchase Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function addPurchase()
    {
        $purchase_data = Purchase::orderBy('id', 'desc')->first();
        $purchase_no = '0';
        if ($purchase_data == null) {
            $purchase_no += 1;
        } else {
            $purchase_no = $purchase_data->purchase_no + 1;
        }
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.purchase.addPurchase', compact('categories', 'suppliers', 'units', 'purchase_no'));
    }
    public function getCategory(Request $request)
    {

        $categories = Product::with(['category'])->select('category_id')->where('supplier_id', $request->supplier_id)->groupBy('category_id')->get();
        // dd($categories);
        return response()->json($categories);
    }

    public function getProduct(Request $request)
    {

        $products = Product::where('supplier_id', $request->supplier_id)->where('region_id', Auth::user()->region_id)->get();
        // dd($products);
        return response()->json($products);
    }
    public function purchaseReport()
    {
        return view('admin.purchase.purchaseReport');
    }
    public function printPurchaseReport(Request $request)
    {
        $start_date = date('y-m-d', strtotime($request->start_date));
        $end_date = date('y-m-d', strtotime($request->end_date));
        $purchases = Purchase::whereBetween('date', [$start_date, $end_date])->get();
        return view('admin.purchase.printPurchaseReport', compact('purchases', 'start_date', 'end_date'));
    }

    public function deletePurchase($id)
    {
        Purchase::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Purchase item deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function storePurchase(Request $request)
    {
        if ($request->supplier_id == null) {
            $notification = array(
                'message' => 'Sorry you did not select Supplier name',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else if ($request->product_id == null) {
            $notification = array(
                'message' => 'Sorry you do not select product name',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $count_supplier = count($request->supplier_id);
            for ($i = 0; $i < $count_supplier; $i++) {
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->product_id = $request->product_id[$i];
                // $purchase->category_id = $request->category_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->region_id = Auth::user()->region_id;
                $purchase->received = 0;
                $purchase->created_by = Auth::user()->id;
                $purchase->created_at = Carbon::now();
                $purchase->status = '0';
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Data saved successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.purchases')->with($notification);
    }
}
