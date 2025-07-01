<?php

namespace Hanafalah\ModulePhysicalExamination\Resources\PatientPhysicalExamination;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ShowPatientPhysicalExamination extends ViewPatientPhysicalExamination
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $resquest
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'reference'      => $this->relationValidation('reference', function () {
        return $this->reference->toShowApi()->resolve();
      }),
      'anatomy'        => $this->relationValidation('anatomy', function () {
        return $this->anatomy->toShowApi()->resolve();
      }),
      'patient'        => $this->relationValidation('patient', function () {
        return $this->patient->toShowApi()->resolve();
      })
    ];
    $arr = $this->mergeArray(parent::toArray($request), $arr);

    return $arr;
  }
}
