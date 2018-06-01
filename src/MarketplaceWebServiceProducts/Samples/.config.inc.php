<?php
namespace MarketplaceWebServiceProducts;

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../../.');

function mws_autoload($className){
  //echo ("NameSpace: " . __NAMESPACE__ . "\n");
  $className = preg_replace("/\\\\*\\\\|[^\\\\]*\\\\/" , '', $className);
  //echo ("------------------------------------------------------------------\n");
  //echo ("===  className:" . $className . "  ===\n");
  //echo ("------------------------------------------------------------------\n");
  $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
  //echo ("------------------------------------------------------------------\n");
  //echo (">>>  filePath:" . $filePath . "  <<<\n");
  //echo ("------------------------------------------------------------------\n");
  $includePaths = explode(PATH_SEPARATOR, get_include_path());
  foreach($includePaths as $includePath){
    if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
      //echo ("------------------------------------------------------------------\n");
      //echo ("***  require_once:" . $filePath . "  ***\n");
      //echo ("------------------------------------------------------------------\n");
      require_once $filePath;
      return;
    }
  }
}
spl_autoload_register(__NAMESPACE__ . '\mws_autoload');
