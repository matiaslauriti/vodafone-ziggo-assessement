<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [
        'bsn',
        'city',
        'date_of_birth',
        'external_customer_id',
        'first_name',
        'fraudulent',
        'iban',
        'ip_address',
        'last_invoice_at',
        'last_login_at',
        'last_name',
        'phone_number',
        'postal_code',
        'products',
        'scan_id',
        'street',
        'tag',
    ];

    protected $casts = [
        'last_invoice_at' => 'date',
        'last_login_at' => 'datetime',
        'products' => 'array',
    ];

    public function scan(): BelongsTo
    {
        return $this->belongsTo(Scan::class);
    }
}
