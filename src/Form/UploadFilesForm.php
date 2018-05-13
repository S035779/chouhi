<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class UploadFilesForm extends Form
{
  protected function _buildValidator(Validator $validator)
  {
    $validator->provider('customValidate', 'App\Model\Validation\CustomValidation');
    $validator
      ->add('upload_file', 'isCSV', [
        'provider'  => 'customValidate'
      , 'rule'      => 'isCSV'
      , 'message'   => 'CSV file only.'
      ])
      ->add('upload_file', 'limitFileSize', [
        'provider'  => 'customValidate'
      , 'rule'      => 'limitFileSize'
      , 'message'   => '200 byte limit.'
      ]);
    return $validator;
  }
}
