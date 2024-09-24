<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone_number',
        'address',
        'service_offered_description',
        'website',
        'password',
        'agreement'
    ];

    public function vendorDocuments(){
        return $this->hasMany(VendorDocument::class);
    }
}
