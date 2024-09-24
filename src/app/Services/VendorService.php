<?php

namespace App\Services;

use App\Repositories\VendorRepository;
use App\Enums\VendorStatus;

class VendorService
{
    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    public function getAllVendors()
    {
        return $this->vendorRepository->all();
    }

    public function getVendorById($id)
    {
        return $this->vendorRepository->find($id);
    }

    public function createVendor(array $data)
    {
        return $this->vendorRepository->create($data);
    }

    public function getPendingVendors(){
        return $this->vendorRepository->getAllPendingVendors();
    }

    public function getVendorDocuments($id){
        return $this->vendorRepository->getVendorDocuments($id);
    }

    public function updateVendorStatus(int $vendorId, string $status): void
    {
        if (!in_array($status, array_column(VendorStatus::cases(), 'value'))) {
            throw new \Exception('Invalid vendor status.');
        }

        $vendor = $this->vendorRepository->find($vendorId);

        if (!$vendor) {
            throw new \Exception('Vendor not found.');
        }

        $this->vendorRepository->updateStatus($vendor, $status);
    }
}


?>
