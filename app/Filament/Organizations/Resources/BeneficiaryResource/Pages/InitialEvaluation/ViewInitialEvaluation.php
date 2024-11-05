<?php

declare(strict_types=1);

namespace App\Filament\Organizations\Resources\BeneficiaryResource\Pages\InitialEvaluation;

use App\Enums\RecommendationService;
use App\Enums\Ternary;
use App\Filament\Organizations\Resources\BeneficiaryResource;
use App\Filament\Organizations\Resources\BeneficiaryResource\Pages\ViewBeneficiaryIdentity;
use App\Infolists\Components\Actions\Edit;
use App\Infolists\Components\Notice;
use App\Infolists\Components\SectionHeader;
use App\Services\Breadcrumb\BeneficiaryBreadcrumb;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewInitialEvaluation extends ViewRecord
{
    protected static string $resource = BeneficiaryResource::class;

    public function getTitle(): string|Htmlable
    {
        return __('beneficiary.page.initial_evaluation.title');
    }

    public function getBreadcrumbs(): array
    {
        return BeneficiaryBreadcrumb::make($this->getRecord())
            ->getBreadcrumbs('view_initial_evaluation');
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Tabs::make()
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->schema([
                    Tabs\Tab::make(__('beneficiary.wizard.details.label'))
                        ->maxWidth('3xl')
                        ->schema([
                            Section::make(__('beneficiary.wizard.details.label'))
                                ->headerActions([
                                    Edit::make('edit')
                                        ->url(fn ($record) => BeneficiaryResource::getUrl(
                                            'edit_initial_evaluation_details',
                                            ['record' => $record]
                                        )),
                                ])
                                ->schema(EditEvaluationDetails::getInfoListSchema())]),

                    Tabs\Tab::make(__('beneficiary.section.identity.tab.beneficiary'))
                        ->maxWidth('3xl')
                        ->schema(ViewBeneficiaryIdentity::identitySchemaForOtherPage($this->record)),

                    Tabs\Tab::make(__('beneficiary.section.identity.tab.children'))
                        ->maxWidth('3xl')
                        ->schema(ViewBeneficiaryIdentity::childrenSchemaForOtherPage($this->record)),

                    Tabs\Tab::make(__('beneficiary.wizard.violence.label'))
                        ->maxWidth('3xl')
                        ->schema([
                            Section::make(__('beneficiary.wizard.violence.label'))
                                ->headerActions([
                                    Edit::make('edit')
                                        ->url(fn ($record) => BeneficiaryResource::getUrl(
                                            'edit_initial_evaluation_violence',
                                            ['record' => $record]
                                        )),
                                ])
                                ->schema(EditViolence::getInfoListSchema())]),
                    Tabs\Tab::make(__('beneficiary.wizard.risk_factors.label'))
                        ->maxWidth('3xl')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Notice::make('riskFactors.risk_level'),

                                    SectionHeader::make('riskFactors')
                                        ->state(__('beneficiary.wizard.risk_factors.label'))
                                        ->action(
                                            Action::make('view')
                                                ->label(__('general.action.edit'))
                                                ->url(BeneficiaryResource::getUrl(
                                                    'edit_initial_evaluation_risk_factors',
                                                    ['record' => $this->getRecord()]
                                                ))
                                                ->link(),
                                        ),

                                    ...EditRiskFactors::getInfoListSchema(),
                                ]),
                        ]),
                    Tabs\Tab::make(__('beneficiary.wizard.requested_services.label'))
                        ->maxWidth('3xl')
                        ->schema([
                            Section::make(__('beneficiary.wizard.requested_services.label'))
                                ->headerActions([
                                    Edit::make('edit')
                                        ->url(fn ($record) => BeneficiaryResource::getUrl(
                                            'edit_initial_evaluation_requested_services',
                                            ['record' => $record]
                                        )),
                                ])
                                ->schema($this->getRequestedServicesInfoListSchema())]),
                    Tabs\Tab::make(__('beneficiary.wizard.beneficiary_situation.label'))
                        ->maxWidth('3xl')
                        ->schema([
                            Section::make(__('beneficiary.wizard.beneficiary_situation.label'))
                                ->headerActions([
                                    Edit::make('edit')
                                        ->url(fn ($record) => BeneficiaryResource::getUrl(
                                            'edit_initial_evaluation_beneficiary_situation',
                                            ['record' => $record]
                                        )),
                                ])
                                ->schema(EditBeneficiarySituation::getInfoListSchema())]),
                ]),
        ]);
    }

    public function getRequestedServicesInfoListSchema(): array
    {
        $fields = [];
        $record = $this->getRecord();
        foreach (RecommendationService::options() as $key => $value) {
            $fields[] = TextEntry::make($key)
                ->label($value)
                ->state(
                    $record->requestedServices
                        ->requested_services
                        ->contains(RecommendationService::tryFrom($key)) ?
                        Ternary::YES->getLabel() :
                        Ternary::NO->getLabel()
                );
        }

        return [
            Section::make(__('beneficiary.section.initial_evaluation.heading.types_of_requested_services'))
                ->relationship('requestedServices')
                ->schema([
                    ...$fields,
                    TextEntry::make('other_services_description')
                        ->hiddenLabel()
                        ->placeholder(__('beneficiary.placeholder.other_services')),
                ]),

        ];
    }
}