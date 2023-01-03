<?php

namespace App\Services\Customers;

use App\Repositories\Customers\CustomerRepository;

class CreateCustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    public function saveCustomerData($data)
    {
        return $this->customerRepository->save($data);
    }
}
