<?php

namespace App\Enums;

enum VendorStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case UNDER_REVIEW = 'under_review';
    case SUSPENDED = 'suspended';
    case INACTIVE = 'inactive';

    public function badgeClass(): string
    {
        return match($this) {
            self::PENDING => 'badge-warning',
            self::APPROVED => 'badge-success',
            self::REJECTED => 'badge-danger',
            self::UNDER_REVIEW => 'badge-info',
            self::SUSPENDED => 'badge-secondary',
            self::INACTIVE => 'badge-dark',
        };
    }

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::UNDER_REVIEW => 'Under Review',
            self::SUSPENDED => 'Suspended',
            self::INACTIVE => 'Inactive',
        };
    }
}
