<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class SubmissionForm extends Form
{
  protected function _buildValidator(Validator $validator)
  {
    $validator->provider('customValidate', 'App\Model\Validation\CustomValidation');
    $validator
      ->add('upload_file', 'isImage', [
        'provider'  => 'customValidate'
      , 'rule'      => 'isImage'
      , 'message'   => 'png, jpg, gif only.'
      ])
      ->add('upload_file', 'limitFileSize', [
        'provider'  => 'customValidate'
      , 'rule'      => 'limitFileSize'
      , 'message'   => '100 kilo byte limit.'
      ]);
    return $validator;
  }
}
