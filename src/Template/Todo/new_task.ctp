<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <?php
  echo $this->Html->css('list.css');
  ?>
</head>
<body>
  <h1>新規登録</h1>
  <p>
    <?php

      echo $this->Form->create(
        'null',
        [
          'type' => 'post',
          'url' => [
            'controller' => 'todo',
            'action' => 'confirm'
          ]
        ]
      );

      echo $this->Form->input(
        'task_name',
        [
          'type' => 'text',
          'size' => 40,
          'label' => 'タスク名'
        ]
      );

      echo $this->Form->input(
        'task_detail',
        [
          'type' => 'textarea',
          'label' => 'タスク詳細'
        ]
      );

      echo $this->Form->input(
        'deadline',
        [
          'type' => 'date',
          'label' => '締め切り',
          'dateFormat' => 'YYYY-MM-DD',
          'monthNames' => false,
        ]
      );

      echo $this->Form->input(
        'status',
        [
          'type' => 'select',
          'label' => '状態',
          'options' => $statusVaild
        ]
      );

      echo $this->Form->input(
        'personnel',
        [
          'type' => 'select',
          'label' => '担当者',
          'options' => $usersVaild,
          'empty' => '選択してください'
        ]
      );

      echo $this->Form->button('完了');

      echo $this->Form->end();
    ?>
  </p>
</body>
</html>
