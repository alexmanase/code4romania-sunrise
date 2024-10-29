<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use App\Concerns\HasUlid;
use App\Enums\OrganizationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Institution extends Model implements HasMedia
{
    use HasFactory;
    use HasUlid;
    use HasSlug;
    use InteractsWithMedia;
    use HasRelationships;

    protected $fillable = [
        'name',
        'short_name',
        'type',
        'cif',
        'main_activity',
        'county_id',
        'city_id',
        'address',
        'reprezentative_name',
        'reprezentative_email',
        'phone',
        'website',
    ];

    protected $casts = [
        'type' => OrganizationType::class,
    ];

    protected function getSlugSource(): string
    {
        return $this->name;
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function admins(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function beneficiaries(): HasManyThrough
    {
        return $this->hasManyThrough(Beneficiary::class, Organization::class);
    }

    public function users(): HasManyDeep
    {
        return $this->hasManyDeep(
            User::class,
            [Organization::class, 'model_has_organizations'],
            ['institution_id', null, 'id'],
            ['id', 'id', 'model_id']
        )->where('model_type', 'user');
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getCountyAndCityAttribute(): string
    {
        return $this->city?->name . ' (' . $this->county?->name . ')';
    }
}
