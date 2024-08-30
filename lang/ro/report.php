<?php

declare(strict_types=1);

return [
    'title' => 'Rapoarte statistice',

    'labels' => [
        'report_type' => 'Distribuția victimelor violenței domestice (cazurilor) după...',
        'start_date' => 'Dată început raportare',
        'end_date' => 'Dată final raportare',
        'show_missing_values' => 'Afișează și datele lipsă (missing values) în tabel',
        'total' => 'Total cazuri',
    ],

    'table_heading' => [
        'cases_by_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după grupa de vârstă a victimei',
        'cases_by_age_segmentation' => 'Distribuţia victimelor violenţei domestice (cazurilor) după vârsta victimei (statut de minor/major)',
        'cases_by_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după genul victimei',
        'cases_by_citizenship' => 'Distribuţia victimelor violenţei domestice (cazurilor) după cetăţenie ',
        'cases_by_ethnicity' => 'Distribuţia victimelor violenţei domestice (cazurilor) după etnie',
        'cases_by_civil_status' => 'Distribuţia victimelor violenţei domestice (cazurilor) după starea civilă a victimei',
        'cases_by_civil_status_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după starea civilă și genul victimei',
        'cases_by_civil_status_and_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după starea civilă și grupa de vârstă a victimei',
        'cases_by_studies' => 'Distribuţia victimelor violenţei domestice (cazurilor) după nivelul de studii',
        'cases_by_studies_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după nivelul de studii și genul victimei',
        'cases_by_studies_and_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după nivelul de studii și domiciliul efectiv al victimei',
        'cases_by_studies_and_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după nivelul de studii și vârsta victimei (minor/major)',
        'cases_by_legal_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după domiciliul legal al victimei',
        'cases_by_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după domiciliul efectiv',
        'cases_by_occupation' => 'Distribuţia victimelor violenţei domestice (cazurilor) după ocupația victimei',
        'cases_by_occupation_and_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după ocupație și domiciliul efectiv',
        'cases_by_occupation_and_effective_address_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după ocupație, domiciliul efectiv și genul victimei',
        'cases_by_age_gender_and_legal_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) pe grupa de vârsta, genul și domiciliul legal al victimei',
        'cases_by_age_gender_and_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) pe grupa de vârsta, genul și domiciliul efectiv al victimei',
        'cases_by_home_ownership' => 'Distribuţia victimelor violenţei domestice (cazurilor) după dreptul de proprietate asupra locuinței primare',
        'cases_by_home_ownership_and_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după dreptul de proprietate asupra locuinței primare și domiciliul efectiv',
        'cases_by_home_ownership_effective_address_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după dreptul de proprietate asupra locuinței primare, domiciliul efectiv și genul victimei',
        'cases_by_income' => 'Distribuţia victimelor violenţei domestice (cazurilor) după încadrarea în venit a victimei',
        'cases_by_income_and_effective_address' => 'Distribuţia victimelor violenţei domestice (cazurilor) după încadrarea în venit și domiciliul efectiv al victimei',
        'cases_by_income_effective_address_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după încadrarea în venit, domiciliul efectiv și genul victimei',
        'cases_by_aggressor_relationship' => 'Distribuţia victimelor violenţei domestice (cazurilor) după relația cu agresorul',
        'cases_by_aggressor_relationship_and_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după relația cu agresorul și grupa de vârstă a victimei',
        'cases_by_aggressor_relationship_and_age_and_gender' => 'Distribuţia victimelor violenţei domestice (cazurilor) după relația cu agresorul, genul victimei și grupa de vârstă a victimei',
        'cases_by_primary_violence_type' => 'Distribuţia victimelor violenţei domestice (cazurilor) după tipul de violență primară',
        'cases_by_violence_types' => 'Distribuţia victimelor violenţei domestice (cazurilor) după tipul de violență (selecție multiplă a tipurilor de violență)',
        'cases_by_violence_frequency' => 'Distribuţia victimelor violenţei domestice (cazurilor) după frecvența agresiunii',
        'cases_by_primary_violence_type_and_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după tipul de violență primară și vârsta victimei (minor/major)',
        'cases_by_primary_violence_frequency_and_age' => 'Distribuţia victimelor violenţei domestice (cazurilor) după tipul de violență primară, frecvența agresiunii și vârsta victimei (minor/major)',
        'cases_by_presentation_mode' => 'Distribuţia victimelor violenţei domestice (cazurilor) după modalitatea de prezentare a victimei',
        'cases_by_referring_institution' => 'Distribuţia victimelor violenţei domestice (cazurilor) după instituția care trimite victima',
    ],

    'headers' => [
        'missing_values' => 'Date lipsă',
        'gender_and_legal_address' => 'Gen / Domiciliu legal',
        'gender_and_effective_address' => 'Gen / Domiciliu efectiv',
        'ethnicity' => 'Etnie',
        'citizenship' => 'Cetățenie',
        'studies' => 'Nivel de studii',
        'occupation' => 'Ocupație',
        'occupation_and_effective_address' => 'Ocupație / Domiciliu efectiv',
        'income' => 'Încadrare în venit',
        'income_and_effective_address' => 'Încadrare în venit / Domiciliu efectiv',
        'home_ownership' => 'Dreptul de proprietate asupra locuinței primare',
        'home_ownership_and_effective_address' => 'Dreptul de proprietate asupra locuinței primare / Domiciliu efectiv',
        'civil_status' => 'Stare civilă',
        'aggressor_relationship' => 'Relația cu agresorul',
        'aggressor_relationship_and_age' => 'Relația cu agresorul / Vârsta victimei (minor/ major)',
        'primary_violence' => 'Tipul de violență primară',
        'violence_types' => 'Tipurile de violență',
        'gender' => 'Genul victimei',
        'age' => 'Vârsta victimei',
        'legal_address' => 'Domiciliul legal',
        'effective_address' => 'Domiciliul efectiv',
        'frequency_violence' => 'Frecvența agresiunii',
        'primary_violence_and_age' => 'Tipul de violență primară / Vârsta victimei	',
        'presentation_mode' => 'Modalitatea de prezentare a victimei',
        'referring_institution' => 'Instituția care trimite victima',

        'cases_by_age_groups' => 'Distribuţia cazurilor pe grupe de vârstă',
        'cases_by_effective_address' => 'Distribuţia cazurilor după domiciliul efectiv al victimei',
        'cases_by_gender' => 'Distribuţia cazurilor după genul victimei',
        'cases_by_age_segmentation' => 'Distribuţia cazurilor după vârsta victimei (minor/major)',
        'cases_by_frequency_violence' => 'Distribuția victimelor după frecvența agresiunii',

        'case_distribution' => 'Distribuția cazurilor',
        'subtotal' => 'Subtotal cazuri',
        'total' => 'Total general cazuri',
    ],

    'actions' => [
        'generate' => 'Generează raport'
    ]
];
