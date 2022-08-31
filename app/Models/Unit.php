<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
        'name', 'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
