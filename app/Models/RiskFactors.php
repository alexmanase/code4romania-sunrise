<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\BelongsToBeneficiary;
use App\Enums\Helps;
use App\Enums\Level;
use App\Enums\Ternary;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskFactors extends Model
{
    use HasFactory;
    use BelongsToBeneficiary;

    protected $fillable = [
        'previous_acts_of_violence',
        'previous_acts_of_violence_description',
        'violence_against_children_or_family_members',
        'violence_against_children_or_family_members_description',
        'abuser_exhibited_generalized_violent',
        'abuser_exhibited_generalized_violent_description',
        'protection_order_in_past',
        'protection_order_in_past_description',
        'abuser_violated_protection_order',
        'abuser_violated_protection_order_description',
        'frequency_of_violence_acts',
        'frequency_of_violence_acts_description',
        'use_weapons_in_act_of_violence',
        'use_weapons_in_act_of_violence_description',
        'controlling_and_isolating',
        'controlling_and_isolating_description',
        'stalked_or_harassed',
        'stalked_or_harassed_description',
        'sexual_violence',
        'sexual_violence_description',
        'death_threats',
        'death_threats_description',
        'strangulation_attempt',
        'strangulation_attempt_description',
        'FR_S3Q1',
        'FR_S3Q1_description',
        'FR_S3Q2',
        'FR_S3Q2_description',
        'FR_S3Q3',
        'FR_S3Q3_description',
        'FR_S3Q4',
        'FR_S3Q4_description',
        'FR_S4Q1',
        'FR_S4Q1_description',
        'FR_S4Q2',
        'FR_S4Q2_description',
        'FR_S5Q1',
        'FR_S5Q1_description',
        'FR_S5Q2',
        'FR_S5Q2_description',
        'FR_S5Q3',
        'FR_S5Q3_description',
        'FR_S5Q4',
        'FR_S5Q4_description',
        'FR_S5Q5',
        'FR_S5Q5_description',
        'FR_S6Q1',
        'FR_S6Q1_description',
        'FR_S6Q2',
        'FR_S6Q2_description',
        'risk_level',
    ];

    protected $casts = [
        'previous_acts_of_violence' => Ternary::class,
        'violence_against_children_or_family_members' => Ternary::class,
        'abuser_exhibited_generalized_violent' => Ternary::class,
        'protection_order_in_past' => Ternary::class,
        'abuser_violated_protection_order' => Ternary::class,
        'frequency_of_violence_acts' => Ternary::class,
        'use_weapons_in_act_of_violence' => Ternary::class,
        'controlling_and_isolating' => Ternary::class,
        'stalked_or_harassed' => Ternary::class,
        'sexual_violence' => Ternary::class,
        'death_threats' => Ternary::class,
        'strangulation_attempt' => Ternary::class,
        'FR_S3Q1' => Ternary::class,
        'FR_S3Q2' => Ternary::class,
        'FR_S3Q3' => Ternary::class,
        'FR_S3Q4' => Ternary::class,
        'FR_S4Q1' => Ternary::class,
        'FR_S4Q2' => Ternary::class,
        'FR_S5Q1' => Ternary::class,
        'FR_S5Q2' => Ternary::class,
        'FR_S5Q3' => Ternary::class,
        'FR_S5Q4' => Ternary::class,
        'FR_S5Q5' => Ternary::class,
        'FR_S6Q1' => AsEnumCollection::class . ':' . Helps::class,
        'FR_S6Q2' => AsEnumCollection::class . ':' . Helps::class,
        'risk_level' => Level::class,
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(fn (RiskFactors $model) => self::calculateRiskLevel($model));

        self::updating(fn (RiskFactors $model) => self::calculateRiskLevel($model));
    }

    public static function calculateRiskLevel(self $model): void
    {
        if (self::hasHighRiskLevel($model)) {
            $model->risk_level = Level::HIGH;

            return;
        }

        if (self::hasMediumRiskLevel($model)) {
            $model->risk_level = Level::MEDIUM;

            return;
        }

        if (self::hasLowRiskLevel($model)) {
            $model->risk_level = Level::LOW;
        }
    }

    private static function hasHighRiskLevel(self $model): bool
    {
        if (Ternary::isYes($model->use_weapons_in_act_of_violence)) {
            return true;
        }

        if (Ternary::isYes($model->death_threats)) {
            return true;
        }

        if (Ternary::isYes($model->FR_S4Q1)) {
            return true;
        }

        if (self::getTrueAnswersCount($model) >= 5) {
            return true;
        }

        return false;
    }

    private static function getTrueAnswersCount(self $model): int
    {
        $count = 0;
        foreach ($model->getAttributes() as $value) {
            if (Ternary::isYes($value)) {
                $count++;
            }
        }

        return $count;
    }

    private static function hasMediumRiskLevel(self $model): bool
    {
        if (self::getTrueAnswersCount($model) == 4) {
            return true;
        }

        return false;
    }

    private static function hasLowRiskLevel(self $model): bool
    {
        if (self::getTrueAnswersCount($model) >= 1) {
            return true;
        }

        return false;
    }
}
