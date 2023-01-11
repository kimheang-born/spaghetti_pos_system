<?php

namespace App\Services\Customers;

use App\Repositories\Customers\CustomerRepository;

class UpdateCustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }
    
    public function updateCustomer($data, $id)
    {
        return $this->customerRepository->update($data, $id);
    }
}
