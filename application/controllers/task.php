<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Task extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('task_model');
        //$this->output->enable_profiler(TRUE);
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'DHL Task tracking : Task';
        
        $this->loadViews("tasks", $this->global, NULL , NULL);
    }
    

    /**
     * This function is used to load the user list
     */
    function taskListing($offset = '', $from ='', $to = '', $status= '', $addedstatus = '')
    {
//$this->output->enable_profiler(TRUE);
//        if($this->isAdmin() == TRUE)
//        {
//            $this->loadThis();
//        }
//        else
//        {
            $data['addresult'] = $addedstatus;
            $this->load->model('task_model');

            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');

            $groupId = $this->global ['groupId'];
            $groupName = $this->global ['groupName'];

            $uid = $this->global ['id'];
            $role = $this->global ['role'] = $this->role;

            $tasks = $this->input->get('task');
            $criterias = "";
            $search = '';
            if(!empty($tasks)) {
                if($tasks == 'done') {
                $criterias = array(
                                'isDone =' => 1,
                );
                $status= 'done';
            } else if($tasks == 'remain') {
                    $criterias = array(
                                'isDone =' => 0,
                );
            } else if($tasks == 'showall') {

            } else if($tasks == 'search') {
                $search = ' AND title like "%'.$this->input->get('hwb').'%" ';   
                $from = date('Y-m-d',strtotime(("-3650 day")));  

             }

            }
            // $count = $this->task_model->taskListingCount($searchText,$groupId);
            if($role == 1) {
                $count = $this->task_model->taskListingCount($searchText,'','','',$criterias);
            } else if($role <= 3) {
                $count = $this->task_model->taskListingCount($searchText,'','',$groupId,$criterias);
            } else {
                $count = $this->task_model->taskListingCount($searchText,$uid,'',$groupId,$criterias);        
            }


			$returns = $this->paginationCompress( "tasks/", $count, 5000 );
            $data['filter'] = array();

            if(empty($from)) {
                $from = date('Y-m-d',strtotime(("-3 day")));
                $fromsummary = date('Y-m-d',strtotime(("-365 day")));
            } else {
                $fromsummary = $from;
            }

            if(empty($to)) {
                $to = date('Y-m-d');
            }

            if(!empty($from) && !empty($to)) {
                $data['filter']['from'] = $from;
                $data['filter']['fromsummary'] = $fromsummary;
                $data['filter']['to'] = $to;
                $criterias = 'DATE(Tasks.created_at) BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"';
            }

            if($status == 'pending' || empty($status)) {
                $status = 'pending';
                if($tasks != 'search')
                    $criterias .= ' AND Status.isDone = 0';
            }

            if($status == 'released') {
                $status = 'released';
                if($tasks != 'search')
                    $criterias .= ' AND Status.isDone = 1';
            }

            if($status == 'passjpv') {
                $status = 'passjpv';
                if($tasks != 'search')
                    $criterias .= ' AND Status.statusId = 14';
            }

            if($status == 'passeasy') {
                $status = 'passeasy';
                if($tasks != 'search')
                    $criterias .= ' AND Status.statusId = 16';
            }

            if($status == 'passcsq') {
                $status = 'passcsq';
                if($tasks != 'search')
                    $criterias .= ' AND Status.statusId = 5';
            }

            if($status == 'waitagent') {
                $status = 'waitagent';
                if($tasks != 'search')
                    $criterias .= ' AND Status.statusId = 7';
            }


            if($status == 'waitcustomer') {
                $status = 'waitcustomer';
                if($tasks != 'search')
                    $criterias .= ' AND Status.statusId = 15';
            }


            $criterias .= $search;

            if($role == 1) {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'','','',$criterias);
                $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,'','',$criterias);
            } else if($role <= 3 || $tasks == "showall") {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'','',$groupId,$criterias,'no');
                // $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,'',$groupId,$criterias);
                $data['todayTaskRecords'] = "";
            } else {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'',$uid,$groupId,$criterias);

                // $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,$uid,$groupId,$criterias);

                $data['todayTaskRecords'] = "";
            }

            $data['summary'] = $this->task_model->getSummary($groupId, $fromsummary, $to);

            $data['all'] = sizeof($data['taskRecords']);
            $data['today'] = sizeof($data['todayTaskRecords']);


            if($role <= 3) 
                $data['users'] = $this->task_model->getUsers($groupId);
            else
                $data['users'] = $this->task_model->getUsers($groupId,$uid);

            // get customized fields
            $data['customfields'] = $this->task_model->getCustomFieldstoArray($groupId);

            $data['customfileds_head'] = array();
            foreach ($data['customfields'] as $key => $value) {
                $data['customfileds_head'][] = $key;
            }
            // print_r($data['customfields']);

            $this->global['pageTitle'] = 'Legal Report';
            $data['function'] = $this;

            $data['status'] = $status;

            if($data['all'] > 100) {//500
                $this->newTasklist((array)$data);
            } else {
                $this->loadViews("tasks", $this->global, $data, NULL);
            }
            
            
