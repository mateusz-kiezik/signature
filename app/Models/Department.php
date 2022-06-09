<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'short',
        'name',
        'legal_form',
        'street',
        'postal_code',
        'city',
        'country',
        'logo',
        'vat_id',
        'regon',
        'krs',
        'aeo',
        'fmc',
        'phone'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
