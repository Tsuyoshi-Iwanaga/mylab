<?php if(isset($errors) && count($errors) > 0): ?>
<ul class="error_list">
<?php foreach($errors as $error): ?>
<li><?php echo $this->escape($error) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>