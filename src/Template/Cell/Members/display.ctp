<div class="form_wrap">
<?php
  foreach($form_data as $k => $op) {
    if($k=='base') {
      echo $this->Form->create($member,$op);
    } else {
      echo $this->Form->control($k,$op);
    }
  }
  echo $this->Form->submit();
  echo $this->Form->end();
?>
</div>

