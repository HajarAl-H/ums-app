<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'collaborator_id',
        'city_id',
        'collaboration_date',
        'status',
    ];

    protected $casts = [
        'collaboration_date' => 'date:Y-m-d',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function collaborator(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'collaborator_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
