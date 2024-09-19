<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ActionsTrait
{

    public function statusBadge(string $status): string
    {
        $color = match ($status) {
            'Active' => 'success',
            'DeActive' => 'info',
            'cancelled' => 'danger',
            'declined' => 'primary',
            'expired' => 'dark',
            'frozen' => 'warning',
        };
        return "<span class='badge bg-{$color} text-capitalize'>{$status}</span>";
    }

    public function dateFormat($date)
    {
        return $date ? $date->format('d M Y') : 'N/A';
    }

}
