<?php
  namespace App\Model\Entity;

  use Cake\ORM\Entity;

  class Users extends Entity {

    protected $_accessible = [
      '*' => true,
      'id' => false,
    ];
    
  }

?>
