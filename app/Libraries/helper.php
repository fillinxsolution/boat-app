<?php


use App\Models\Setting;



/**
 * Get listing of a resource.
 *
 * @return string
 */
function adminSettings($name)
{
    return Setting::get($name);
}
