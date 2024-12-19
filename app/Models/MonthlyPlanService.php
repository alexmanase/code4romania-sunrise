<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyPlanService extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_plan_id',
        'service_id',
        'institution',
        'responsible_person',
        'start_date',
        'end_date',
        'objective',
        'service_details',
    ];

    public function monthlyPlan(): BelongsTo
    {
        return $this->belongsTo(MonthlyPlan::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function monthlyPlanInterventions(): HasMany
    {
        return $this->hasMany(MonthlyPlanInterventions::class);
    }
}