//        }
    }

    function newTasklist($data)
    {  
        $groupId = $this->global ['groupId'];
        $customfields = (array)$this->task_model->getCustomFieldstoArray($groupId);
        $empty_fields = array_fill_keys(array_keys($customfields),'');
        //die;
        
        $data_arr =  json_decode(json_encode($data['taskRecords']),true);
        $i=0;
        foreach ($data_arr as $list) {
            $addon = $empty_fields;
            if(!empty($list['addonstatus'])) {
                $real_fields = ((array)json_decode($list['addonstatus'])); 
                $addon = array_replace($empty_fields, $real_fields);
            }
            if($addon['caseDate'] !="" && $addon['caseCloseDate'] != "")
            {
                // $case_date_start = strtotime($addon['caseDate']);
                // $case_date_end = strtotime($addon['caseCloseDate']);
                // $diff = abs($case_date_end - $case_date_start);
                // echo $diff. " / ";

            } else {
                strtotime("now");
                $addon['casetimeliness'] = "";
            }

            foreach ($addon as $key => $value) {
                if(empty($value)) {
                    $data_arr[$i][$key] = "";
                } else{
                    $data_arr[$i][$key] = $value;
                }
            }
            $i++;
        }
        $rand = utf8_encode(time().mt_rand());
        $jsondata = json_encode(array("data"=>$data_arr));
        $data['jsondata'] = $jsondata;
        $data['rand'] = $rand;

        $fp = fopen('json/list-'.$rand.'.json', 'w');
        fwrite($fp, $jsondata);
        fclose($fp);


        
        $this->loadViews("bigtasks", $this->global, $data, NULL);
    }


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        $data['role'] = $this->global ['role'] = $this->role;

