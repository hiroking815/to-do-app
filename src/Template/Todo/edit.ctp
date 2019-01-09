<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php


    echo $this->Form->create(
      'null',
      [
        'type' => 'post',
        'url' => [
          'controller' => 'todo',
          'action' => 'complete'        ]
      ]
    );

    echo $this->Form->hidden('task_id', ['value' => $task->task_id]);

    echo $this->Form->input(
      'task_name',
      [
        'type' => 'text',
        'size' => 40,
        'label' => 'タスク名',
        'default' => $task->task_name
      ]


    );

    echo $this->Form->input(
      'task_detail',
      [
        'type' => 'textarea',
        'label' => 'タスク詳細',
        'default' => $task->task_detail
      ], [
        'default' => $task->task_detail
      ]
    );

    echo $this->Form->input(
      'deadline',
      [
        'type' => 'date',
        'label' => '締め切り',
        'dateFormat' => 'YYYY-MM-DD',
        'monthNames' => false,
        'default' => $task->deadline
      ]
    );

    echo $this->Form->input(
      'status',
      [
        'type' => 'select',
        'label' => '状態',
        'options' => $statusVaild,
        'default' => ['status' => $task->status]

      ]
    );

    echo $this->Form->input(
      'personnel',
      [
        'type' => 'select',
        'label' => '担当者',
        'options' => $usersVaild,
        'empty' => '選択してください',
        'default' => ['personnel' => $task->fk_user_id]
      ]
    );

    echo $this->Form->button('完了');

    echo $this->Form->end();
  ?>
</body>
</html>
