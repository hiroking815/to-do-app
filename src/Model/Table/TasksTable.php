<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TasksTable extends Table {

  public function initialize(array $config) {

      $this->belongsTo('Users');
      $this->belongsTo('Status');

  }

  public function validationDefault(Validator $validator){

    $validator
      ->notEmpty(['task_name']);


    return $validator;

  }
}
?>
