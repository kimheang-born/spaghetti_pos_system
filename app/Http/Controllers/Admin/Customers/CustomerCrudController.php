<?php

namespace App\Http\Controllers\Admin\Customers;

use Throwable;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Customers\GetCustomerService;
use App\Services\Customers\CreateCustomerService;
use App\Services\Customers\UpdateCustomerService;
use App\Http\Requests\Customers\CreateCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Http\Resources\API\Customers\CustomerResource;

class CustomerCrudController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $customer;
    protected $getCustomerService;
    protected $createCustomerService;
    protected $updateCustomerService;

    public function __construct(
        Customer $customer,
        GetCustomerService $getCustomerService,
        CreateCustomerService $createCustomerService,
        UpdateCustomerService $updateCustomerService
    )
    {
        $this->customer = $customer;
        $this->getCustomerService = $getCustomerService;
        $this->createCustomerService = $createCustomerService;
        $this->updateCustomerService = $updateCustomerService;
    }

    const MSG_SOMETHING_WENT_WRONG = "Sorry, something went wrong";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.customers.customer');
    }

    public function getData()
    {
        try {
            
            $data = $this->getCustomerService->getAll();
            return CustomerResource::collection($data);

        } catch (Throwable $th) {
            Log::error(self::class. '::getData() : ' . $th);
            return response()->json([
                "message" => self::MSG_SOMETHING_WENT_WRONG,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {

        $data   = $request->only($this->customer->allowOnly());

        DB::beginTransaction();
        
        try {

            $result = $this->createCustomerService->saveCustomerData($data);

            DB::commit();

            return response()->json([
                "success" => true,
                "message" => "Customer: $result->name has been successfully created."
            ], 200);
            
        } catch (Throwable $th) {
            Log::error(self::class. '::store() : ' . $th);
            DB::rollBack();

            return response()->json([
                "success" => false,
                "message" => self::MSG_SOMETHING_WENT_WRONG,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $data   = $request->only($this->customer->allowOnly());

        DB::beginTransaction();

        try {

            $result = $this->updateCustomerService->updateCustomer($data, $id);

            DB::commit();

            return response()->json([
                "success" => true,
                "message" => "Customer: $result->name has been successfully created."
            ], 200);

        } catch (Throwable $th) {
            Log::error(self::class. '::update() : ' . $th);
            DB::rollBack();

            return response()->json([
                "success" => false,
                "message" => self::MSG_SOMETHING_WENT_WRONG,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
