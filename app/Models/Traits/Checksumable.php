<?php

/**
  * Copyright 2018 Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Models\Traits;

use App\Models\Scopes\OrderBySequenceScope;
use Hash;
use Carbon\Carbon;

trait Checksumable
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function($object) {
            if(property_exists($object, 'checksumAttributes')) {
              $object->generateWords();
            }
        });
    }

    protected function generateWords()
    {
        // $this->checksum = $this->makeWords();
        $this->checksum = hash('sha256', $this->makeWords());
    }

    public function checkWords($fields)
    {
        return hash('sha256', $this->makeWords()) ===  $this->checksum;
    }

    protected function makeWords()
    {
        $words = '';
        $counter = 0;
        foreach ($this->checksumAttributes as $field) {
            if($counter > 0) {
              $words .= '-';
            }
            if($field == 'created_at_minute') {
                $words .= Carbon::now()->format('Y-m-d h:i');
            } else {
                $words .= $this->{$field};
            }

            $counter += 1;
        }

        

        return $words;
    }
}

