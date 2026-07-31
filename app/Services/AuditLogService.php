<?php

namespace App\Services;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    public static function log(string $activity, string $module, ?string $description = null, ?int $userId = null): void
    {
        LogAktivitas::create([
            'user_id' => $userId ?? auth()->id(),
            'activity' => $activity,
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
