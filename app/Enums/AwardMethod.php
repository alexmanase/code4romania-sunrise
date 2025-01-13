<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\Enums;
use Filament\Support\Contracts\HasLabel;

enum AwardMethod: string implements HasLabel
{
    use Enums\HasLabel;
    use Enums\Arrayable;
    use Enums\Comparable;

    case POSTAL_MONEY_ORDER_AT_HOME = 'postal_money_order_at_home';
    case BANK_ACCOUNT = 'bank_account';
    case PAYROLL = 'payroll';
    case OTHER = 'other';

    protected function labelKeyPrefix(): ?string
    {
        return 'enum.award_method';
    }
}
