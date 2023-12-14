<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Purchase;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function dashboard()
    {
        // $purchase = ;
        $purchase = DB::table('purchases')->selectRaw('SUM(buying_price) as total_amount')->where('region_id', Auth::user()->region_id)->where('status', 1)->get();
        $sales = DB::table('payments')->selectRaw('SUM(total_amount) as total_amount')->where('region_id', Auth::user()->region_id)->where('status', 1)->get();
        // dd($purchase[0]->total_amount)        $invoices = Invoice::where('region_id', Auth::user()->region_id)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        $invoices = Invoice::where('region_id', Auth::user()->region_id)->orderBy('date', 'desc')->orderBy('id', 'desc')->take(5)->get();

        $purchase = $purchase[0]->total_amount;
        $sales = $sales[0]->total_amount;
        // $purchases = Purchase::where('product_id', 1)->where('status', 1)->selectRaw('SUM(buying_qty) as quantity')->get();
        // $waiting = Purchase::where('product_id', 1)->where('status', 1)->where('received', 0)->selectRaw('SUM(buying_qty) as quantity')->get();
        // $sells = InvoiceDetail::where('product_id', 1)->where('status', 1)->selectRaw('SUM(selling_qty) as quantity')->get();
        // dd($sells[0]->quantity);
        return view('admin.index', compact('purchase', 'sales', 'invoices'));
    }
    public function allEmployees()
    {
        if (Auth::user()->role_id == 4) {

            $employees = User::latest()->get();
            return view('admin.employee.allEmployees', compact('employees'));
        } else {
            $employees = User::where('region_id', Auth::user()->region_id)->get();
            return view('admin.employee.allEmployees', compact('employees'));
        }
    }

    public function addEmployee()
    {
        $roles = Role::all();
        if (Auth::user()->role_id != 4)
            $roles = Role::take(3)->get();
        $regions = Region::all();
        return view('admin.employee.addEmployee', compact('roles', 'regions'));
    }

    public function storeEmployee(Request $request)
    {

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(200, 200)->save('upload/employee/' . $image_name);
        $save_url = 'upload/employee/' . $image_name;

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'profile_image' => $save_url,
            'role_id' => $request->employee_role,
            'region_id' => $request->region_id,
            // 'username' => strtolower(trim($request->name)),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employees')->with($notification);
        // dd(Hash::make('12345678'));
    }

    public function editEmployee($id)
    {
        $employee = User::findOrFail($id);
        // dd($employee);
        $roles = Role::all();
        // $roles = Role::all();
        if (Auth::user()->role_id != 4)
            $roles = Role::take(3)->get();
        $regions = Region::all();
        return view('admin.employee.editEmployee', compact('employee', 'roles', 'regions'));
    }
    public function deleteEmployee($id)
    {
        $customer = User::findOrFail($id);
        $img = $customer->profile_image;
        unlink($img);
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Employee deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function updateEmployee(Request $request)
    {
        $employee = User::findOrFail($request->id);
        $employee->name = $request->name;
        $employee->region_id = $request->region_id;
        $employee->email = $request->email;
        $employee->role_id = $request->employee_role;
        // $employee->updated_by = Auth::user()->id;
        $employee->updated_at = Carbon::now();

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save('upload/employee/' . $image_name);
            $save_url = 'upload/employee/' . $image_name;
            $employee->profile_image = $save_url;
        }

        $employee->save();

        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employees')->with($notification);
    }
}
