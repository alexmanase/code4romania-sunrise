<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ActLocation;
use App\Enums\CaseStatus;
use App\Enums\Citizenship;
use App\Enums\CivilStatus;
use App\Enums\Ethnicity;
use App\Enums\Gender;
use App\Enums\HomeOwnership;
use App\Enums\IDType;
use App\Enums\Income;
use App\Enums\NotificationMode;
use App\Enums\Notifier;
use App\Enums\Occupation;
use App\Enums\PresentationMode;
use App\Enums\ReferralMode;
use App\Enums\ResidenceEnvironment;
use App\Enums\Studies;
use App\Models\Aggressor;
use App\Models\Beneficiary;
use App\Models\BeneficiaryPartner;
use App\Models\BeneficiarySituation;
use App\Models\CaseTeam;
use App\Models\City;
use App\Models\DetailedEvaluationResult;
use App\Models\Document;
use App\Models\EvaluateDetails;
use App\Models\Meeting;
use App\Models\MultidisciplinaryEvaluation;
use App\Models\ReferringInstitution;
use App\Models\RequestedServices;
use App\Models\RiskFactors;
use App\Models\User;
use App\Models\Violence;
use App\Models\ViolenceHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beneficiary>
 */
class BeneficiaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $birthdate = fake()->boolean(75) ?
            fake()->dateTimeBetween('1900-01-01', 'now')
                ->format('Y-m-d') :
            null;

        $gender = fake()->boolean(75) ?
            fake()->randomElement(Gender::values()) :
            null;

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'prior_name' => fake()->boolean(25) ? fake()->lastName() : null,

            'civil_status' => fake()->randomElement(CivilStatus::values()),

            'gender' => $gender,
            'birthplace' => fake()->sentence(),
            'birthdate' => $birthdate,

            'primary_phone' => fake()->phoneNumber(),
            'backup_phone' => fake()->boolean(25) ? fake()->phoneNumber() : null,

            'status' => fake()->randomElement(CaseStatus::values()),
            'doesnt_have_children' => true,

            'presentation_mode' => fake()->randomElement(PresentationMode::values()),
            'referral_mode' => fake()->randomElement(ReferralMode::values()),
            'notifier' => fake()->randomElement(Notifier::values()),
            'notification_mode' => fake()->randomElement(NotificationMode::values()),

            'act_location' => fake()->randomElement(ActLocation::values()),
        ];
    }

    public function withCNP(): static
    {
        return $this->state(fn (array $attributes) => [
            'cnp' => rescue(
                fn () => fake()->cnp(gender: $attributes['gender'], dateOfBirth: $attributes['birthdate']),
                fn () => fake()->cnp(dateOfBirth: $attributes['birthdate']),
                false
            ),
        ]);
    }

    public function withID(): static
    {
        return $this->state(fn (array $attributes) => [
            'id_type' => fake()->randomElement(IDType::values()),
            'id_serial' => fake()->lexify('??'),
            'id_number' => fake()->numerify('######'),
        ]);
    }

    public function withLegalResidence(): static
    {
        return $this->state(function (array $attributes) {
            $city = City::query()->inRandomOrder()->first();

            return [
                'legal_residence_address' => fake()->address(),
                'legal_residence_county_id' => $city->county_id,
                'legal_residence_city_id' => $city->id,
                'legal_residence_environment' => fake()->boolean() ?
                    fake()->randomElement(ResidenceEnvironment::values()) :
                    null,
                'same_as_legal_residence' => true,
            ];
        });
    }

    public function withEffectiveResidence(): static
    {
        return $this->state(function (array $attributes) {
            $city = City::query()->inRandomOrder()->first();

            return [
                'effective_residence_address' => fake()->address(),
                'effective_residence_county_id' => $city->county_id,
                'effective_residence_city_id' => $city->id,
                'effective_residence_environment' => fake()->boolean() ?
                    fake()->randomElement(ResidenceEnvironment::values()) : null,
                'same_as_legal_residence' => false,
            ];
        });
    }

    public function withContactNotes(): static
    {
        return $this->state(fn (array $attributes) => [
            'contact_notes' => fake()->paragraphs(asText: true),
        ]);
    }

    public function withChildren(): static
    {
        return $this->state(fn (array $attributes) => [
            'doesnt_have_children' => false,
            'children_total_count' => fake()->numberBetween(1, 10),
            'children_care_count' => fake()->numberBetween(1, 10),
            'children_under_10_care_count' => fake()->numberBetween(1, 10),
            'children_10_18_care_count' => fake()->numberBetween(1, 10),
            'children_18_care_count' => fake()->numberBetween(1, 10),
            'children_accompanying_count' => fake()->numberBetween(1, 10),

            'children' => collect(range(1, 10))
                ->map(fn () => [
                    'name' => fake()->name(),
                    'age' => fake()->boolean() ? fake()->numberBetween(0, 20) : null,
                    'current_address' => fake()->boolean() ? fake()->address() : null,
                    'status' => fake()->boolean() ? fake()->words(asText: true) : null,
                ])
                ->toJson(),
        ]);
    }

    public function withAntecedents(): static
    {
        return $this->state(fn (array $attributes) => [
            'has_police_reports' => fake()->boolean(),
            'police_report_count' => fake()->numberBetween(0, 300),
            'has_medical_reports' => fake()->boolean(),
            'medical_report_count' => fake()->numberBetween(0, 300),
        ]);
    }

    public function withOccupation(): static
    {
        return $this->state(fn (array $attributes) => [
            'occupation' => fake()->boolean(75) ?
                fake()->randomElement(Occupation::values()) :
                null,
        ]);
    }

    public function withIncome(): static
    {
        return $this->state(fn (array $attributes) => [
            'income' => fake()->boolean(75) ?
                fake()->randomElement(Income::values()) :
                null,
        ]);
    }

    public function withStudies(): static
    {
        return $this->state(fn (array $attributes) => [
            'studies' => fake()->boolean(75) ?
                fake()->randomElement(Studies::values()) :
                null,
        ]);
    }

    public function withCitizenship(): static
    {
        return $this->state(fn (array $attributes) => [
            'citizenship' => fake()->boolean(75) ?
                fake()->randomElement(Citizenship::values()) :
                null,
        ]);
    }

    public function withEthnicity(): static
    {
        return $this->state(fn (array $attributes) => [
            'ethnicity' => fake()->boolean(75) ?
                fake()->randomElement(Ethnicity::values()) :
                null,
        ]);
    }

    public function withHomeOwnership(): static
    {
        return $this->state(fn (array $attributes) => [
            'homeownership' => fake()->boolean(75) ?
                fake()->randomElement(HomeOwnership::values()) :
                null,
        ]);
    }

    public function configure(): static
    {
        $referringInstitutions = ReferringInstitution::all();

        return $this
            ->afterMaking(function (Beneficiary $beneficiary) use ($referringInstitutions) {
                if (PresentationMode::isValue($beneficiary->presentation_method, PresentationMode::FORWARDED)) {
                    $beneficiary->referringInstitution()->attach(
                        $referringInstitutions->random()
                    );
                }

                $beneficiary->firstCalledInstitution()->associate(
                    $referringInstitutions->random()
                );
            })
            ->afterCreating(function (Beneficiary $beneficiary) use ($referringInstitutions) {
                BeneficiaryPartner::factory()
                    ->for($beneficiary)
                    ->create();

                BeneficiarySituation::factory()
                    ->for($beneficiary)
                    ->create();

                $count = rand(1, 5);
                $users = User::query()
                    ->whereHas(
                        'organizations',
                        fn (Builder $query) => $query->where('organizations.id', $beneficiary->organization->id)
                    )
                    ->inRandomOrder()
                    ->limit($count)
                    ->get()
                    ->map(fn ($item) => ['user_id' => $item->id])
                    ->toArray();

                CaseTeam::factory()
                    ->for($beneficiary)
                    ->state(new Sequence(...$users))
                    ->count($count)
                    ->create();

                DetailedEvaluationResult::factory()
                    ->for($beneficiary)
                    ->create();

                EvaluateDetails::factory()
                    ->for($beneficiary)
                    ->state(['specialist_id' => User::query()
                        ->whereHas(
                            'organizations',
                            fn (Builder $query) => $query->where('organizations.id', $beneficiary->organization->id)
                        )
                        ->inRandomOrder()
                        ->first()
                        ->id,
                    ])
                    ->create();

                Meeting::factory()
                    ->for($beneficiary)
                    ->count(rand(1, 5))
                    ->create();

                MultidisciplinaryEvaluation::factory()
                    ->for($beneficiary)
                    ->create();

                RiskFactors::factory()
                    ->for($beneficiary)
                    ->create();

                Violence::factory()
                    ->for($beneficiary)
                    ->create();

                ViolenceHistory::factory()
                    ->for($beneficiary)
                    ->count(rand(1, 5))
                    ->create();

                RequestedServices::factory()
                    ->for($beneficiary)
                    ->create();

                Document::factory()
                    ->for($beneficiary)
                    ->count(rand(1, 5))
                    ->create();

                Aggressor::factory()
                    ->for($beneficiary)
                    ->create();

                $beneficiary->otherCalledInstitution()->sync(
                    $referringInstitutions->random(fake()->numberBetween(1, 4)),
                );
            });
    }
}
