<?php
namespace Insertname\Vipps\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

Class VippsTokens extends Eloquent {
    protected $table = 'vipps_tokens';
    protected $fillable = ['token', 'expires_at'];

}