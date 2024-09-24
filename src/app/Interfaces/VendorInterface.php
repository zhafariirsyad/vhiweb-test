<?php

namespace App\Interfaces;

use App\Models\Vendor;

interface VendorInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function getAllPendingVendors();
    public function getVendorDocuments($id);
    public function updateStatus(Vendor $vendor, string $status);
}
