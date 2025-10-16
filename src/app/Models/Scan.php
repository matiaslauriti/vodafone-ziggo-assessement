<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scan extends Model
{
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
