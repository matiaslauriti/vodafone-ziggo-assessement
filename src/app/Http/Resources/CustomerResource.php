<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Customer
 */
class CustomerResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'external_customer_id' => $this->external_customer_id,
            'fraudulent' => $this->fraudulent,
            'error_message' => $this->error_message,
            'bsn' => $this->bsn,
            'iban' => $this->iban,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth->toDateString(),
            'phone_number' => $this->phone_number,
            'street' => $this->street,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'products' => $this->products,
            'tag' => $this->tag,
            'ip_address' => $this->ip_address,
            'last_invoice_at' => $this->last_invoice_at->toDateString(),
            'last_login_at' => $this->last_login_at->toDateTimeString(),
        ];
    }
}
