<?php

use Hanafalah\ModulePhysicalExamination\{
    Models,
    Schemas,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
            'patient_physical_examination' => Contracts\PatientPhysicalExamination::class
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            'PhysicalExamination' => Models\PhysicalExamination::class,
            'PatientPhysicalExamination' => Models\PatientPhysicalExamination::class
        ]
    ],
    'examinations' => [
        'PhysicalExamination' => [
            'schema' => Schemas\PhysicalExamination::class
        ]
    ]
];
