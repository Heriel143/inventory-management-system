<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductControler extends Controller
{
    public function allProducts()
    {
        // $suppliers = Supplier::all();
        $products = Product::where('region_id', Auth::user()->region_id)->get();
        return view('admin.product.allProducts', compact('products'));
    }
    public function addProduct()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.product.addProduct', compact('suppliers', 'units', 'categories'));
    }
    public function editProduct($id)
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.editProduct', compact('suppliers', 'units', 'categories', 'product'));
    }
    public function deleteProduct($id)
    {

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function storeProduct(Request $request)
    {
        Product::insert([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'quantity' => '0',
            'region_id' => Auth::user()->region_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }
    public function updateProduct(Request $request)
    {
        Product::findOrFail($request->id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }
    public function viewProduct(Request $request)
    {
        // dd($request->sensor);
        $sensor = $request->sensor;
        $sensor = (int)$sensor;
        $data = Product::findOrFail(1);
        $purchases = Purchase::where('product_id', 1)->where('status', 1)->selectRaw('SUM(buying_qty) as quantity')->get();
        $waiting = Purchase::where('product_id', 1)->where('status', 1)->where('received', 0)->selectRaw('SUM(buying_qty) as quantity')->get();
        $sells = InvoiceDetail::where('product_id', 1)->where('status', 1)->selectRaw('SUM(selling_qty) as quantity')->get();
        $purchases = $purchases[0]->quantity;
        $waiting = $waiting[0]->quantity;
        $sells = $sells[0]->quantity;
        // dd($data);
        return view('admin.product.viewProduct', compact('data', 'purchases', 'waiting', 'sells', 'sensor'));
    }
}
