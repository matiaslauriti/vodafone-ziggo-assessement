<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'external_customer_id',
        'fraudulent',
        'bsn',
        'iban',
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'street',
        'city',
        'postal_code',
        'products',
        'tag',
        'ip_address',
        'last_invoice_at',
        'last_login_at',
        'last_fraudulent_check_at',
    ];

    protected $casts = [
        'fraudulent' => 'boolean',
        'products' => 'array',
        'last_invoice_at' => 'date',
        'last_login_at' => 'datetime',
        'last_fraudulent_check_at' => 'datetime',
    ];
}
