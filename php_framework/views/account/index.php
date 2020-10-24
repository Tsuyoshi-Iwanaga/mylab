<?php $this->setLayoutVar('title', 'アカウント') ?>
<h2>アカウント</h2>
<p>
  <span>ユーザID:</span>
  <a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($user['user_name']); ?>">
    <strong><?php echo $this->escape($user['user_name']); ?></strong>
  </a>
</p>
<ul>
  <li><a href="<?php echo $base_url; ?>/">ホーム</a></li>
  <li><a href="<?php echo $base_url; ?>/account/signout">サインアウト</a></li>
</ul>
<h3>フォロー中ユーザ</h3>
<ul>
<?php foreach($followings as $following): ?>
<li><a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($following['user_name']); ?>">
<?php echo $this->escape($following['user_name']); ?></a></li>
<?php endforeach; ?>
</ul>