<?php
namespace App\Repositories;

use App\Models\Vendor;
use App\Interfaces\VendorInterface;

class VendorRepository implements VendorInterface
{
    public function all()
    {
        return Vendor::all();
    }

    public function find($id)
    {
        return Vendor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Vendor::create($data);
    }

    public function getAllPendingVendors(){
        return Vendor::where('status','!=','approved')->get();
    }

    public function getVendorDocuments($id){
        return Vendor::findOrFail($id)->vendorDocuments;
    }


    public function updateStatus(Vendor $vendor, string $status)
    {
        $vendor->status = $status;
        $vendor->save();

        return $vendor;
    }
}

?>
