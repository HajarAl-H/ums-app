<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function collaborationsAsCompany(): HasMany
    {
        return $this->hasMany(Collaboration::class, 'company_id');
    }

    public function collaborationsAsCollaborator(): HasMany
    {
        return $this->hasMany(Collaboration::class, 'collaborator_id');
    }
}
