<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="<?= h($params['class']) ?>" role="<?= h($params['role']) ?>" onclick="this.classList.add('hidden')"><?= $message ?></div>
