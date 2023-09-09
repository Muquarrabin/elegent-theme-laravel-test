<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
                $markup="";
                if (!$customer->has_wp){
                    $markup.= '<a href="#" onclick="createAccount(' . $customer->id . ')" class="btn btn-primary m-1"> Create WordPress Account</a>';
                }
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
            'has_wp' => false,
        ]);
        return Redirect::route('customer.create')->with('status', 'Customer Data Stored Successfully!');
    }

    /**
     * Display the user's details.
     */
    public function show($email): View
    {
        $customer=Customer::whereEmail($email)->firstOrFail();
        return view('customer-details',compact('customer'));
    }
    public function createWpAccount(Request $request) : JsonResponse
    {
        try {
            $customer=Customer::findOrFail($request->id);

            $apiUrl = env('WP_API_URL') . 'elegent-test/user-create';
            $userData = [
                'username' => $customer->email,
                'email' => $customer->email,
                'password' => "12345678",
            ];

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($userData)); // Encode user data as POST fields

            $response = json_decode(curl_exec($ch));
            curl_close($ch);

            if ( !$response || !$response->success) {
                throw new \Exception($response->data->message);
            } else {
                $customer->has_wp = true;
                $customer->save();
                return new JsonResponse([
                    'message' => $response->data->message,
                    'success' => true,
                ], Response::HTTP_OK);
            }
        }catch (\Exception $e){
            return new JsonResponse([
                'message' => 'Something went wrong. ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }
}
