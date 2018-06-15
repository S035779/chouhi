<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
          'authorize'       => ['Controller']
        , 'authenticate'    => ['Form' =>
            ['fields' => ['username' => 'email']]
          ]
        , 'loginRedirect'   => ['controller' => 'Bootstrap', 'action' => env('APP_TOPPAGE')]
        , 'logoutRedirect'  => ['controller' => 'Users', 'action' => 'signin']
        , 'loginAction'     => ['controller' => 'Users', 'action' => 'signin']
        , 'authError'       => 'Sign-in required'
        , 'flash'           => [
          'params'  => [ 'class' => 'alert alert-danger', 'role' => 'alert' ] 
        , 'element' => 'flash'
          ]
        ]);
    }

    public function isAuthorized($user)
    {
      if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
      }
      return false;
    }
}
