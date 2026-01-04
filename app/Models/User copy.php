<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'name',
        'lastname',
        'email',
        'password',
        'picture',
        'dui',
        'nit',
        'nup',
        'isss',
        'phone',
        'address',
        'state',
        'branch_offices_id',
        'cod_caja'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get all of the fse for the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fse()
    {
        return $this->hasMany(Fse::class, 'vendedor_id');
    }

    /**
     * Get all of the sucursal for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'branch_offices_id');
    }

    public function notificaciones()
    {
        return $this->belongsToMany(Notificaciones::class)->withPivot('estado')->withTimestamps();
    }
}
