<?php

/**
  * Copyright 2018 Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models\Traits;

/**
 * Allows saving models without triggering observers
 */
trait SaveQuietly
{
	/**
	 * Save model without triggering observers on model
	 */
	public function saveQuietly(array $options = [])
	{
	    return static::withoutEvents(function () use ($options) {
	        return $this->save($options);
	    });
	}
}
