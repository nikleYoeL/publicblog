<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Avatar
{
    private $default_image = 'images/default.png';

    public function getDefaultImage(): string
    {
        return $this->default_image;
    }

    public function removeCurrentFromStorage(): void
    {
        if ($this->avatar !== $this->getDefaultImage()) {
            Storage::delete($this->avatar);
        }
    }
}