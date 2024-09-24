<?php

namespace App\Services;

use App\Repositories\VendorDocumentRepository;

class VendorDocumentService
{
    protected $vendorDocumentRepository;

    public function __construct(VendorDocumentRepository $vendorDocumentRepository)
    {
        $this->vendorDocumentRepository = $vendorDocumentRepository;
    }

    public function storeDocuments($vendor_id, $documents)
    {
        foreach ($documents as $document) {
            $document_name = rand().'.'.$document->getClientOriginalExtension();

            $document->move(public_path('vendor_documents'),$document_name);
            $this->vendorDocumentRepository->create([
                'vendor_id' => $vendor_id,
                'document_name' => $document_name,
            ]);
        }
    }
}

?>
