<?php

use Zahzah\ModulePhysicalExamination\{
    Models, Schemas, Contracts
};

return [
    'contracts' => [
        'patient_physical_examination' => Contracts\PatientPhysicalExamination::class
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