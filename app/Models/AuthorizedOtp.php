<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedOtp extends Model
{
    use HasFactory;
    protected $table = "authorized_otp";

    protected $fillable = ['otp', 'admin_id', 'expires_at'];

    /**
     * Get all of the authorizeddevice for the AuthorizedOtp
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authorizeddevice()
    {
        return $this->hasMany(AuthorizedDevices::class, 'otp_token_id');
    }
}
