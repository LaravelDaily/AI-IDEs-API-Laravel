<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tool extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'slug',
        'category',
        'website_url',
        'short_description',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(Version::class);
    }

    public function pricingPlans(): HasMany
    {
        return $this->hasMany(PricingPlan::class);
    }
}
