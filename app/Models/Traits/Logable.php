<?php

/**
  * Copyright 2018 Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models\Traits;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait Logable
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
}

