<?php
class test 
{
	
	/*	  function returnidgroup($groupname)
        {
           global $DB;
            $ret = $DB->get_record('groups',array('name' =>  $groupname));
            return $this->groupmember($ret->id);
            
        }
        function groupmember($groupid)
        {
        	global $DB;
        	 $arr = $DB->get_records('groups_members',array('groupid' =>  $groupid));
        	 return $arr;
        }*/
        function getgroups($shortname)
        {
        	 global $DB;
        	 $courseid = $DB->get_record('course',array('shortname' =>  $shortname));
            $ret = $DB->get_records('groups',array('courseid' =>  $courseid->id));
            return $ret	;
        }
       function getstudent($groupname,$courseid)
      {
        	global $DB;
            $std = array();
            $ret = array();
            $arr1 = array();
            $new = array();
            $groupid = $DB->get_record('groups',array('name' =>  $groupname));
            $members = $DB->get_records('groups_members',array('groupid' =>  $groupid->id));
            $allusers = $DB->get_records('user',array());
            $arr =array();
            foreach ($members as $key => $value) {
                array_push($arr, $value->userid);
            }
            foreach ($allusers as $key => $value) {
                array_push($arr1, $value->id);
            }
            
                foreach ($arr as  $value) {
                   $type = $this->get_user_type($value,$courseid);
                   if($type == "Student")
                   {
                        array_push($std, $value);
                   }
                }

                 foreach ($arr1 as  $value) {
                   $type = $this->get_user_type($value,$courseid);
                   if($type == "Student")
                   {
                        array_push($new, $value);
                   }
                }
                $notmember = array_diff($new, $std);
               foreach ($notmember as  $value) {
                $username = $DB->get_record('user',array('id' =>  $value));
                array_push($ret, $username->username);
               }
                return $ret;


 	  }


 	function add_user_to_group($groupname,$username)
 	{
 		global $DB;
 		$groupid = $DB->get_record('groups',array('name' =>  $groupname));
 		$userid = $DB->get_record('user',array('username' =>  $username));		
 		$record1 = new stdClass();
		$record1->groupid=$groupid->id;
		$record1->userid = $userid->id;
		$record1->id = $DB->insert_record('groups_members', $record1);


 	}


// return user type

    function get_user_type($userid,$courseid)
    {
        global $DB;
        $params = array();
      
        $sql ="SELECT
    c.id AS courseid,
    c.fullname,
    u.username, 
    u.id,
    u.email
    FROM
    {role_assignments} ra
    JOIN {user} u ON u.id = ra.userid
    JOIN {role} r ON r.id = ra.roleid
    JOIN {context} cxt ON cxt.id = ra.contextid
    JOIN {course} c ON c.id = cxt.instanceid
    WHERE  roleid = 3
   AND   ra.userid = u.id
  AND cxt.instanceid = c.id
  AND ra.contextid = cxt.id
   AND c.id = $courseid 
   And u.id = $userid
    ORDER BY c.fullname";
    
/*
    WHERE ra.userid = u.id
AND cxt.instanceid = c.id
AND ra.contextid = cxt.id
AND roleid = 5
ORDER BY c.fullname*/
    
    $user =  $DB->get_records_sql( $sql, $params );
    if(sizeof($user)!=0)
    {
        return "Teacher";
    }
    else
    {
     
      
       
        $sql ="SELECT
    c.id AS courseid,
    c.fullname,
    u.username, 
    u.id,
    u.email
    FROM
    {role_assignments} ra
    JOIN {user} u ON u.id = ra.userid
    JOIN {role} r ON r.id = ra.roleid
    JOIN {context} cxt ON cxt.id = ra.contextid
    JOIN {course} c ON c.id = cxt.instanceid
    WHERE  roleid = 5
   AND   ra.userid = u.id
  AND cxt.instanceid = c.id
  AND ra.contextid = cxt.id
   AND c.id = $courseid 
   And u.id = $userid
    ORDER BY c.fullname";
     $user =  $DB->get_records_sql( $sql, $params );
     if(sizeof($user)!=0)
    {
        return "Student";
    }
    else
    {
     
      
         $sql ="SELECT
    c.id AS courseid,
    c.fullname,
    u.username, 
    u.id,
    u.email
    FROM
    {role_assignments} ra
    JOIN {user} u ON u.id = ra.userid
    JOIN {role} r ON r.id = ra.roleid
    JOIN {context} cxt ON cxt.id = ra.contextid
    JOIN {course} c ON c.id = cxt.instanceid
    WHERE  roleid = 1
   AND   ra.userid = u.id
  AND cxt.instanceid = c.id
  AND ra.contextid = cxt.id
   AND c.id = $courseid 
   And u.id = $userid
    ORDER BY c.fullname";
     $user =  $DB->get_records_sql( $sql, $params );
      if(sizeof($user)!=0)
    {
        return "Manager";
    }
    else
    {
        return "Null";
    }
    }  
    
    }


    }

// return all groups which specific student is member in

