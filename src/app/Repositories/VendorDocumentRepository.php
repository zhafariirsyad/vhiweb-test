<?php
namespace App\Repositories;

use App\Models\VendorDocument;
use App\Interfaces\VendorDocumentInterface;

class VendorDocumentRepository implements VendorDocumentInterface
{
    public function create(array $data)
    {
        return VendorDocument::create($data);
    }
}

?>
