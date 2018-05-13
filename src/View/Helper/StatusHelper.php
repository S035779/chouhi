<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Status helper
 */
class StatusHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function get_fw_name(int $num)
    {
      switch($num) {
      case 1:
        return 'Cakephp';
      case 2:
        return 'Lalabel';
      default:
        return '';
      }
    }
}
