<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'AmazonMWS Tools: the database management tools';
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css([
      '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
    , $this->Elixir->version('css/watchnote.css')
    ]) ?>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <?= $this->Html->link(
        env('APP_NAME')
      , ['controller' => 'Bootstrap', 'action' => 'index']
      , ['class' => 'navbar-brand col-sm-3 col-md-2 mr-0']
      ) ?>
      <input class="form-control form-control-dark w-100" type="text"
        placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <?= $this->Html->link(
            ' Sign out '
          , ['controller' => 'Users', 'action' => 'signout']
          , ['class' => 'nav-link']
          ) ?>
        </li>
      </ul>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container-fluid">
      <div class="row">

        <?= $this->fetch('content') ?>

      </div>
    </div>
    <footer>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?= $this->Html->script([
        '//code.jquery.com/jquery-3.3.1.slim.min.js'
      , '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
      , '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'
      , '//unpkg.com/feather-icons/dist/feather.min.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
  </body>
</html>
