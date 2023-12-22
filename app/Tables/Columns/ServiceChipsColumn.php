<?php

declare(strict_types=1);

namespace App\Tables\Columns;

use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns;
use Illuminate\Support\Collection;

class ServiceChipsColumn extends Column
{
    use Concerns\HasColor;

    protected string $view = 'tables.columns.service-chips-column';

    protected string | Closure | null $size = null;

    public function size(string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(mixed $state): string | null
    {
        return $this->evaluate($this->size, [
            'state' => $state,
        ]);
    }

    public function getServices(): Collection
    {
        return collect($this->getState())
            ->filter(fn ($service) => $service->is_visible)
            ->dump();
    }
}
