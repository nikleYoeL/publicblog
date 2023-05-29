<?php

namespace App\Traits;

use Carbon\Carbon;

trait CarbonParse
{
    public function parseInCarbon(string $value): Carbon
    {
        return Carbon::parse($this->$value);
    }
}