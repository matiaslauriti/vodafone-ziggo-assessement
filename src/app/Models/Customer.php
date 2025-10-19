<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $scan_id
 * @property int $external_customer_id
 * @property bool $fraudulent
 * @property string|null $error_message
 * @property int $bsn
 * @property string $iban
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $date_of_birth
 * @property string $phone_number
 * @property string $street
 * @property string $city
 * @property string $postal_code
 * @property array<array-key, mixed> $products
 * @property string $tag
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $last_invoice_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Scan $scan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereBsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereExternalCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereFraudulent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereLastInvoiceAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereScanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $fillable = [
        'bsn',
        'city',
        'date_of_birth',
        'error_message',
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
        'fraudulent' => 'boolean',
        'date_of_birth' => 'date',
        'last_invoice_at' => 'date',
        'last_login_at' => 'datetime',
        'products' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Customer $customer) {
            if ($customer->isDirty('error_message') || $customer->isDirty('fraudulent')) {
                $customer->fraudulent = !empty($customer->error_message);
            }
        });
    }

    public function scan(): BelongsTo
    {
        return $this->belongsTo(Scan::class);
    }
}
