<?php
  echo $this->Html->css('style.css');
  echo $this->Html->css('common.css');
  $this->assign('title', '新規登録');

 ?>

<div class="main">
  <p>
    <?php

      echo $this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button']);


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
          'maxlength' => 40,
          'label' => 'タスク名',
          'required' => 'required'
        ]
      );

      echo $this->Form->input(
        'deadline',
        [
          'type' => 'date',
          'label' => '期限',
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
          'empty' => '選択してください',
          'required' => 'required',
        ]
      );

      echo $this->Form->input(
        'task_detail',
        [
          'type' => 'textarea',
          'label' => 'タスク詳細'
        ]
      );

      echo $this->Form->button('完了');

      echo $this->Form->end();
    ?>
  </p>
</div><!-- #main -->
