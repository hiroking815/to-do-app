<?php
  echo $this->Html->css('style.css');
  echo $this->Html->css('common.css');
  $this->assign('title', '編集');

 ?>

<div class="main">

  <?php

    echo $this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button']);

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
        'maxlength' => 40,
        'label' => 'タスク名',
        'default' => $task->task_name,
        'requied' => 'required'
      ]


    );

    echo $this->Form->input(
      'deadline',
      [
        'type' => 'date',
        'label' => '期限',
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
        'default' => ['personnel' => $task->fk_user_id]
      ]
    );

    echo $this->Form->input(
      'task_detail',
      [
        'type' => 'textarea',
        'label' => 'タスク詳細',
        'default' => $task->task_detail,
      ]
    );

    echo $this->Form->button('完了');

    echo $this->Form->end();


     ?>

</div><!-- #main -->
