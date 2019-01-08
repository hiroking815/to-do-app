<?php

  namespace App\Model\Entity;

  use Cake\ORM\Entity;

  class Tasks extends Entity {

    protected $_accessible = [
        '*' => true,
        'task_id' => false
    ];
  }

?>
