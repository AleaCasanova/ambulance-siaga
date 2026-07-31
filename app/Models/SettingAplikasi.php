<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAplikasi extends Model
{
    use HasFactory;

    protected $table = 'setting_aplikasi';

    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    public static function getVal(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }
        return match ($setting->type) {
            'integer' => (int) $setting->value,
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    public static function setVal(string $key, $value, string $type = 'string', ?string $description = null): self
    {
        $valString = is_array($value) ? json_encode($value) : (string) $value;

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $valString,
                'type' => $type,
                'description' => $description,
            ]
        );
    }
}
