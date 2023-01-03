<?php

namespace App\Services\Customers;

use App\Repositories\Customers\CustomerRepository;

class GetCustomerService
{
    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }
    
    public function getAll()
    {
        return $this->customerRepository->getAllCustomers();
    }
}
