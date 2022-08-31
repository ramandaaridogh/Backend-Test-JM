<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
        'nik', 'name', 'unit_id', 'position_name', 'date_of_birth', 'place_of_birth'
    ];
    protected $casts = [
        'date_of_birth' => 'date'
    ];


    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
