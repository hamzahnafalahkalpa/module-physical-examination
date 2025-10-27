<?php

namespace Hanafalah\ModulePhysicalExamination\Resources\PhysicalExamination;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewPhysicalExamination extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $exam = $this->exam;
    $new_exam = [];
    foreach ($exam as $key => &$form) {
      if (in_array($key, ['male_body_form', 'female_body_form'])) {
        $new_exam['body_form'] = $form;
      }elseif (in_array($key, ['male_muscle_form', 'female_muscle_form'])) {
        $new_exam['muscle_form'] = $form;
      }else{
        $new_exam[$key] = $form;
      }
    }
    $arr = [
      'id'                 => $this->id,
      'morph'              => $this->morph,
      'exam'               => $new_exam,
      'practitioner_evaluations' => $this->prop_practitioner_evaluations ?? [],
      'created_at'         => $this->created_at,
      'updated_at'         => $this->updated_at
    ];
    return $arr;
  }
}
