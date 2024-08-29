<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

trait LogsChangesTrait
{
    public static function bootLogsChangesTrait()
    {
        static::created(function ($model) {
            $model->logChange('created');
        });

        static::updated(function ($model) {
            $model->logChange('updated');
        });

        static::deleted(function ($model) {
            $model->logChange('deleted');
        });
    }

    protected function logChange($action)
    {
        Log::info('Logging change', ['event' => $action, 'model_id' => $this->id]);
//        if ($action === 'created') {
//            $new_values = $this->attributesToArray();
//        }
//        else {
//            $new_values = $this->getChanges();
//        }
//        if ($action === 'deleted'){
//            $original = $this->attributesToArray();
//        }else{
//            $original = $this->wasChanged() ? $this->getOriginal() : [];
//        }
        if ($action === 'created') {
            $new_values = $this->attributesToArray();
            $original = [];
        } elseif ($action === 'deleted') {
            $new_values = [];
            $original = $this->attributesToArray();
        } else {
            $new_values = $this->getChanges();
//            $original = $this->wasChanged() ? $this->getDirty() : [];
            $original = [];
            foreach ($new_values as $field => $value) {
                $original[$field] = $this->getOriginal($field);
            }

        }
        \App\Models\SystemLog::create([
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'action' => $action,
            'old_value' => json_encode($original),
            'new_value' => json_encode($new_values),
            'user_id' => auth()->user()->id ?? 'N/A',
            'ip_address' => Request::ip(),
            'guard_name' => Auth::getDefaultDriver(),
            'module_name' => class_basename($this),
        ]);
    }
}
