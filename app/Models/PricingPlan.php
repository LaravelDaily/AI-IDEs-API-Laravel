<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPlan extends Model
{
    protected $fillable = [
        'tool_id',
        'name',
        'billing_period',
        'features',
        'currency',
        'price',
        'last_updated_date',
        'is_deprecated',
    ];

    protected function casts(): array
    {
        return [
            'is_deprecated' => 'boolean',
            'last_updated_date' => 'date',
        ];
    }

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
