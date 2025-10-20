<?php

namespace App\Http\Resources;

use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Scan
 */
class ScanResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'customers' => CustomerResource::collection($this->whenLoaded('customers')),
            'started_at' => $this->created_at->toDateTimeString(),
            'finished_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
