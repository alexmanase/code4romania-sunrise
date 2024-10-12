<?php

declare(strict_types=1);

namespace App\Filament\Organizations\Resources\BeneficiaryResource\Pages;

use App\Concerns\RedirectToDetailedEvaluation;
use App\Enums\RecommendationService;
use App\Filament\Organizations\Resources\BeneficiaryResource;
use App\Infolists\Components\EnumEntry;
use App\Services\Breadcrumb\BeneficiaryBreadcrumb;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class EditDetailedEvaluationResult extends EditRecord
{
    use RedirectToDetailedEvaluation;

    protected static string $resource = BeneficiaryResource::class;

    public function getTitle(): string|Htmlable
    {
        return __('beneficiary.page.edit_detailed_evaluation_result.title');
    }

    public function getBreadcrumbs(): array
    {
        return BeneficiaryBreadcrumb::make($this->getRecord())
            ->getBreadcrumbsForDetailedEvaluation();
    }

    protected function getTabSlug(): string
    {
        return Str::slug(__('beneficiary.wizard.results.label'));
    }

    public function form(Form $form): Form
    {
        return $form->schema(self::getSchema());
    }

    public static function getSchema(): array
    {
        return [
            Group::make()
                ->relationship('detailedEvaluationResult')
                ->schema([
                    Section::make(__('beneficiary.section.detailed_evaluation.heading.recommendation_services'))
                        ->schema(self::getRecommendationServicesSchema()),
                    self::getInterventionPlanSchema(),

                ]),
        ];
    }

    public static function getRecommendationServicesSchema(): array
    {
        return [
            CheckboxList::make('recommendation_services')
                ->hiddenLabel()
                ->options(RecommendationService::options()),

            Textarea::make('other_services_description')
                ->hiddenLabel()
                ->placeholder(__('beneficiary.placeholder.other_services'))
                ->maxLength(100),
        ];
    }

    public static function getInterventionPlanSchema(): Section
    {
        return Section::make(__('beneficiary.section.detailed_evaluation.labels.recommendations_for_intervention_plan'))
            ->schema([
                RichEditor::make('recommendations_for_intervention_plan')
                    ->helperText(__('beneficiary.helper_text.recommendations_for_intervention_plan'))
                    ->label(__('beneficiary.section.detailed_evaluation.labels.recommendations_for_intervention_plan'))
                    ->placeholder(__('beneficiary.placeholder.recommendations_for_intervention_plan'))
                    ->maxLength(5000),
            ]);
    }

    public static function getRecommendationServicesInfolistSchema(): array
    {
        $fields = [];
        foreach (RecommendationService::options() as $key => $value) {
            $fields[] = EnumEntry::make($key)
                ->label($value);
        }

        $fields[] = TextEntry::make('other_services_description')
            ->hiddenLabel()
            ->placeholder(__('beneficiary.placeholder.other_services'));

        return $fields;
    }
}
