<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1>Todoリスト</h1>
  <h2>検索</h2>
    <?php
      echo $this->Form->create('null', [
        'type' => 'post',
        'url' => [
          'controller' => 'todo',
          'action' => 'search'
        ]
      ]);
    ?>
   <fieldset>
   <?php
      echo $this->Form->input(
        'find',
        [
          'label'=>[
            'text'=>'タスク名を入力'
        ],
      ]);
      echo $this->Form->button('検索');
   ?>
   </fieldset>
  <?= $this->Form->end() ?>

  <h2>一覧</h2>
  <?= $this->Html->link('新規追加', ['action' => 'new_task']) ?>

  <table>
    <th>タスク名</th>
    <th>詳細</th>
    <th>担当者</th>
    <th>状態</th>
    <th>締め切り</th>
    <th>登録日</th>
    <th>更新日</th>



    <?php foreach ($tasks as $task): ?>
    <tr>
      <td><?= $this->Html->link($task->task_name, ['action' => 'view', $task->task_id]) ?></td>
      <td><?= h($task->task_detail); ?></td>
      <td><?= h($task->fk_user_id); ?></td>
      <td><?= h($task->fk_status_id); ?></td>
      <td><?= h($task->deadline); ?></td>
      <td><?= h($task->create_date); ?></td>
      <td><?= h($task->update_date); ?></td>

    </tr>
    <?php endforeach; ?>
  </table>

</body>
</html>
