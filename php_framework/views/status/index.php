<?php $this->setLayoutVar('title', 'ホーム') ?>
<h2>ホーム</h2>
<?php if(isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', ['errors' => $errors]); ?>
<?php endif; ?>
<form action="<?php echo $base_url; ?>/status/post" method="post">
  <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>">
  <textarea name="body" cols="60" rows="2"><?php echo $this->escape($body); ?></textarea>
  <p><input type="submit" value="発言"></p>
</form>
<div id="statuses">
  <?php echo $this->render('status/status', ['statuses' => $statuses]); ?>
</div>