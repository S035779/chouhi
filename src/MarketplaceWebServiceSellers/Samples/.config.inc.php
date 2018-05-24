<?php
namespace MarketplaceWebServiceSellers;

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../../.');

function mws_autoload($className){
  $className = preg_replace("/\\\\*\\\\|[^\\\\]*\\\\/" , '', $className);
  $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
  $includePaths = explode(PATH_SEPARATOR, get_include_path());
  foreach($includePaths as $includePath){
    if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
      require_once $filePath;
      return;
    }
  }
}

spl_autoload_register(__NAMESPACE__ . '\mws_autoload');
