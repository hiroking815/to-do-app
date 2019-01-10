<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StatusTable extends Table {
  public function initialize(array $config){
    $this->hasMany(
      'Tasks',
      [
        'joinType' => 'INNER',
        'foreignKey' => 'fk_status_id',
        'bindingKey' => 'status_id',
      ]
    );

  }

}

?>
