<?php

namespace Mabrouk\PermissionSimple\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',

        'display_name',
        'description',
    ];

    ## Relations

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    ## Getters & Setters

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = $this->prepareDisplayName($value);
    }

    private function prepareDisplayName($value)
    {
        $name = $this->permission->name;
        $segments = collect(\explode('/', $name))->filter(function ($segment) {
            return ! Str::contains($segment, '{');
        })->flatten()->toArray();
        $modifiedSegments = [];
        for ($i = 0; $i < (\count($segments)); $i++) {
            switch (true) {
                case $i < \count($segments) - 1 :
                    $modifiedSegments[] = Str::of($segments[$i])->singular();
                    break;
                default:
                    $modifiedSegments[] = $segments[$i];
            }
        }
        return \ucwords(\str_replace('-', ' ', (\implode(' / ', $modifiedSegments))));
        return $value;
    }
}
