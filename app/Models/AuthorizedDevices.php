<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedDevices extends Model
{
    use HasFactory;
    protected $table = "authorized_devices";

    protected $fillable = ['otp_token_id', 'device_hash', 'ip', 'city', 'latitude', 'longitude'];

    /**
     * Get the authorizedotp that owns the AuthorizedDevices
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorizedotp()
    {
        return $this->belongsTo(AuthorizedOtp::class, 'otp_token_id');
    }
}
