<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1>登録確認</h1>
  <?php echo $this->Form->create(false, array('type' => 'post', 'url' => '/todo/complete')); ?>
    <?php echo $this->Form->hidden('task_name', ['value' => $task_name]) ?>
    <?php echo $this->Form->hidden('task_detail', ['value' => $task_detail]) ?>
    <?php echo $this->Form->hidden('deadline', ['value' => $deadline['year'].'-'.$deadline['month'].'-'.$deadline['day']]) ?>
    <?php echo $this->Form->hidden('fk_status_id', ['value' => $status]) ?>
    <?php echo $this->Form->hidden('fk_user_id', ['value' => $personnel]) ?>


    <p><?php echo $task_name; ?></p>
    <p><?php echo $task_detail; ?></p>
    <p><?php echo $deadline['year'].'-'.$deadline['month'].'-'.$deadline['day']; ?></p>
    <p><?php echo $status;?></p>
    <p><?php echo $personnel;?></p>

    <?php echo $this->Form->button('完了'); ?>
  <?php echo $this->Form->end()?>
</body>
</html>
