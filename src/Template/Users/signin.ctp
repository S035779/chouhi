  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="desctiption" content="bootstrap-4.1.1">
    <meta name="author" content="Mamoru Hashimoto">
    <link rel="icon" href="favicon.ico">

    <title><?= h($title) ?></title>

    <!-- Bootstrap CSS -->
    <?= $this->Html->css([
        '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
      ]) ?>
    <link rel="stylesheet" href="/chouhi<?= $this->Elixir->version('css/signin.css') ?>">
  </head>

  <body class="text-center">
  <?= $this->Flash->render() ?>
    <div class="form-signin">
    <?= $this->Form->create() ?>
      <img class="mb-4" src="/chouhi/img/bootstrap-solid.svg"
         alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">
        Please sign in</h1>
      <label for="email" class="sr-only">Email address</label>
      <?= $this->Form->text('email', [
        'required' => false
      , 'class' => 'form-control'
      , 'placeholder' => 'Email address'
      , 'id' => 'email'
      , 'type' => 'email'
      , 'autofocus' => true 
      ]) ?>
      <label for="password" class="sr-only">Password</label>
      <?= $this->Form->text('password', [
        'required' => false
      , 'class' => 'form-control'
      , 'placeholder' => 'Password'
      , 'id' => 'password'
      , 'type' => 'password'
      ]) ?>
      <div class="checkbox mb-3">
        <label><input type="checkbox" value="remember-me"> Remember me</label>
      </div>
      <?= $this->Form->button(__('Sign in'), [
        'class' => 'btn btn-lg btn-primary btn-block'
      , 'name' => 'signin'
      ]) ?>
      <?= $this->Form->button(__('Sign up'), [
        'class' => 'btn btn-lg btn-outline-seconday btn-block'
      , 'name' => 'signup'
      ]) ?>
      <p class="mt-5 mb-3 text-muted">&copy;Amazon MWS tools 2018</p>
    <?= $this->Form->end() ?>
    </div>
  </body>
