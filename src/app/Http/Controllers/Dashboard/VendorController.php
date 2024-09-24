<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Enums\VendorStatus;

class VendorController extends Controller
{

    protected $vendorService;

    public function __construct(VendorService $vendorService){
        $this->vendorService = $vendorService;
    }

    public function vendorStatus(){
        $vendorStatus = [
            'pending' => VendorStatus::PENDING,
            'approved' => VendorStatus::APPROVED,
            'rejected' => VendorStatus::REJECTED,
            'under_review' => VendorStatus::UNDER_REVIEW,
            'suspended' => VendorStatus::SUSPENDED,
            'inactive' => VendorStatus::INACTIVE,
        ];

        return $vendorStatus;
    }

    public function index()
    {
        $vendors = $this->vendorService->getAllVendors();

        $vendorStatus = $this->vendorStatus();

        return view('dashboard.vendor-approval.index',[
            'vendors' => $vendors,
            'vendorStatus' => $vendorStatus
        ]);
    }

    public function show($id)
    {
        $vendor = $this->vendorService->getVendorById($id);

        $vendorStatus = $this->vendorStatus();

        $vendorDocuments = $this->vendorService->getVendorDocuments($vendor->id);

        return view('dashboard.vendor-approval.show',[
            'vendor' => $vendor,
            'vendorStatus' => $vendorStatus,
            'vendorDocuments' => $vendorDocuments
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'comments' => 'nullable|string',
        ]);

        try {
            // Update vendor status using the service
            $this->vendorService->updateVendorStatus($id, $validated['status']);

            return redirect()->back()->with('success', 'Vendor status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
