<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Logable;
use App\Models\Traits\Checksumable;
use H;

class BaseModel extends Model
{
    use Logable, Checksumable;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', H::today());
    }

    public function scopeOrderBySequence($query)
    {
        return $query->orderBy('sequence');
    }

    public function scopeOrderByLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getActiveLabelAttribute()
    {
        return $this->active ? 'Ya' : 'Tidak';
    }

    public function getFullnameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    protected $visible = ['id'];
}