    function get_student_groups($studentid)
    {
        global $DB;
        $arr = array();
        $params = array();
         $name = array();
        
        $sql = "SELECT groupid FROM {groups_members} where userid = $studentid";

        $groupsid = $DB->get_records_sql($sql,$params);

         foreach ($groupsid as $key => $value) {
        array_push($arr,($value->groupid));
             }
             for($i=0;$i<sizeof($arr);$i++)
             {
         $sqli = "SELECT name FROM {groups} where id = $arr[$i]";
         $groupsname = $DB->get_record_sql($sqli,$params);
            array_push($name, $groupsname);
              }

    
        return $name;


    }


// return names of all managers who is not in specific group which is selected by name

    function select_managers($groupname,$courseid) 
    {
         global $DB;
         $arr2 =array();
         $arr = array();
         $arr1 = array();
        $managersid = array();

       $name = $DB->get_record('groups',array('name' =>  $groupname));



         $sql = "SELECT id from {user}";
         $par = array();
         $usersid = $DB->get_records_sql($sql,$par);
         foreach ($usersid as $key => $value) {
        array_push($arr,($value->id));
             }
            for($i=0;$i<sizeof($arr);$i++)
             {
                $type = $this->get_user_type($arr[$i],$courseid);
                if($type == 'Manager')
                {
                    array_push($managersid, $arr[$i]);
                }
                

             }
              $sql = "SELECT userid from {groups_members} where groupid = $name->id";
         $par = array();
         $mid = $DB->get_records_sql($sql,$par);
         foreach ($mid as $key => $value) {
        array_push($arr1,($value->userid));
             }

             $new = array_diff($managersid, $arr1);
             foreach($new as $value)
             {
                $sql = "SELECT username from {user} where id = $value";
                 $all = $DB->get_record_sql($sql,$new);
                 array_push($arr2,($all->username));
             }
              
        
        
             return $arr2;

    }



// return all about user

    function get_user($name)
    {
        global $DB;
        $query = $DB->get_record('user',array('username' =>  $name));
        return $query;
    }

    // select groups which students send invitation  to managers

    function select_invitation($id)
    {
        $arr = array();
        $ret = array();
        global $DB;
       $query = $DB->get_records('message_read',array('useridto' =>  $id));
        foreach ($query as $key => $value) 
            {
                if($value->subject == "Invitation")
                {
                array_push($arr, $value->contexturl);
                }
            }
           
              
            
            return array_unique($arr);

    }

    // delete message from message_read table to not to select it any more

    function delete_message($groupname,$id)
    {
        global $DB;
        $DB->delete_records('message_read', array('useridto' => $id , 'contexturl' => $groupname));
    }



// send massage to students who invite the manager to thire groups (accept or reject)

    function manager_response($groupname,$senderid,$cond,$mess)
    {
        global $DB;
        $new = array();
        
        $query = $DB->get_records('message_read',array('contexturl' => $groupname));
        foreach ($query as $key => $value) 
            {
                array_push($new, $value->useridfrom);
            
            }
            $new = array_unique($new);
            foreach ($new as $value) 
            {
                $sender = $DB->get_record('user',array('id' =>  $senderid));
                
                 $reciever = $DB->get_record('user',array('id' =>  $value));

              $this->send_message($sender,$reciever,$groupname,$cond,$mess);
            
                
            }
           

           

    }


/*  send message to any one */

    function send_message($from,$to,$groupname,$cond,$mess,$context='')
    {
        $message = new \core\message\message();     
      $message->component = 'moodle';
        $message->name = 'instantmessage';
        $message->userfrom = $from;
$message->userto =$to;
$message->subject = $cond;
$message->fullmessage = $mess . ":" .$groupname;
$message->fullmessageformat = FORMAT_MARKDOWN;
$message->fullmessagehtml = '<p>message body</p>';
$message->smallmessage = '';
$message->notification = '0';
$message->contexturl = $context;
$message->contexturlname = '';
$message->replyto = "";
$messageid = message_send($message);
       
    }

}
?>