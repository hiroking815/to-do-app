<?php
  echo $this->Html->css('style.css');
  echo $this->Html->css('common.css');
  $this->assign('title', '詳細確認');

 ?>

<div class="main">

  <h2>タスク：<?= h($task->task_name); ?></h2>


  <?= $this->Html->link('更新', ['action' => 'edit', $task->task_id]) ?>
  <?= $this->Html->link('削除', ['action' => 'delete', $task->task_id]) ?>
  <br>

  <table>
    <tr>
      <th>担当者</th>
      <th>状態</th>
      <th>期限</th>
      <th>作成日</th>
      <th>更新日</th>
    </tr>

    <tr>
      <td><?= h($task->users['user_name']); ?></td>
      <td><?= h($task->status['status_name']); ?></td>
      <td><?= h($task->deadline); ?></td>
      <td><?= h($task->create_date); ?></td>
      <td><?= h($task->update_date); ?></td>
    </tr>

  </table>

  <div id="task_detail">
    <label>タスク詳細</label>
    <p><?= h($task->task_detail); ?></p>
  </div>

  <?= $this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button']) ?>

</div><!-- #main -->
