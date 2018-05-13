<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class CustomValidation extends Validation
{
  public static function isCSV($files)
  {
    $ret = true;
    $allows = array("application/vnd.ms-excel", "text/csv");
    $ext = explode($files['name'], '.');
    if(!in_array($files['type'], $allows) || !end($ext)=='csv') {
      $ret = false;
    }
    return $ret;
  }

  public static function isImage($files)
  {
    $ret = true;
    $allows = array("image/png", "image/jpeg", "image/gif");
    $exts = array("png", "jpeg", "jpg", "gif");
    $sep = explode('.', $files['name']);
    $ext = end($sep);
    if(!in_array($files['type'], $allows) || !in_array($ext, $exts)) {
      $ret = false;
    }
    return $ret;
  }

  public static function limitFileSize($files)
  {
    return ($files['size'] < 100000);
  }
}
