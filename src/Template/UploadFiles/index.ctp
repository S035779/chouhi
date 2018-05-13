<div class="uploadFiles index large-9 medium-8 columns content">
  <h3><?= __("File Upload Form") ?></h3>
  <div class="form_wrap">
    <?php
      echo $this->Form->create($fileform, [
        'type' => 'file'
      , 'url' => ['controller' => 'UploadFiles', 'action' => 'index']
      ]);
      echo $this->Form->control('upload_file', [
        'type' => 'file'
      , 'label' => 'File'
      , 'required' => true
      ]);
      echo $this->Form->submit();
      echo $this->Form->end();
    ?>
  </div>
</div>
