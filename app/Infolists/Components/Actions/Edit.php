<?php

declare(strict_types=1);

namespace App\Infolists\Components\Actions;

use App\Concerns\HasModalExtraFooterActionsAlignment;
use Filament\Infolists\Components\Actions\Action;

class Edit extends Action
{
    use HasModalExtraFooterActionsAlignment;

    public static function getDefaultName(): ?string
    {
        return 'edit';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('general.action.edit'));

        $this->link();
    }
}
