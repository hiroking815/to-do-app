<?php

  namespace App\Controller;
  use Cake\ORM\TableRegistry;
  use Cake\ORM\Table;
  use Cake\ORM\Entity;
  use App\Controller\AppController;
  use Cake\Event\Event;
  use Cake\ORM\Query;
  use Cake\Datasource\ConnectionManager;
  use Cake\I18n\Time;


  class TodoController extends AppController{

    public function initialize(){
      parent::initialize();
      $this->Status = TableRegistry::get('status');
      $this->Users = TableRegistry::get('users');
      $this->Tasks = TableRegistry::get('tasks');
    }

    public function beforeFilter(Event $event){
      $statusAll = $statusVaild = array();
      foreach ($this->Status->find()->all() as $tmpSts){
        $statusAll += array ($tmpSts->status_id => $tmpSts->status_name);
        if($tmpSts->DEL_FLG != '1'){
          $statusVaild += array ($tmpSts->status_id => $tmpSts->status_name);
        }
      }
      $this->set(compact('statusAll', 'statusVaild'));

      $usersAll = $usersVaild = array();
      foreach ($this->Users->find()->all() as $tmpUser){
        $usersAll += array ($tmpUser->user_id => $tmpUser->user_name);
        if($tmpUser->DEL_FLG !='1'){
          $usersVaild += array ($tmpUser->user_id => $tmpUser->user_name);
        }
      }
      $this->set(compact('usersAll', 'usersVaild'));

    }

    public function index() {
      $tasks = $this->Tasks->find()->where(['del_flg' => '0']);
      $this->set(compact('tasks'));


    }

    public function search(){
      if($this->request->is('post')){
        $tasks = $this->Tasks-find()->where(['task_name like' => '%'.$task_name.'%']);
        $this->set(compact('tasks'));

        return redirect('/todo/index');
      }
    }


    public function view($task_id = null){

      $task = $this->Tasks->find()->where(['task_id' => $task_id, 'del_flg' => '0'])->firstOrFail();
      $this->set(compact('task'));
    }


    function newTask($task_id = null) {

    }

    function confirm() {
      $task_name = $this->request->data['task_name'];
      $task_detail = $this->request->data['task_detail'];
      $deadline = $this->request->data['deadline'];
      $status = $this->request->data['status'];
      $personnel = $this->request->data['personnel'];

      $this->set(array(
        'task_name' => $task_name,
        'task_detail' => $task_detail,
        'deadline' => $deadline,
        'status' => $status,
        'personnel' => $personnel
      ));

      var_dump($deadline);
    }

    function complete(){


      if($this->request->is('post')){
        $task = $this->Tasks->newEntity($this->request->data);

        $task = $this->Tasks->patchEntity($task, $this->request->data);
        if($this->Tasks->save($task, false)){
          $this->Flash->success('ok!');
          return $this->redirect('/todo/index');
        } else {
          $this->log(print_r($task->errors(),true),LOG_DEBUG);
          $this->Flash->error('データの登録に失敗しました');
        }

      }

      $this->set('tasks',$this->Tasks->newEntity());

    }

    public function edit($task_id = null){


      $task = $this->Tasks->get($task_id);

      $this->set(compact('task'));

      var_dump($task);

    }

    function delete($task_id = null){

      if($this->request->is('get')){

        $task = $this->Tasks->get($task_id);

        $task->del_flg = '1';

        if($this->Tasks->save($task)){
          $this->Flash->success('「'.$task->task_name.'」を削除しました');

          return $this->redirect('/todo/index');
        } else {
          $this->log(print_r($task->errors(),true),LOG_DEBUG);
          $this->Flash->error('データの更新に失敗しました');
        }



      }

    }
  }

?>
