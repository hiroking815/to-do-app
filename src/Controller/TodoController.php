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

  /**
   * class
   * TodoController
   */
  class TodoController extends AppController{

    /**
     * function
     * initialize
     */
    public function initialize(){

      parent::initialize();
      $this->Status = TableRegistry::get('status');
      $this->Users = TableRegistry::get('users');
      $this->Tasks = TableRegistry::get('tasks');
      $this->layout = 'todoLayout';
    } //end initialize()

    /**
     * function
     * beforeFilter
     */
    public function beforeFilter(Event $event){

      $statusAll = $statusVaild = array();

      foreach ($this->Status->find()->all() as $tmpSts){

        $statusAll += array ($tmpSts->status_id => $tmpSts->status_name);

        if($tmpSts->DEL_FLG != '1'){

          $statusVaild += array ($tmpSts->status_id => $tmpSts->status_name);

        } // end if

      } //end foreach

      $this->set(compact('statusAll', 'statusVaild'));

      $usersAll = $usersVaild = array();

      foreach ($this->Users->find()->all() as $tmpUser){

        $usersAll += array ($tmpUser->user_id => $tmpUser->user_name);

        if($tmpUser->DEL_FLG !='1'){

          $usersVaild += array ($tmpUser->user_id => $tmpUser->user_name);

        } //end if

      } //end foreach

      $this->set(compact('usersAll', 'usersVaild'));

    } // end beforeFilter()


    /**
     * トップ画面
     * function
     * index
     */
    public function index() {

      $tasks = $this->Tasks->find('all',
        ['order' => ['Tasks.create_date' => 'DESC']]
        )
        ->select([
          'task_id',
          'task_name',
          'task_detail',
          'users.user_name',
          'status.status_name',
          'deadline',
          'create_date',
          'update_date'
        ])
        ->join([
          'Users' => [
              'table' => 'Users',
              'type' => 'INNER',
              'conditions' => 'Tasks.fk_user_id = Users.user_id',
          ],
          'Status' => [
              'table' => 'Status',
              'type' => 'INNER',
              'conditions' => 'Tasks.fk_status_id = Status.status_id',
          ]
        ])
        ->where(['Tasks.del_flg' => '0']);

      $this->set(compact('tasks'));


    } //end index()

    /**
     * 検索結果表示画面
     * function
     * search
     */
    public function search(){

      if($this->request->is('get')){

        $f_task_name = $this->request->getQuery('f_task_name');
        $tmp_deadline_frm = $this->request->getQuery('f_deadline_frm');
        $tmp_deadline_to = $this->request->getQuery('f_deadline_to');
        $f_personnel = $this->request->getQuery('f_personnel');
        $f_status = $this->request->getQuery('f_status');

        $f_deadline_frm = "'".$tmp_deadline_frm['year'].'-'.$tmp_deadline_frm['month'].'-'.$tmp_deadline_frm['day']."'";
        $f_deadline_to = "'".$tmp_deadline_to['year'].'-'.$tmp_deadline_to['month'].'-'.$tmp_deadline_to['day']."'";

        $tasks = $this->Tasks->find('all',
          ['order' => ['Tasks.create_date' => 'DESC']])
          ->select([
            'task_id',
            'task_name',
            'task_detail',
            'users.user_name',
            'status.status_name',
            'deadline',
            'create_date',
            'update_date'
          ])
          ->join([
            'Users' => [
                'table' => 'Users',
                'type' => 'INNER',
                'conditions' => 'Tasks.fk_user_id = Users.user_id',
            ],
            'Status' => [
                'table' => 'Status',
                'type' => 'INNER',
                'conditions' => 'Tasks.fk_status_id = Status.status_id',
            ]
          ])
          ->where(['Tasks.del_flg' => '0']);

        if($f_task_name != ''){

          $tasks = $tasks->where(['Tasks.task_name LIKE' => '%'.$f_task_name.'%']);

        } //end if

        if($tmp_deadline_frm['year'] != '' && $tmp_deadline_to['year'] == ''){

          $tasks = $tasks->where('Tasks.deadline >= '.$f_deadline_frm);

        } elseif ($tmp_deadline_frm['year'] == '' && $tmp_deadline_to['year'] != '') {

          $tasks = $tasks->where('Tasks.deadline <= '.$f_deadline_to);

        } //end if

        if($tmp_deadline_frm['year'] != '' && $tmp_deadline_to['year'] != ''){

          $tasks = $tasks->where('Tasks.deadline BETWEEN '.$f_deadline_frm.' AND '.$f_deadline_to);

        } //end if

        if($f_personnel != ''){

          $tasks = $tasks->where(['Tasks.fk_user_id' => $f_personnel]);

        } //end if

        if($f_status != ''){

          $tasks = $tasks->where(['Tasks.fk_status_id' => $f_status]);

        } //end if

        $this->set(compact('tasks'));

      } //end if

    } //end search()

    /**
     * 詳細表示画面
     * function
     * view
     */
    public function view($task_id = null){

      $task = $this->Tasks->find()
        ->select([
          'task_id',
          'task_name',
          'task_detail',
          'users.user_name',
          'status.status_name',
          'deadline',
          'create_date',
          'update_date'
        ])
        ->join([
          'Users' => [
              'table' => 'Users',
              'type' => 'INNER',
              'conditions' => 'Tasks.fk_user_id = Users.user_id',
          ],
          'Status' => [
              'table' => 'Status',
              'type' => 'INNER',
              'conditions' => 'Tasks.fk_status_id = Status.status_id',
          ]
        ])
        ->where(['Tasks.task_id' => $task_id, 'Tasks.del_flg' => '0'])
        ->first();

      $this->set(compact('task'));

    } //end view()


    function newTask() {

    } //end newTask()

    /**
     * 編集画面
     * function
     * edit
     */
    public function edit($task_id = null){

      $task = $this->Tasks->get($task_id);

      $this->set(compact('task'));

    } //end edit()

    /**
     * 新規・編集確認画面
     * function
     * confirm
     */
    function confirm($task_id = null) {

      $task_name = $this->request->data['task_name'];
      $task_detail = $this->request->data['task_detail'];
      $deadline = $this->request->data['deadline'];
      $status_id = $this->request->data['status'];
      $user_id = $this->request->data['personnel'];

      $status = $this->Status->get($status_id);
      $personnel = $this->Users->get($user_id);

      $this->set(array(
        'task_name' => $task_name,
        'task_detail' => $task_detail,
        'deadline' => $deadline,
        'status_id' => $status_id,
        'user_id' => $user_id,
        'status' => $status['status_name'],
        'personnel' => $personnel['user_name']
      ));

    } //end confirm()


    /**
     * 新規・編集完了 -> index
     * function
     * complete
     */
    function complete($task_id = null){

      $task_id = $this->request->data['task_id'];
      $this->set(['task_id' => $task_id]);

      if(is_null($task_id)){

        $task = $this->Tasks->newEntity($this->request->data);
        $msg = '登録';


      } else {

        $task = $this->Tasks->get($task_id);
        $msg = '更新';

      } //end if

      if($this->request->is('post', 'get')){

        $task = $this->Tasks->patchEntity($task, $this->request->data);

        if($this->Tasks->save($task, false)){

          $this->Flash->success($msg);

          return $this->redirect('/todo/index');

        } else {

          $this->log(print_r($task->errors(),true),LOG_DEBUG);

          $this->Flash->error('データの登録に失敗しました');

          return $this->redirect('/todo/index');

        } //end if

      } //end if

      $this->set(compact('task'));


    } //end complete()


    /**
     * 削除
     * function
     * delete
     */
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

        } //end if

      } //end if

    } //end delete()

  }//end TodoController

?>
