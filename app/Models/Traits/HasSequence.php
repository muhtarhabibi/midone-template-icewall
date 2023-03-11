<?php

/**
  * Copyright 2018 Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models\Traits;

use App\Models\Scopes\OrderBySequenceScope;

trait HasSequence
{
  protected static function boot()
  {
      parent::boot();
      static::addGlobalScope(new OrderBySequenceScope);
  }
}

