<?php
  echo $this->Html->css('style.css');
  echo $this->Html->css('common.css');
  $this->assign('title', '確認');

 ?>

<div class="main">

  <?php echo $this->Form->create(false, array('type' => 'post', 'url' => '/todo/complete')); ?>
  <?php echo $this->Form->hidden('task_name', ['value' => $task_name]) ?>
  <?php echo $this->Form->hidden('task_detail', ['value' => $task_detail]) ?>
  <?php echo $this->Form->hidden('deadline', ['value' => $deadline['year'].'-'.$deadline['month'].'-'.$deadline['day'].' '.'23:59:59']) ?>
  <?php echo $this->Form->hidden('fk_status_id', ['value' => $status_id]) ?>
  <?php echo $this->Form->hidden('fk_user_id', ['value' => $user_id]) ?>


  <table>
    <tr>
      <th>タスク名</th>
      <th>担当者</th>
      <th>状態</th>
      <th>期限</th>
    </tr>
    <tr>
      <td><?php echo $task_name; ?></td>
      <td><?php echo $personnel;?></td>
      <td><?php echo $status;?></td>
      <td><?php echo $deadline['year'].'-'.$deadline['month'].'-'.$deadline['day']; ?></td>
    </tr>
  </table>
  <div id="task_detail">
    <h2>タスク詳細</h2>
    <p><?php echo $task_detail; ?></p>
  </div>



  <?php echo $this->Form->button('完了'); ?>
  <?php echo $this->Form->end()?>

</div><!-- #main -->
