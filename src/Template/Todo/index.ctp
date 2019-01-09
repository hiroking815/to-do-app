<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1>Todoリスト</h1>

  <h2>検索</h2>

  <fieldset>
    <?php
      echo $this->Form->create('null', [
        'type' => 'get',
        'url' => [
          'controller' => 'todo',
          'action' => 'search'
        ]
      ]);

      echo $this->Form->input('f_task_name',
        [
          'type' => 'text',
          'label' => 'タスク名を入力'
        ]
      );

      echo $this->Form->input(
        'f_deadline_frm',
        [
          'type' => 'date',
          'label' => '締め切り',
          'dateFormat' => 'YYYY-MM-DD',
          'monthNames' => false,
          'empty' => '----'
        ]
      );

      echo $this->Form->input(
        'f_deadline_to',
        [
          'type' => 'date',
          'label' => '締め切り',
          'dateFormat' => 'YYYY-MM-DD',
          'monthNames' => false,
          'empty' => '----'
        ]
      );

      echo $this->Form->input(
        'f_personnel',
        [
          'type' => 'select',
          'label' => '担当者',
          'options' => $usersVaild,
          'empty' => '選択してください'
        ]
      );

      echo $this->Form->input(
        'f_status',
        [
          'type' => 'select',
          'label' => '状態',
          'options' => $statusVaild,
          'empty' => '選択してください'
        ]
      );
      echo $this->Form->button('検索');
      echo $this->Form->end()
    ?>
  </fieldset>

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
