<?php
namespace App\Shell\Task;

use Cake\Console\Shell;

/**
 * Mysqldump shell task.
 */
class MysqldumpTask extends Shell
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
      $date = date('Ymd-His');
      $hostname = 'localhost';
      $command = sprintf('mysqldump -u %s -p %s %s > %s/%sbackup.sql'
        , env('DB_USERNAME')
        , env('DB_PASSWORD')
        , env('DB_SCHEMA')
        , ROOT . DIRECTORY_SEPARATOR . env('STORAGE')
        , $date
      );
      exec($command, $output, $result);
      $this->out($this->nl(2));
      $this->hr();
      $this->out('MySQL backup shell ');
      $this->hr();
      $data = [
        ['Location',  'Command',  'Date' ]
      , [$hostname,   $command,   $date ]
      ];
      $this->helper('Table')->output($data);
      $this->out($this->nl(2));
    }
}
