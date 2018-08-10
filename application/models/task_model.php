<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    // function taskListingCount($searchText = '', $uid = '', $groupId = '')
    // {
    //     $this->db->select('*, Cats.name as cat_name, AssignedUser.name as assigned, AssignerUser.name as assigner');
    //     $this->db->from('dhl_tasks as Tasks');
    //     $this->db->join('tbl_users as AssignedUser', 'AssignedUser.userId = Tasks.assigned_to','left');
    //     $this->db->join('tbl_users as AssignerUser', 'AssignerUser.userId = Tasks.assigned_by','left');
    //     $this->db->join('dhl_cats as Cats', 'Tasks.category = Cats.categoryId','left');
    //     $this->db->join('dhl_status as Status', 'Tasks.status = Status.statusId','left');
    //     if(!empty($searchText)) {
    //         $likeCriteria = "(Tasks.title  LIKE '%".$searchText."%'
    //                         OR  Tasks.description  LIKE '%".$searchText."%'
    //                         OR  AssignedUser.name  LIKE '%".$searchText."%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     $this->db->where('Tasks.isDeleted', 0);
    //     if(!empty($uid)) {
    //         $this->db->where('Tasks.assigned_to', $uid);
    //     }

    //     if(!empty($groupId)) {
    //         $this->db->where('Tasks.group', $groupId);
    //     }
    //     $query = $this->db->get();

    //     return count($query->result());
    // }


    function taskListingCount($searchText = '', $date = '', $uid = '', $groupId = '', $criterias = '')
    {
        $this->db->select('*, Cats.name as cat_name, AssignedUser.name as assigned, AssignerUser.name as assigner');
        $this->db->from('dhl_tasks as Tasks');
        $this->db->join('tbl_users as AssignedUser', 'AssignedUser.userId = Tasks.assigned_to','left');
        $this->db->join('tbl_users as AssignerUser', 'AssignerUser.userId = Tasks.assigned_by','left');
        $this->db->join('dhl_cats as Cats', 'Tasks.category = Cats.categoryId','left');
        $this->db->join('dhl_status as Status', 'Tasks.status = Status.statusId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Tasks.title  LIKE '%".$searchText."%'
                            OR  Tasks.description  LIKE '%".$searchText."%'
                            OR  AssignedUser.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        if(!empty($date)) {
            $this->db->where('DATE(Tasks.created_at)',$date);
        }

        if(!empty($uid)) {
            $this->db->where('Tasks.assigned_to', $uid);
        }

        if(!empty($groupId)) {
            $this->db->where('Tasks.group', $groupId);
        }

        if(is_array($criterias)) {
            $this->db->where($criterias);
        }

        $this->db->where('Tasks.isDeleted', 0);
        $this->db->where('Tasks.status !=', 13);



        $query = $this->db->get();

        return count($query->result());
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function taskListing($searchText = '', $page, $segment, $date = '', $uid = '', $groupId = '', $criterias = '',$limit = 500)
    {

        $this->db->select('*, Cats.name as cat_name, AssignedUser.name as assigned, AssignerUser.name as assigner');
        $this->db->from('dhl_tasks as Tasks');
        $this->db->join('tbl_users as AssignedUser', 'AssignedUser.userId = Tasks.assigned_to','left');
        $this->db->join('tbl_users as AssignerUser', 'AssignerUser.userId = Tasks.assigned_by','left');
        $this->db->join('dhl_cats as Cats', 'Tasks.category = Cats.categoryId','left');
        $this->db->join('dhl_status as Status', 'Tasks.status = Status.statusId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Tasks.title  LIKE '%".$searchText."%'
                            OR  Tasks.description  LIKE '%".$searchText."%'
                            OR  AssignedUser.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        if(!empty($date)) {
            $this->db->where('DATE(Tasks.created_at)',$date);
        }

        if(!empty($uid)) {
            $this->db->where('Tasks.assigned_to', $uid);
        }

        if(!empty($groupId)) {
            $this->db->where('Tasks.group', $groupId);
        }


        if(is_array($criterias) || !empty($criterias)) {
            $this->db->where($criterias);
        }

        $this->db->where('Tasks.isDeleted', 0);
        $this->db->where('Tasks.status !=', 13);

//        $this->db->where('BaseTbl.roleId !=', 1);
        if($limit != 'no') {
            $this->db->limit(200);
            $this->db->order_by('Tasks.id');
        }

        $this->db->order_by('Tasks.created_at','desc');
        
        $query = $this->db->get();

        $result = $query->result();
        // echo $this->db->last_query();

        return $result;
    }

    function taskCounting($group = '', $status ='' , $custom ='')
    {
        $this->db->select('*, Cats.name as cat_name');
        $this->db->from('dhl_tasks as Tasks');
        $this->db->join('dhl_cats as Cats', 'Tasks.category = Cats.categoryId','left');
        $this->db->join('dhl_status as Status', 'Tasks.status = Status.statusId','left');

        if(!empty($group)) {
            $this->db->where('Tasks.group', $group);
        }

        if(!empty($status)) {
            $this->db->where('Status.statusId', $status);
        }

        if(!empty($custom)) {
            $this->db->where($custom);
        }

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }


    function getTask($id = '',$group='',$start='',$end = '')
    {

        $this->db->select('*, Cats.name as cat_name, AssignedUser.name as assigned, AssignerUser.name as assigner, Groups.id as groupId, Groups.group_name_TH as groupName');
        $this->db->from('dhl_tasks as Tasks');
        $this->db->join('tbl_users as AssignedUser', 'AssignedUser.userId = Tasks.assigned_to','left');
        $this->db->join('tbl_users as AssignerUser', 'AssignerUser.userId = Tasks.assigned_by','left');
        $this->db->join('dhl_cats as Cats', 'Tasks.category = Cats.categoryId','left');
        $this->db->join('dhl_status as Status', 'Tasks.status = Status.statusId','left');
        $this->db->join('dhl_group as Groups', 'Tasks.group = Groups.id','left');

        if(!empty($id)) {
            $this->db->where('Tasks.id', $id);
        }


        if(!empty($group)) {
            $this->db->where('Tasks.group', $group);
        }

        if(!empty($start)) {
            $this->db->where('Tasks.created_at >=', $start);
            $this->db->where('Tasks.created_at <=', $end);
        }

        $this->db->where('Tasks.isDeleted', 0);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function checkDup($criteria)
    {
        $this->db->select('*');
        $this->db->from('dhl_tasks as Tasks');
        $this->db->where($criteria);
        $this->db->where('Tasks.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getSummary($group='', $start = '', $end = '')
    {
        if($group == 2) {  
            // --- count status ---

            if(empty($start)) {
                $start = date('Y-m-d',strtotime(("-365 day")));
            }

            if(empty($end)) {
                $end = date('Y-m-d');
            }

           $criterias = 'DATE(Tasks.created_at) BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($end)).'"';


           $this->db->select('count(*) as total,
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS "Open",
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS "Pending",
                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS "Closed",
                    SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS "RLSE",
                    SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS "PassCQL",
                    SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS "ChangeRef",
                    SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS "WaitAgent",

                    SUM(CASE WHEN status = 14 THEN 1 ELSE 0 END) AS "PassJPV",
                    SUM(CASE WHEN status = 15 THEN 1 ELSE 0 END) AS "WaitCustomer",
                    SUM(CASE WHEN status = 16 THEN 1 ELSE 0 END) AS "PassEASY",
                ');

            $this->db->from('dhl_tasks as Tasks');
            if(!empty($group))
                $this->db->where('Tasks.group', $group);

            // if(is_array($criterias)) {
            $this->db->where($criterias);
            // }
            $this->db->where('Tasks.isDeleted', 0);
            $this->db->where('Tasks.status !=', 13);

            $query = $this->db->get();

            return $query->result();


        } else
            return array(
                (object)array(
                    'total'=>'',
                    'Open'=>'','Pending'=>'','Closed'=>'','RLSE'=>'',
                    'PassCQL'=>'','ChangeRef'=>'','WaitAgent'=>'',
                    'PassJPV'=>'','WaitCustomer'=>'','PassEASY'=>'',
                )
            );
    }

    function getExcelMonthlyTask($group='',$year='',$month = ''){
        if($group == 2) {
            $this->db->select('Tasks.*');

            $this->db->from('dhl_tasks as Tasks');
            if(!empty($group))
                $this->db->where('Tasks.group', $group);
            //$this->db->like('Tasks.addonstatus', 'CAT":"3');
            if(!empty($month) && !empty($year)) 
                $this->db->like('Tasks.addonstatus', 'hequeDate":"'.$year.'-'.$month);
            $this->db->where('Tasks.isDeleted', 0);
            $this->db->where('Tasks.status !=', 13);
            $query = $this->db->get();

            return $query->result();
        }
    }
    
    function getMonthlyTask($id = '',$group='',$year='',$month = '')
    {
        if($group == 2) {
            $this->db->select('count(*) as total,
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS "Open",
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS "Pending",
                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS "Closed",
                    SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS "RLSE",
                    SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS "PassCQL",
                    SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS "ChangeRef",
                    SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS "WaitAgent",

                    SUM(CASE WHEN status = 14 THEN 1 ELSE 0 END) AS "PassJPV",
                    SUM(CASE WHEN status = 15 THEN 1 ELSE 0 END) AS "WaitCustomer",
                    SUM(CASE WHEN status = 16 THEN 1 ELSE 0 END) AS "PassEASY",
                ');

            $this->db->from('dhl_tasks as Tasks');
            if(!empty($group))
                $this->db->where('Tasks.group', $group);
            if(!empty($year)) 
                $this->db->like('Tasks.created_at', $year);
            if(!empty($month)) 
                $this->db->like('Tasks.created_at', $year."-".$month);
            $this->db->where('Tasks.isDeleted', 0);
            $this->db->where('Tasks.status !=', 13);

            $query = $this->db->get();

            $result['all'] = $query->result();

            // -------------------

            $this->db->select('count(*) as total,
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS "Open",
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS "Pending",
                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS "Closed",
                    SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS "RLSE",
                    SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS "PassCQL",
                    SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS "ChangeRef",
                    SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS "WaitAgent",

                    SUM(CASE WHEN status = 14 THEN 1 ELSE 0 END) AS "PassJPV",
                    SUM(CASE WHEN status = 15 THEN 1 ELSE 0 END) AS "WaitCustomer",
                    SUM(CASE WHEN status = 16 THEN 1 ELSE 0 END) AS "PassEASY",
                ');

            $this->db->from('dhl_tasks as Tasks');
            if(!empty($group))
                $this->db->where('Tasks.group', $group);
            if(!empty($year)) 
                $this->db->like('Tasks.created_at', $year);
            if(!empty($month)) 
                $this->db->like('Tasks.created_at', $year);
            $this->db->where('Tasks.isDeleted', 0);
            $this->db->where('Tasks.status !=', 13);

            $query = $this->db->get();

            $result['year'] = $query->result();


            // ------------- Tasks by user ------------
            $usertasks = $this->db->query('SELECT tbl_users.name AS name, Count(dhl_tasks.id) AS Total,
                    SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS "RLSE",
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS "Open",
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS "Pending",
                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS "Closed",
                    SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS "PassCQL",
                    SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS "ChangeRef",
                    SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS "WaitAgent",

                    SUM(CASE WHEN status = 14 THEN 1 ELSE 0 END) AS "PassJPV",
                    SUM(CASE WHEN status = 15 THEN 1 ELSE 0 END) AS "WaitCustomer",
                    SUM(CASE WHEN status = 16 THEN 1 ELSE 0 END) AS "PassEASY"
                FROM
                dhl_tasks
                Inner Join dhl_status ON dhl_tasks.status = dhl_status.statusId
                Inner Join tbl_users ON dhl_tasks.assigned_to = tbl_users.userId
                WHERE dhl_status.statusId != 13 AND
                dhl_tasks.group =  2 AND
                dhl_tasks.created_at like '.'"%'.$year.'-'.$month.'%"'.'
                GROUP BY
                 tbl_users.userId
                ORDER BY
                 Total DESC');

            $result['userstatus'] = $usertasks->result();

            return $result;
        }
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function getUserGroups()
    {
        $this->db->select('*');
        $this->db->from('dhl_group');
//        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function getStatus($groupId)
    {
        $this->db->select("*");
        $this->db->from("dhl_status");
        $this->db->where("statusGroup", $groupId);
        $this->db->where("isDeleted", 0);
//        if($userId != 0){
//            $this->db->where("userId !=", $userId);
//        }
        $this->db->order_by("ordering","asc");
        $query = $this->db->get();

        return $query->result();
    }

    function getCaterories($groupId)
    {
        $this->db->select("*");
        $this->db->from("dhl_cats");
        $this->db->where("groupId", $groupId);
        $this->db->where("isDeleted", 0);
//        if($userId != 0){
//            $this->db->where("userId !=", $userId);
//        }
        $query = $this->db->get();

        return $query->result();
    }

    function getGroups($id = 0)
    {
        $this->db->select("*");
        $this->db->from("dhl_group");
        $this->db->where("isDeleted", 0);
       if($id != 0){
           $this->db->where("id =", $id);
       }
        $query = $this->db->get();

        return $query->result();
    }


    function getUsers($groupId = "",$ownId = "")
    {
        $this->db->select('userId, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('roleId !=', 1);

        if(!empty($groupId)) {
            $this->db->where('groupId', $groupId);
        }

        if(!empty($ownId)) {
            $this->db->where('userId', $ownId);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getUserById($id)
    {
        $this->db->select('name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $id);
//        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return json_encode($query->result());
    }

    public function getCustomFields($groupId)
    {
        $this->db->select('*');
        $this->db->from('dhl_customfields');
//        $this->db->where('isDeleted', 0);
        $this->db->where('group', $groupId);
        $query = $this->db->get();
        if(!empty($query->result()))
            return $query->result()[0];
        else
            return array();

    }

    public function getCustomFieldstoArray($groupId) {
        $json = $this->getCustomFields($groupId);
        $arr = json_decode($json->fields);
        return ($arr->fields);
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewTask($taskInfo)
    {
        $this->db->trans_start();
        $this->db->insert('dhl_tasks', $taskInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addTaskLog($log)
    {
        $this->db->trans_start();
        $this->db->insert('dhl_tasklogs', $log);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function getTaskLog($task)
    {
        $this->db->select("*");
        $this->db->from("dhl_tasklogs");
        $this->db->join('tbl_users as user', 'user.userId = dhl_tasklogs.logged_by','left');
        $this->db->where("dhl_tasklogs.isDeleted", 0);
        $this->db->where("taskId", $task);
        $this->db->order_by("logId","desc");
        $query = $this->db->get();

        return $query->result();
    }


//
//    /**
//     * This function used to get user information by id
//     * @param number $userId : This is user id
//     * @return array $result : This is user information
//     */
//    function getUserInfo($userId)
//    {
//        $this->db->select('*');
//        $this->db->from('tbl_users');
//        $this->db->where('isDeleted', 0);
//		$this->db->where('roleId !=', 1);
//        $this->db->where('userId', $userId);
//        $query = $this->db->get();
//
//        return $query->result();
//    }
//
//
//    /**
//     * This function is used to update the user information
//     * @param array $userInfo : This is users updated information
//     * @param number $userId : This is user id
//     */
    function editTask($taskId, $info)
    {
        $this->db->where('id', $taskId);
        $this->db->update('dhl_tasks', $info);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTask($id, $info)
    {
        $this->db->where('id', $id);
        $this->db->update('dhl_tasks', $info);

        return $this->db->affected_rows();
    }


    function genReport($group,$start = '',$end = '')
    {
        if(empty($start))
            $start = date('Y-m-d',strtotime("-1 days"));
        if(empty($end))
            $end = date('Y-m-d');

        $result = $this->getTask('',$group,$start,$end);
        return $result;
    }

    function dashboard($params = '',$notin = '') 
    {
        $this->db->select('count(*) as rs');
        $this->db->from('dhl_tasks');  
        if(!empty($params)) {
            $this->db->where($params);
        }   

        if(!empty($notin)) {
            foreach ($notin as $key => $value) {
                $this->db->where_not_in($key,$value);
            }
        }        
        $this->db->where("dhl_tasks.isDeleted", 0);
        $query = $this->db->get();
        return $query->result();
    }

    function latest($params = '',$notin = '') 
    {
        $this->db->select('*');
        $this->db->from('dhl_tasks');  
        if(!empty($params)) {
            $this->db->where($params);
        }   

        if(!empty($notin)) {
            foreach ($notin as $key => $value) {
                $this->db->where_not_in($key,$value);
            }
        }        
        $this->db->where("dhl_tasks.isDeleted", 0);
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }


//
//
//    /**
//     * This function is used to match users password for change password
//     * @param number $userId : This is user id
//     */
//    function matchOldPassword($userId, $oldPassword)
//    {
//        $this->db->select('userId, password');
//        $this->db->where('userId', $userId);
//        $this->db->where('isDeleted', 0);
//        $query = $this->db->get('tbl_users');
//
//        $user = $query->result();
//
//        if(!empty($user)){
//            if(verifyHashedPassword($oldPassword, $user[0]->password)){
//                return $user;
//            } else {
//                return array();
//            }
//        } else {
//            return array();
//        }
//    }
//
//    /**
//     * This function is used to change users password
//     * @param number $userId : This is user id
//     * @param array $userInfo : This is user updation info
//     */
//    function changePassword($userId, $userInfo)
//    {
//        $this->db->where('userId', $userId);
//        $this->db->where('isDeleted', 0);
//        $this->db->update('tbl_users', $userInfo);
//
//        return $this->db->affected_rows();
//    }
}

  