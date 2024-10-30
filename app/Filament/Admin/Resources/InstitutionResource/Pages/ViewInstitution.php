<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\InstitutionResource\Pages;

use App\Filament\Admin\Resources\InstitutionResource;
use App\Filament\Admin\Resources\InstitutionResource\Actions\ActivateInstitution;
use App\Filament\Admin\Resources\InstitutionResource\Actions\InactivateInstitution;
use App\Infolists\Components\Location;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewInstitution extends ViewRecord
{
    protected static string $resource = InstitutionResource::class;

    public function getBreadcrumbs(): array
    {
        return [
            InstitutionResource::getUrl() => __('institution.headings.list_title'),
            InstitutionResource::getUrl('view', ['record' => $this->getRecord()]) => $this->getRecord()->name,
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return $this->getRecord()->name;
    }

    protected function getActions(): array
    {
        return [
            ActivateInstitution::make(),

            InactivateInstitution::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make(__('institution.headings.institution_details'))
                ->headerActions([
                    Action::make('edit')
                        ->label(__('general.action.edit'))
                        ->icon('heroicon-o-pencil')
                        ->link()
                        ->url(self::$resource::getUrl('edit_institution_details', ['record' => $this->getRecord()])),
                ])
                ->maxWidth('3xl')
                ->columns()
                ->schema([
                    TextEntry::make('name')
                        ->label(__('organization.field.name')),

                    TextEntry::make('short_name')
                        ->label(__('organization.field.short_name')),

                    TextEntry::make('type')
                        ->label(__('organization.field.type')),

                    TextEntry::make('cif')
                        ->label(__('organization.field.cif')),

                    TextEntry::make('main_activity')
                        ->label(__('organization.field.main_activity')),

                    Location::make()
                        ->city(),

                    TextEntry::make('address')
                        ->label(__('organization.field.address')),

                    TextEntry::make('phone')
                        ->label(__('organization.field.phone')),

                    TextEntry::make('reprezentative_name')
                        ->label(__('organization.field.reprezentative_name')),

                    TextEntry::make('reprezentative_email')
                        ->label(__('organization.field.reprezentative_email')),

                    TextEntry::make('website')
                        ->label(__('organization.field.website')),

                    TextEntry::make('organization_status')
                        ->label(__('institution.labels.organization_status'))
                        ->columnSpanFull(),

                    TextEntry::make('social_service_provider_certificate')
                        ->label(__('institution.labels.social_service_provider_certificate'))
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return __('institution.headings.institution_details');
    }

    public function getRelationManagers(): array
    {
        return [
            'organizations' => InstitutionResource\RelationManagers\OrganizationsRelationManager::make(),
            'admins' => InstitutionResource\RelationManagers\AdminsRelationManager::make(),
        ];
    }
}