//        if($this->isAdmin() == TRUE || $this->global['role'] >2)
        if($this->global['role'] < 1)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('task_model');
            $data['roles'] = $this->task_model->getUserRoles();
            $data['groups'] = $this->task_model->getUserGroups();
            $this->global['pageTitle'] = 'CodeInsect : Add New Task';
            $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
            $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
            $data['group'] = $this->task_model->getGroups();
            $data['usergroup'] = $this->global ['groupId'];

            $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
            if(!empty($data['customfields']))
                $data['customfields'] = json_decode($data['customfields']->fields);

            $data['function'] = $this;
            $this->loadViews("addNewTask", $this->global, $data, NULL);
        }
    }

    function addNewBatch()
    {
        $data['role'] = $this->global ['role'] = $this->role;

//        if($this->isAdmin() == TRUE || $this->global['role'] >2)
        if($this->global['role'] < 1)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('task_model');
            $data['roles'] = $this->task_model->getUserRoles();
            $data['groups'] = $this->task_model->getUserGroups();
            $this->global['pageTitle'] = 'CodeInsect : Add New Task';
            $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
            $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
            $data['group'] = $this->task_model->getGroups();
            $data['usergroup'] = $this->global ['groupId'];

            $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
            if(!empty($data['customfields']))
                $data['customfields'] = json_decode($data['customfields']->fields);
            $data['function'] = $this;

            $this->loadViews("addNewTaskBatch", $this->global, $data, NULL);
        }
    }

    function addNewBatchModal()
    {
        $data['role'] = $this->global ['role'] = $this->role;
        if($this->global['role'] < 1)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('task_model');
            $data['roles'] = $this->task_model->getUserRoles();
            $data['groups'] = $this->task_model->getUserGroups();
            $this->global['pageTitle'] = 'CodeInsect : Add New Task';
            $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
            $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
            $data['group'] = $this->task_model->getGroups();
            $data['usergroup'] = $this->global ['groupId'];

            $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
            if(!empty($data['customfields']))
                $data['customfields'] = json_decode($data['customfields']->fields);
            $data['function'] = $this;

            $this->loadNormalViews("addNewTaskBatch", $this->global, $data, NULL);
        }
    }

    function edit($id)
    {
        $this->load->model('task_model');
        $data['taskRecords'] = $this->task_model->getTask($id);
        $this->global['pageTitle'] = 'CodeInsect : Edit Task';

        $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
        if(!empty($data['customfields']))
            $data['customfields'] = json_decode($data['customfields']->fields);

//        print_r($data['taskRecords']);

        $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
        $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
        $data['group'] = $this->task_model->getGroups();
        $data['id'] = $id;
        $data['usergroup'] = $this->global ['groupId'];
        $data['function'] = $this;
        $this->loadViews("addNewTask", $this->global, $data, NULL);

    }

    function view($id)
    {
        $this->load->model('task_model');
        $data['taskRecords'] = $this->task_model->getTask($id);
        $this->global['pageTitle'] = 'CodeInsect : Edit Task';

        $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
        // print_r($data['status'][3]);
        $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
        $data['group'] = $this->task_model->getGroups();
        $data['id'] = $id;
        $data['usergroup'] = $this->global ['groupId'];

        $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
        if(!empty($data['customfields']))
            $data['customfields'] = json_decode($data['customfields']->fields);

        $data['tasklog'] = $this->task_model->getTaskLog($id);

        $data['function'] = $this;

        $this->global['pageTitle'] = 'DHL Task Tracking : Task Adding..';

        $this->loadViews("viewTask", $this->global, $data, NULL);

    }

    function quickview($id)
    {
        
        $this->load->model('task_model');
        $data['taskRecords'] = $this->task_model->getTask($id);
        $this->global['pageTitle'] = '';

        $data['status'] = $this->task_model->getStatus($this->global ['groupId']);
        $data['cats'] = $this->task_model->getCaterories($this->global ['groupId']);
        $data['group'] = $this->task_model->getGroups();
        $data['role']= $this->global ['role'] = $this->role;
        $data['id'] = $id;
        $data['usergroup'] = $this->global ['groupId'];
        $data['customfields'] = $this->task_model->getCustomFields($this->global ['groupId']);
        if(!empty($data['customfields']))
            $data['customfields'] = json_decode($data['customfields']->fields);

        $data['tasklog'] = $this->task_model->getTaskLog($id);

        $data['function'] = $this;

        $this->global['pageTitle'] = 'DHL Task Tracking : Task Adding..';

        $this->loadNormalViews("viewUpdateTask", $this->global, $data, NULL);

    }

    public function getUsers() {
        $this->load->model('task_model');
        // $users = $this->task_model->getUsers();
        $groupId = $this->global ['groupId'];
        $groupName = $this->global ['groupName'];

        $uid = $this->global ['id'];
        $role = $this->global ['role'] = $this->role;

        if($role <= 3) 
            $users = $this->task_model->getUsers($groupId);
        else
            $users = $this->task_model->getUsers($groupId,$uid);
        echo json_encode($users);
    }


    public function getUserById($id) {
        $this->load->model('task_model');
        $user = $this->task_model->getUserById($id);
        echo $user;
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    function addNewTask($mode = "")
    {
        $this->load->model('task_model');
        $input = $this->input->post();

        if(empty($input['group'])) {
            $input['group'] = $this->global ['role'];
        }

        if($mode == "batch") {
            $titles = $input['title'];
            $newTask = array(
                'description' => $input['description'],
                'description' => $input['description'],
                'category' => $input['cats'],
                'status' => $input['status'],
                'group' => $input['group'],
                'assigned_to' => $input['UserId'],
                'assigned_by' => $this->global ['id'],
                'comment' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'addonstatus' =>  json_encode($input['custom']),
            );

            if($this->role == 4) {
                $newTask['assigned_to'] = $this->global ['id'];
                $newTask['assigned_by'] = $this->global ['id'];
            }

            if(empty($newTask['assigned_to'])) {
                $newTask['assigned_to'] = $this->global ['id'];
            }

            $addedlist = array();
            $titleArray = explode(PHP_EOL, $titles);

            foreach ($titleArray as $title) {
                if(!empty($title)) {
                    $newTask['title'] = $title;
                    $checkdup = $this->checkDuplicate($title);
                    if($checkdup > 0) {
                        $addedlist['duplicate'][$title] = $checkdup;
                    } else {

                        $result = $this->task_model->addNewTask($newTask);
                        $addedlist['success'][$title] = $checkdup;
                        if($result > 0)
                        {
                            // add description as a log
                            $newLog = array(
                                'detail' => $input['description'],
                                'taskId' => $result,
                                'created_at' => date('Y-m-d H:i:s'),
                                'logged_by' => $this->global ['id'],
                            );

                            $result = $this->task_model->addTaskLog($newLog);
                            $this->session->set_flashdata('success', 'New Task created successfully');
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Task creation failed');
                        }
                    }
                }
            }
            // $dupQueryString.= urlencode(json_encode($addedlist));
            // print_r($dupQueryString); die;
        // $this->close_windows();

        } else {
            
            $newTask = array(
                'title' => $input['title'],
                'description' => $input['description'],
                'description' => $input['description'],
                'category' => $input['cats'],
                'status' => $input['status'],
                'group' => $input['group'],
                'assigned_to' => $input['UserId'],
                'assigned_by' => $this->global ['id'],
                'comment' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'last_updated' => date('Y-m-d H:i:s'),
                'addonstatus' =>  json_encode($input['custom']),
            );

            if($this->role == 4) {
                $newTask['assigned_to'] = $this->global ['id'];
                $newTask['assigned_by'] = $this->global ['id'];
            }

            $result = $this->task_model->addNewTask($newTask);

            if($result > 0)
            {
                // add description as a log
                $newLog = array(
                'detail' => $input['description'],
                'taskId' => $result,
                'created_at' => date('Y-m-d H:i:s'),
                'logged_by' => $this->global ['id'],
                );

                $result = $this->task_model->addTaskLog($newLog);


                $this->session->set_flashdata('success', 'New Task created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Task creation failed');
            }
        }
        $this->taskListing('','','','',$addedlist);
        // redirect(base_url().'dashboard');
        // echo "<script>$('#myModal').modal('hide')</script>";

    }

    function checkDuplicate($title)
    {
        $where = array('title'=>$title);
        $result = $this->task_model->checkDup($where);
        if(empty($result)) {
            return 0;
        } else {
            return $result[0]->id; 
        }
    }

    
    /**
     * This function is used to edit the user information
     */
    function editTask()
    {

        $this->load->library('form_validation');

        $taskId = $this->input->post('taskId');


        $input = $this->input->post();

        if(!empty($input['title'])) {
            $info['title'] = $input['title'];
        }
        $info = array(
            // 'description' => $input['description'],
            'category' => $input['cats'],
            'status' => $input['status'],
            // 'group' => $input['group'],
            // 'assigned_to' => $input['UserId'],
            'assigned_by' => $this->global ['id'],
            'comment' => '',
            'last_updated' => date('Y-m-d H:i:s'),
            'addonstatus' =>  json_encode($input['custom']),
        );

        if(!empty($input['description'])) {
            $info['description'] = $input['description'];
        }

        if(!empty($input['group'])) {
            $info['group'] = $input['group'];
        }

        if(!empty($input['UserId'])) {
            $info['assigned_to'] = $input['UserId'];
        }

        $result = $this->task_model->editTask($taskId, $info);
        $editedlist['edited'] = array($taskId=>$info['title']);

        if($result == true)
        {

            $text = "";
            foreach ($info as $key => $value) {
                if($key != "addonstatus") {
                    $text .= " [".$key."] = ".$value .", ";
                } else {
                    $array_json = json_decode($value);
                    foreach ($array_json as $key => $value) {
                        $text .= " [".$key."] = ".$value .", ";
                    }
                }
            }
            $newLog = array(
                'detail' => $this->global ['name'] . " - ได้ทำการแก้ไข". $text ,
                'taskId' => $taskId,
                'created_at' => date('Y-m-d H:i:s'),
                'logged_by' => $this->global ['id'],
            );

            $result = $this->task_model->addTaskLog($newLog);
            $loginfo2 = array(
                    'description' => $input['description'],
                );
                
        $this->addTaskLog($taskId, $loginfo2);

            $this->session->set_flashdata('success', 'Task updated successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'Task updation failed');
        }
        // redirect('taskListing?updated='.$taskId);
        // $this->close_windows();
        $this->taskListing('','','','',$editedlist);
    }

    function assignTask($id,$user)
    {

        $this->load->library('form_validation');

        $input = $this->input->post();
        $info = array(
            'assigned_to' => $user,
            'last_updated' => date('Y-m-d H:i:s')
        );

        $result = $this->task_model->editTask($id, $info);

        if($result == true)
        {
            echo true;
        }
        else
        {
            echo false;
        }

        
    }

    function editCustomTask() 
    {
        $this->load->library('form_validation');

        $taskId = $this->input->post('taskId');

        $input = $this->input->post();
        $info = array(
            'last_updated' => date('Y-m-d H:i:s'),
            'addonstatus' =>  json_encode($input['custom']),
        );

        $result = $this->task_model->editTask($taskId, $info);

        if($result == true)
        {
            $this->session->set_flashdata('success', 'Task updated successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'Task updation failed');
        }

        redirect('taskListing?updated='.$taskId);
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTask()
    {

        if(FALSE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $taskId = $this->input->post('taskId');
            $info = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'last_updated'=>date('Y-m-d H:i:s'));
            $result = $this->task_model->deleteTask($taskId, $info);
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function addTaskLog($taskid, $info = array())
    {
        $this->load->model('task_model');
        $input = $this->input->post();

        // if($input['status'] != $input['oldstatus']) {
        //     $input['description']= $this->global ['name'] . " - ได้ทำการแก้ไขเปลี่ยน Status". " / ข้อความ : ". $input['description'];

        //     $info = array(
        //         'status' => $input['status'],
        //         'last_updated' => date('Y-m-d H:i:s'),
        //     );

        //     $result_updatetask = $this->task_model->editTask($taskid, $info);
        // }

        $newLog = array(
            'detail' => $input['description'],
            'taskId' => $taskid,
            'created_at' => date('Y-m-d H:i:s'),
            'logged_by' => $this->global ['id'],
        );

        $result = $this->task_model->addTaskLog($newLog);

        // ADD Last Log To Description
        $info = array(
            'description' => $input['description'],
        );

        $result = $this->task_model->editTask($taskid, $info);



        if($result > 0)
        {
            $this->session->set_flashdata('success', 'New Task Log created successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'Task Log creation failed');
        }

        redirect('tasks/');
        // $this->close_windows();
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'CodeInsect : Change Password';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }


    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    public function dashboard($group = '') 
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        $data['allcount'] = $this->dashboardAllTask();
        
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }

            

    public function dashboardAllTask($group = '')
    {
        if(empty($group))
            $group[] = $this->global['groupId'];

        $size = array();
        foreach ($group as $g) {
            $all = $this->task_model->taskCounting($g,'', $custom ='');
            $finished = $this->task_model->taskCounting($g,'', $custom = array('isDone =' => 1));
            $remain = $this->task_model->taskCounting($g,'', $custom = array('isDone =' => 0));

            $groupName = $this->task_model->getGroups($g);
            
            $size[$g] = array('group'=>$groupName[0]->group_name_TH, 'count'=>sizeof($all), 'finished' => sizeof($finished), 'remain' => sizeof($remain));
        }
        
        return json_encode($size);
    }
    
    public function reportExcelMonthly(){
        
        function number($s,$cal=false){
            $s = trim(str_replace(array(',','บาท'),'',$s));
            if (!empty($s) && $s != '-'){
                if ($cal == false){
                    if (is_numeric($s)){
                        $s = number_format($s,2);
                    }else{
                        //$s = 0.99;
                    }
                }else{
                    $s = $s*1;
                }
            }else{
                $s = '';
            }
            return $s;
        }
        function thmonth($n){
            $months =array(
              1=>'มกราคม',
                'กุมภาพันธ์',
                'มีนาคม',
                'เมษายน',
                'พฤษภาคม',
                'มิถุนายน',
                'กรกฎาคม',
                'สิงหาคม',
                'กันยายน',
                'ตุลาคม',
                'พฤศจิกายน',
                'ธันวาคม',
            );
            $n=$n*1;
            return isset($months[$n])?$months[$n]:'';
        }
        
        $year = $_GET['year'];
        $month = $_GET['month'];
        $cat = $_GET['cat'];
        $groupId = $this->global ['groupId'];
        $rows = $this->task_model->getExcelMonthlyTask($groupId,$year,$month);
		#var_dump($rows);die;
		##echo $this->db->last_query();
		#die;
        $h = array(
            'Month','เลขที่เช็ค','วันที่เช็ค','HAWB','เลขที่ใบขน','จำนวนเงิน','รวม',//7cols
            //'ภาษีเพิ่มเก็บลูกค้า','ภาษีเพิ่ม DHL จ่าย Absorb','ค่าปรับ DHL จ่าย Absorb','ค่าปรับเก็บลูกค้า',//4cols
            'ยอดเงินค่าปรับ','ค่าปรับชำระโดย','ยอดเงินค่าภาษี','ค่าภาษีจ่ายโดย',//4cols
        );
        $d = array();//$d[created_at][dutyChequeNo]
        #echo '<pre>';
        #var_dump($rows);
        #echo '</pre>';
        foreach($rows as $k=>$row){
            if (!empty($row->addonstatus)){
                $decode = json_decode($row->addonstatus,true);
                foreach($decode as $field=>$val){
                    $row->$field = $rows[$k]->$field = $val;
                }
                unset($row->addonstatus);
            }
            $r = clone $row;

            $chequeNo = $r->chequeNo;
            if (!empty($chequeNo) && $chequeNo != '-'){
                if (empty($d[$chequeNo])){
                    $d[$chequeNo]=array();
                }
                $r->chequeType = 1;
                $d[$chequeNo][] = $r;
            }

            $r = clone $row;
            $dutyChequeNo = $r->dutyChequeNo;
            if (!empty($dutyChequeNo) && $dutyChequeNo != '-'){
                if (empty($d[$dutyChequeNo])){
                    $d[$dutyChequeNo]=array();
                }
                $r->chequeType = 2;
                $d[$dutyChequeNo][] = $r;
            }

        }
        #var_dump($d);die;
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);        
        require APPPATH . 'third_party/Classes/PHPExcel.php';
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="file.xlsx"');
        $objPHPExcel = new PHPExcel();

        $title1 = "ปิดบัญชีงานคดี เดือน ".thmonth($month).' '.($year+543);
        $title2 = ' ค่าปรับ Cat';
        $title = $title1.' '.$title2;
        
        $objPHPExcel->getProperties()->setCreator("Website")
                    ->setLastModifiedBy("Website")
                    ->setTitle($title)
                    ->setSubject($title)
                    ->setCategory("report");


        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B1', $title1)
                    ->setCellValue('F1', $title2);
        
        $n = 4;
        $s = $objPHPExcel->setActiveSheetIndex(0);            
        $s->setCellValue('B1', $title1)
                ->setCellValue('F1', $title2);        
        //$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);

      $colnames = array(
            'A','B','C','D','E','F','G','H','I','J','K',
        );
        foreach($h as $k=>$i){
            $s->setCellValue($colnames[$k].'3',$i);
        }
        $s->getStyle('A3:K3')->getAlignment()->setWrapText(true);
        $s->getColumnDimension('B')->setWidth(10);
        $s->getColumnDimension('C')->setWidth(14);
        $s->getColumnDimension('D')->setWidth(12);
        $s->getColumnDimension('E')->setWidth(18);
        $s->getColumnDimension('F')->setWidth(10);
        

        $yearMonth = date('M',strtotime('2018-'.$month.-'1')).'-'.(substr($year,-2));

        foreach($d as $cheque=>$cheque_rows){
            $cheque_rows_size = count($cheque_rows);
            $sum = 0;
            $first_n = $n;
            foreach($cheque_rows as $i=>$row){
                #$amount = $row->chequeType==1?$row->amount:$row->dutyAmount;
                $amount = 0;
                $chequeDate = $row->chequeType==1?$row->chequeDate:$row->dutyChequeDate;

                $s->setCellValue('A'.$n,$yearMonth);
                $s->setCellValue('B'.$n,$i==0?$cheque:'');
                $s->setCellValue('C'.$n,$i==0?$chequeDate:'');
                $s->setCellValue('D'.$n,$row->title);
                $s->setCellValue('E'.$n,$row->refNo);
                $s->setCellValue('F'.$n,0);
                $s->getStyle('B'.$n)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                $s->getStyle('D'.$n)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                $s->getStyle('E'.$n)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                if ($cheque_rows_size == 0){
                    $s->setCellValue('G'.$n,'=(F'.$n.')');
                }else{
                    //$sum += number($amount,true);
                }
                if ($row->paidby == '0'){
                    $paidby = '';
                }else{
                    $paidby = $row->paidby;
                }
                if ($row->dutyPaidby == '0'){
                    $dutyPaidby = '';
                }else{
                    $dutyPaidby = $row->dutyPaidby;
                }
                $s->setCellValue('H'.$n,number($row->amount));
                $s->setCellValue('I'.$n,$paidby);
                $s->setCellValue('J'.$n,number($row->dutyAmount));
                $s->setCellValue('K'.$n,$dutyPaidby);
                $n++;
            }
            if ($cheque_rows_size > 0){
                    $s->setCellValue('A'.$n,$yearMonth);
                    $s->setCellValue('G'.$n,'=SUM(F'.($first_n).':F'.($n-1).')');
                $n++;
            }
        }
#echo $n;die;
        $objPHPExcel->getActiveSheet()->setTitle('Report');

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }


    function reportMonthly($year='', $month='')
    {
        $groupId = $this->global ['groupId'];
        $data['result'] = $this->task_model->getMonthlyTask('',$groupId,$year,$month);
        // print_r($data['result']);
        $data['mo'] = $month;
        $data['year'] = $year;

        $data['member'] = $this->task_model->getUsers($groupId);



        $this->load->view("mo-report",$data);
    }



    function report($group='',$timestart='',$timeend='',$filter='')
    {
//        if($this->isAdmin() == TRUE)
//        {
//            $this->loadThis();
//        }
//        else
//        {
        $this->load->model('task_model');
        $groupId = $this->global ['groupId'];

        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d H:i:s');

        if(empty($timestart)) {
            $timestart = date('Y-m-d 00:00:00', strtotime('-7 days'));
        } else {
            $timestart = date_create_from_format('YmdHi', $timestart);
            $timestart = $timestart->format('Y-m-d H:i:s');
        }

        if(empty($timeend)) {
            $timeend = date('Y-m-d 23:59:59');
        } else {
            $timeend = date_create_from_format('YmdHi', $timeend);
            $timeend = $timeend->format('Y-m-d H:i:s');            
        }

        if(empty($group)) {
            $group = $groupId;
        }

        $filters = '';
        if(!empty($filter))
            $filters = explode("-", $filter);

        $data['result'] = $this->task_model->genReport($group,$timestart,$timeend,$filters);

        $data['timestart'] = $this->task_model->genReport($group);
        $data['timeend'] = $this->task_model->genReport($group);

        

        $datahead['users'] = $this->task_model->getUsers($groupId);
        $datahead['status'] = $this->task_model->getStatus($this->global ['groupId']);
        $datahead['groupId'] = $groupId;

        $this->global['pageTitle'] = 'DHL Task Tracking : Report';

        $this->loadReportViews("report", $this->global, $data, NULL, $datahead);

    }

    function showKey($key, $group = 0) {
        $translate = array(
            'Agent' => 'ชื่อเจ้าหน้าที่',
            'shift' => 'กะ',
            'consignee' => 'ชื่อลูกค้า',
            'refNo' => 'เลขที่ใบขน',
            'chequeNo' => 'เลขที่เช็คค่าปรับ',
            'chequeDate' => 'วันที่เช็คค่าปรับ',
            'chequeStatus' => 'สถานะเช็ค',
            'causesOld' => 'สาเหตุเก่า',
            'causes' => 'สาเหตุใหม่',
            'Assign' => 'จ่ายงานให้กับ',
            'amount' => 'ยอดเงินค่าปรับ',
            'othercause' => 'สาเหตุอื่นๆ (ถ้ามี)',
            'caseNo' => 'เลขที่แฟ้มคดี',
            'caseDate' => 'วันที่เปิดแฟ้มคดี',
            'caseCloseDate' => 'วันที่ปิดแฟ้มคดี',
            'paidby' => 'ค่าปรับชำระโดย',
            'dutyChequeNo' => 'เลขที่เช็คค่าภาษี',
            'dutyChequeDate' => 'วันที่เช็คค่าภาษี',
            'dutyChequeStatus' => 'สถานะเช็ค',
            'dutyAmount' => 'ยอดเงินค่าภาษี',
            'dutyPaidby' => 'ค่าภาษีจ่ายโดย',
            'preCaseNo' => 'เลขที่ลงรับ',
            'preCaseDate' => 'วันที่ลงรับ',
            'preCaseCloseDate' => 'วันที่ปิดเลขลงรับ',
            'importDate' => 'วันนำเข้า',
            'oldtariff' => 'พิกัดเก่า (กรณีผิดพิกัด)',
            'newtariff' => 'พิกัดใหม่ (กรณีผิดพิกัด)',
            'oldrate' => 'อัตราเก่า (กรณีผิดอัตรา)',
            'newrate' => 'อัตราใหม่ (กรณีผิดอัตรา)',
            'investigateBy' => 'Investigate by',
            'remarkBy' => 'Remark by',
            );
        if(isset($translate[$key]))
            $text = $translate[$key];
        else $text = $key;
        return $text;
    }

    function close_windows(){
        echo  "<script type='text/javascript'>";
        echo  "opener.location.reload();";
        echo "window.close();";
        echo "</script>";

    }

    // Connect API
    function netbayApi_getShipment($hwb = '') {
        $shipmentinfo = $this->updateDb($hwb);
        if(!empty($shipmentinfo)) {
            print_r(json_encode($shipmentinfo));
        } else {
            print_r(json_encode(array()));
        }
        
    }



    function updateDb($hwb) {
        $query = $this->db->get_where('netbay_import', array('hawb' => $hwb));
        if(!empty($query->result())) {
            return ($query->result()[0]);
        } else {
            $data = $this->getShipmentFormNbApi($hwb);
            if(empty($data)) {
                return (Object)array();
            } else 
                $data['cat'] = 'Formal';

                // $this->db->where('hawb', $hwb);
                $this->db->set($data); 
                $this->db->insert('netbay_import'); 

                return ((Object)$data); 
        }
    }

    function getShipmentFormNbApi($hwb = '') {
        $url = 'http://23.168.85.150:8081/netbayconnect/index.php/api/getShipment/'.$hwb;
        $resp = $this->curlApt($url);

        $arr_data = json_decode($resp);

        if(!empty($arr_data)) {

            $mapping = array(
                'netbay_id'  => $arr_data[0]->ImDclCtrl,
                'hawb'  => $arr_data[0]->houseBillOfLanding,
                'vessel'  => $arr_data[0]->vesselName,
                'mawb'  => $arr_data[0]->masterBillOfLanding,
                'arrivalDate'  => $arr_data[0]->arrivalDate,
                'declarationRef'    =>  $arr_data[0]->referenceNo,
                'declarationDate'   =>  $arr_data[0]->referenceDate,
                'company_name_e'    =>  $arr_data[0]->companyEnglishName,
                'company_address_e'    =>  $arr_data[0]->streetAndNumber ." ".$arr_data[0]->subProvince." ".$arr_data[0]->province." ".$arr_data[0]->postCode,
                'company_detail1'    =>  $arr_data[0]->companyDetail1,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,

            );

            // print_r($mapping);
            // print_r($arr_data[0]);
            return $mapping;
        } else 
            return array();
    }

    function getDashboard(
        $group = '', 
        $role = '', 
        $uid = '', 
        $uname = '',
        $params = array()
        )
    {

        $this->load->model('task_model');


        $group = empty($group)?$this->global['groupId']:$group;
        $role = empty($role)?$this->role:$role;
        $uid = empty($uid)?$this->global ['id']:$uid;
        $uname = empty($uname)?$this->global ['name']:$uname;

        $data = array(
            'alltotal' => 0,
            'allpending' => 0,
            'alldone' => 0,
            'alloverdue' => 0,
            'allnewest' => '',
            
            'mytotal' => 0,
            'mypending' => 0,
            'mydone' => 0,
            'myoverdue' => 0,
            'mynewest' => '',

            'myname' => $uname
            );

        $data['alltotal'] = $this->task_model->dashboard(array('group' => $group))[0]->rs;
        $data['allpending'] = $this->task_model->dashboard(
            array('group' => $group), 
            array(
                'status'=>array(3,4)
                ))[0]->rs;

        $data['alldone'] = $data['alltotal']-$data['allpending'];
        $data['alloverdue'] = 0;
        $data['allnewest'] = $this->task_model->latest(array('group' => $group))[0];


        print_r(json_encode($data));



    }




    function curlApt($url = '') {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }



    function testTaskListing($offset = '', $from ='', $to = '')
    {
//        if($this->isAdmin() == TRUE)
//        {
//            $this->loadThis();
//        }
//        else
//        {
            $this->load->model('task_model');

            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');

            $groupId = $this->global ['groupId'];
            $groupName = $this->global ['groupName'];

            $uid = $this->global ['id'];
            $role = $this->global ['role'] = $this->role;

            $tasks = $this->input->get('task');
            $criterias = "";
            if(!empty($tasks)) {
                if($tasks == 'done')
                $criterias = array(
                                'isDone =' => 1,
                );
                else if($tasks == 'remain')
                    $criterias = array(
                                'isDone =' => 0,
                );
                else if($tasks == 'showall') {

                }

            }

            // $count = $this->task_model->taskListingCount($searchText,$groupId);

            if($role == 1) {
                $count = $this->task_model->taskListingCount($searchText,'','','',$criterias);
            } else if($role <= 3) {
                $count = $this->task_model->taskListingCount($searchText,'','',$groupId,$criterias);
            } else {
                $count = $this->task_model->taskListingCount($searchText,$uid,'',$groupId,$criterias);        
            }



            $returns = $this->paginationCompress( "tasks/", $count, 5000 );
            $data['filter'] = array();
            if(!empty($from) && !empty($to)) {
                $data['filter']['from'] = $from;
                $data['filter']['to'] = $to;
                $criterias = 'DATE(Tasks.created_at) BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"';
            }



            if($role == 1) {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'','','',$criterias);
                $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,'','',$criterias);
            } else if($role <= 3 || $tasks == "showall") {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'','',$groupId,$criterias,'no');
                // $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,'',$groupId,$criterias);
                $data['todayTaskRecords'] = "";
            } else {
                $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],'',$uid,$groupId,$criterias);

                // $data['todayTaskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"],$curr_date,$uid,$groupId,$criterias);

                $data['todayTaskRecords'] = "";
            }

            $data['all'] = sizeof($data['taskRecords']);
            $data['today'] = sizeof($data['todayTaskRecords']);

            if($role <= 3) 
                $data['users'] = $this->task_model->getUsers($groupId);
            else
                $data['users'] = $this->task_model->getUsers($groupId,$uid);

            // get customized fields
            $data['customfields'] = $this->task_model->getCustomFieldstoArray($groupId);

            $data['customfileds_head'] = array();
            foreach ($data['customfields'] as $key => $value) {
                $data['customfileds_head'][] = $key;
            }
            // print_r($data['customfields']);

            $this->global['pageTitle'] = 'Legal Report';
            $data['function'] = $this;

            // $this->output->cache(60);
            $data['status'] = '';
            
            $this->loadViews("testtasks", $this->global, $data, NULL);
//        }
    }





}

?>