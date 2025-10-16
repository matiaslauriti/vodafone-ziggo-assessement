<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Customer> $customers
 * @property-read int|null $customers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Scan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Scan extends Model
{
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
