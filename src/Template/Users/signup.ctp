  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="desctiption" content="bootstrap-4.1.1">
    <meta name="author" content="Mamoru Hashimoto">
    <?= $this->Html->meta('icon') ?>

    <title><?= h($title) ?></title>

    <!-- Bootstrap CSS -->
    <?= $this->Html->css([
      '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
    , $this->Elixir->version('css/signin.css')
    ]) ?>
  </head>

  <body class="text-center">
    <?= $this->Flash->render(); ?>
    <div class="form-signin">
      <?= $this->Form->create($user, [
        'url' => ['controller' => 'Users', 'action' => 'signup']
      , 'class' => 'needs-validation'
      , 'novalidate' => true
      ]) ?>
      <img class="mb-4" src="/chouhi/img/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
      <?= $this->Form->text('name', [
        'required' => true
      , 'class' => 'form-control mb-3'
      , 'Placeholder' => 'Your name'
      , 'id' => 'name'
      , 'type' => 'text'
      , 'autofocus' => true
      ]) ?>
      <?= $this->Form->text('email', [
        'required' => true
      , 'class' => 'form-control'
      , 'Placeholder' => 'Your email'
      , 'id' => 'email'
      , 'type' => 'email'
      ]) ?>
      <?= $this->Form->text('password', [
        'required' => true
      , 'class' => 'form-control'
      , 'Placeholder' => 'Your password'
      , 'id' => 'password'
      , 'type' => 'password'
      ]) ?>
      <?= $this->Form->button(__('Sigh up'), [
        'class' => 'btn btn-lg btn-outline-secondary btn-block'
      , 'name' => 'signup'
      ]) ?>
      <p class="mt-5 mb-3 text-muted">&copy;Amazon MWS tools 2018</p>
      <?= $this->Form->end() ?>
    </div>
  </body>
