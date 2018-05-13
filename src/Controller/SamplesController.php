<?php
namespace App\Controller;

use App\Controller\AppController;

class SamplesController extends AppController
{
    public function initialize() 
    {
      $this->viewBuilder()->setLayout('samples');
    }

    public function index()
    {
      $title = 'PHPフレームワークリスト';
      $list = [
        'Lalavel',
        'CakePHP',
        'Symfony',
        'Zend Framework',
        'CodeIgniter',
        'Phalcon',
        'Slim',
        'Yii',
        'FuelPHP',
        'Silex',
        'Flight',
        'BEAR.Sunday',
        'Kohana',
        'Ethna',
        'Ice Framework'
      ];

      $this->set(compact('title', 'list'));
    }
}
