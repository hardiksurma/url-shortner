<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'company_id',
        'invited_by',
        'name',
        'email',
        'role_id',
        'token',
        'expires_at',
        'accepted_at',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
