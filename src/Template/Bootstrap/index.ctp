<div id="list-example" class="list-group">
  <a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>
  <a class="list-group-item list-group-item-action" href="#list-item-2">Item 2</a>
  <a class="list-group-item list-group-item-action" href="#list-item-3">Item 3</a>
  <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
</div>
<div class="container theme-showcase" role="main">
  <h1 class="display-1">Display 1</h1>
  <h1 class="display-2">Display 2</h1>
  <h1 class="display-3">Display 3</h1>
  <?php
      echo $this->Form->create();
      echo $this->Form->input('textbox');
      echo $this->Form->input('select box', [
          'type' => 'select',
          'options' => [1, 2, 3]
      ]);
      echo $this->Form->input('radio', [
          'label' => 'radio',
          'type' => 'radio',
          'options' => [1, 2, 3]
      ]);
      echo $this->Form->input('checkbox', [
          'multiple' => 'checkbox',
          'options' => [1, 2, 3]
      ]);
      echo $this->Form->button('Submit', [
          'class' => 'btn btn-primary'
      ]);
      echo $this->form->end();
  ?>
</div>
