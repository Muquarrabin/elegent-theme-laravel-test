<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{

    public function index() : View
    {
        return view('dashboard');
    }

    public function customerDataAjax(Request $request)
    {
        $customers=Customer::latest();

        return Datatables::of($customers)

            ->addColumn('action', function ($customer) {
                $markup= '<a href="#" onclick="createAccount(' . $customer->id . ')" class="btn btn-primary m-1"> Create WordPress Account</a>';
                return $markup;
            })
            ->rawColumns(['action'])
            ->setFilteredRecords($customers->count())
            ->make(true);
    }
    /**
     * Display the user's profile form.
     */
    public function create(): View
    {
        return view('customer-profile');
    }


    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'budget' => 'required',
            'message' => 'required',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>$request->phone,
            'budget' =>$request->budget,
            'message' =>$request->message,
        ]);
        return Redirect::route('customer.create')->with('status', 'Customer Data Stored Successfully!');
    }
}
