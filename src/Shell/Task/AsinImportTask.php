<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

/**
 * AsinImport shell task.
 */
class AsinImportTask extends Shell
{
  /**
   * Manage the available sub-commands along with their arguments and help
   *
   * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
   * @return \Cake\Console\ConsoleOptionParser
   */
  public function getOptionParser()
  {
    $parser = parent::getOptionParser();

    return $parser;
  }

  /**
   * main() method.
   *
   * @return bool|int|null Success or error code.
   */
  public function main()
  {
    $this->execAsinImport();
  }

  private function execAsinImport() 
  {
    $header = array(
      'asin' => true
    , 'marketplace' => true
    , 'created' => true
    , 'modified' => true
    , 'suspended' => true
    );
    $datas = $this->fetchAsin('test.csv', $header);
    //print_r($datas);

    $asins = TableRegistry::get('Asins');
    $query = $asins->query();
    $query->insert(array_keys($header));
    foreach($datas as $data) {
      $query->values($data);
    }
    $query->execute();
    return true;
  }

  private function fetchAsin($import_file, $header)
  {
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $filename = sprintf(ROOT . '\storage\%s', $import_file);
    $org_file = @fopen($filename, 'rb') or die("FIle can not opened.\n");
    flock($org_file, LOCK_SH);
    while($row = fgetcsv($org_file, 1024, "\t")) {
      $idx = 0; $_idx = 0;
      foreach(array_keys($header) as $_header) {
        if(array_values($header)[$_idx]) {
          if($_header === 'created' || $_header === 'modified') {
            $_body = $datetime;
          } else if($_header === 'suspended') {
            $_body = 1;
          } else {
            $_body = $this->e($row[$idx]);
            $idx += 1;
          }
          $_idx += 1;
        } else {
          $_body = 'N/A';
          $_idx += 1;
        }
        $data[$_header] = $_body;
        //print($_header . ':' . '[' . $_body . ']' . "\n");
      }
      array_push($datas, $data);
    }
    flock($org_file, LOCK_UN);
    fclose($org_file);
    return $datas;
  }

  private function e($str)
  {
    return mb_convert_encoding($str, 'utf8', 'sjis-win');
  }
}
