<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><?= h($task->task_name); ?></h1>
  <p><?= h($task->task_detail); ?></p>
  <p><?= h($task->fk_user_id); ?></p>
  <p><?= h($task->fk_task_id); ?></p>
  <p><?= h($task->deadline); ?></p>
  <p><?= h($task->create_date); ?></p>
  <p><?= h($task->update_date); ?></p>

  <?= $this->Html->link('更新', ['action' => 'edit', $task->task_id]) ?>
  <?= $this->Html->link('削除', ['action' => 'delete', $task->task_id]) ?>


</body>
</html>
