<div class="users form">
  <?= $this->Flash->render() ?>
  <?= $this->Form->create() ?>
  <fieldset>
    <legend><?= __('Please enter your email address and password') ?></legend>
    <?= $this->Form->control('email') ?>
    <?= $this->Form->control('password') ?>
  </fieldset>
  <?= $this->Html->link('SignUp',  '/users/add',    ['class' => 'button', 'target' => 'top']) ?>
  <?= $this->Html->link('SignOut', '/users/logout', ['class' => 'button', 'target' => 'top']) ?>
  <?= $this->Form->button(__('SingIn')) ?>
  <?= $this->Form->end() ?>
</div>
