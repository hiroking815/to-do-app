<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
  public function initialize(array $config){
    $this->hasMany(
      'Tasks',
      [
        'joinType' => 'INNER',
        'foreignKey' => 'fk_user_id',
        'bindingKey' => 'user_id',
      ]
    );

  }

}

 ?>
