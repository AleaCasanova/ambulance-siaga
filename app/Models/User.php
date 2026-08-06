<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relasi
    public function otpVerification()
    {
        return $this->hasOne(OtpVerification::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function masyarakat()
    {
        return $this->hasOne(Masyarakat::class);
    }

    public function supir()
    {
        return $this->hasOne(Supir::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'user_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }

    // RBAC Helper methods
    public function hasRole(string|array $roles): bool
    {
        if (!$this->role) {
            return false;
        }

        if (is_array($roles)) {
            return in_array($this->role->name, $roles);
        }

        return $this->role->name === $roles;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('superadmin');
    }

    public function isAdminOperasional(): bool
    {
        return $this->hasRole(['superadmin', 'admin_operasional']);
    }

    public function isDispatcher(): bool
    {
        return $this->hasRole('dispatcher');
    }

    public function isSupir(): bool
    {
        return $this->hasRole('supir');
    }

    public function isMasyarakat(): bool
    {
        return $this->hasRole('masyarakat');
    }

    public function getRoleNameAttribute(): string
    {
        return $this->role?->name ?? 'unknown';
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role?->label ?? 'User';
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && file_exists(public_path('storage/' . $this->avatar))) {
            return asset('storage/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=0284C7&background=E0F2FE&bold=true';
    }
}
