<?php

declare(strict_types=1);

namespace App\Filament\Organizations\Resources\BeneficiaryInterventionResource\Pages;

use App\Concerns\PreventMultipleSubmit;
use App\Filament\Organizations\Resources\BeneficiaryInterventionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBeneficiaryIntervention extends CreateRecord
{
    use PreventMultipleSubmit;

    protected static string $resource = BeneficiaryInterventionResource::class;
}
