<?php

namespace Hanafalah\ModulePhysicalExamination\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Hanafalah\ModulePhysicalExamination\Contracts;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePhysicalExamination\Resources\PatientPhysicalExamination\{
    ViewPatientPhysicalExamination,
    ShowPatientPhysicalExamination
};

class PatientPhysicalExamination extends PackageManagement implements Contracts\Schemas\PatientPhysicalExamination
{
    protected string $__entity = 'PatientPhysicalExamination';
    public static $patient_physical_examination_model;

    protected array $__resources = [
        'view' => ViewPatientPhysicalExamination::class,
        'show' => ShowPatientPhysicalExamination::class
    ];

    public function prepareStorePatientPhysicalExamination(?array $attributes = null)
    {
        $attributes ??= request()->all();

        $exam = $this->patientPhysicalExamination()->updateOrCreate([
            'reference_type' => $attributes['reference_type'],
            'reference_id'   => $attributes['reference_id'],
            'anatomy_id'     => $attributes['anatomy_id'],
            'patient_id'     => $attributes['patient_id'],
        ], [
            'condition' => $attributes['condition']
        ]);

        $exam->is_permanent = $attributes['is_permanent'] ?? false;
        $exam->coordinate   = $attributes['coordinate'] ?? [];

        return static::$patient_physical_examination_model = $exam;
    }

    public function prepareViewPatientPhysicalExaminationList(?array $attributes = null): Collection
    {
        $attributes ??= request()->all();

        $anatomies = $this->patientPhysicalExamination()->when(isset($attributes['morph']), function ($query) use ($attributes) {
            $query->where('morph', $attributes['morph']);
        })->get();

        return static::$patient_physical_examination_model = $anatomies;
    }

    public function viewPatientPhysicalExaminationList(): array
    {
        return $this->transforming($this->__resources['view'], function () {
            return $this->prepareViewPatientPhysicalExaminationList();
        });
    }

    public function patientPhysicalExamination(): Builder
    {
        $this->booting();
        return $this->PatientPhysicalExaminationModel()->withParameters()->orderBy('condition', 'asc');
    }
}
