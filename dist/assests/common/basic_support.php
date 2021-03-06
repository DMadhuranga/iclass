<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 12/20/2017
 * Time: 12:57 PM
 */
include_once("dbconnection.php");
include_once("classes/Person.php");
if(!isset($_SESSION)){
    session_start();
}

function authenticate($dbh,$role_array,$page_url){
    if(isset($_SESSION["user"])){
        $user = unserialize($_SESSION["user"]);
        $res = checkLoginDataGet($dbh,$user->getUserName(),$user->getPassword());
        if($res==-1){
            session_unset();
            setcookie("user", "", time() - 3600);
            header("location:login.php");
        }elseif($res==-2){
            die("Connection failed. Please try again later");
        }
        if(!in_array($user->getRoleId(),$role_array)){
            header("location:home.php");
        }
    }else{
        header("location:login.php");
    }
    $page_url = explode("/",$page_url);
    return getSideBar($dbh,$user->getRoleId(),$page_url[sizeof($page_url)-1]);
}

function getSideBar($dbh,$role_number,$page_url){
    $return = "";
    if ($dbh) {
        $sql = $dbh->prepare("SELECT * FROM role_to_page NATURAL JOIN page LEFT OUTER JOIN sub_page USING(page_id) WHERE role_to_page.role_id=? ORDER BY role_to_page.page_order,sub_page.sub_page_id");
        $sql->execute(array($role_number));
        if ($sql) {
            $result = $sql->fetchAll();
            if(sizeof($result)>0){
                $pages = array();
                foreach ($result as $page){
                    if(!array_key_exists($page["page_id"],$pages)){
                        $pages[$page["page_id"]] = array();
                    }
                    $temp_array = array();
                    $temp_array["page_name"]= $page["page_name"];
                    $temp_array["page_url"]= $page["page_url"];
                    $temp_array["icon"]= $page["icon"];
                    $temp_array["sub_page_name"]= $page["sub_page_name"];
                    $temp_array["sub_page_url"]= $page["sub_page_url"];
                    array_push($pages[$page["page_id"]],$temp_array);
                }
                foreach ($pages as $page){
                    if($page[0]["sub_page_name"]==""){
                        foreach ($page as $item){
                            if($page_url==$item["page_url"]){
                                $return = $return."<li class='active'><a href='".$item["page_url"]."'><i class='".$item["icon"]."'></i><span>".$item["page_name"]."</span></a></li>";
                            }else{
                                $return = $return."<li><a href='".$item["page_url"]."'><i class='".$item["icon"]."'></i><span>".$item["page_name"]."</span></a></li>";
                            }
                        }
                    }else{
                        $return = $return."<li class='treeview'><a href=''><i class='".$page[0]["icon"]."'></i><span>".$page[0]["page_name"]."</span><i class='fa fa-angle-right'></i></a>
              <ul class='treeview-menu'>";
                        foreach ($page as $item){
                            if($page_url==$item["sub_page_url"]){
                                $return = $return."<li class='active'><a href='".$item["sub_page_url"]."'><i class='fa fa-circle-o'></i><span>".$item["sub_page_name"]."</span></a></li>";
                            }else{
                                $return = $return."<li><a href='".$item["sub_page_url"]."'><i class='fa fa-circle-o'></i><span>".$item["sub_page_name"]."</span></a></li>";
                            }
                        }
                        $return = $return."</ul></li>";
                    }
                }
            }
            return $return;
        }
    }
    die("Connection failed. Please try again later");
}

function checkLoginDataGet($dbh,$user_name,$password){
    if ($dbh) {
        $sql = $dbh->prepare("select user_name,role_id from person where ((user_name=? OR email=?) AND password=?) and deleted=0");
        $sql->execute(array($user_name,$user_name, $password));
        if ($sql) {
            $result = $sql->fetchAll();
            if(sizeof($result)>0){
                return 1;
            }
        }else{
            return -2;
        }

    }else{
        return -2;
    }
    return -1;
}

function getUser($dbh,$user_name,$password){
    if ($dbh) {
        $sql = $dbh->prepare("select id,name,full_name,national_id,email,notes,password,user_name,sex,registered_date,date_of_birth,address,role_id from person where ((user_name=? OR email=?) AND password=?) and deleted=0");
        $sql->execute(array($user_name,$user_name, $password));
        if ($sql) {
            $result = $sql->fetchAll();
            if(sizeof($result)>0){
                $temp_users = new Person();
                $temp_users->setEmail($result[0]["email"]);
                $temp_users->setName($result[0]["name"]);
                $temp_users->setFullName($result[0]["full_name"]);
                $temp_users->setNationalId($result[0]["national_id"]);
                $temp_users->setPassword($result[0]["password"]);
                $temp_users->setRoleId($result[0]["role_id"]);
                $temp_users->setId($result[0]["id"]);
                $temp_users->setUserName($result[0]["user_name"]);
                $temp_users->setNotes($result[0]["notes"]);
                $temp_users->setSex($result[0]["sex"]);
                $temp_users->setRegisteredDate($result[0]["registered_date"]);
                $temp_users->setDateOfBirth($result[0]["date_of_birth"]);
                $temp_users->setAddress($result[0]["address"]);
                return $temp_users;
            }
        }else{
            return -2;
        }

    }else{
        return -2;
    }
    return -1;
}

function checkLogin($conn,$u_name,$password){
    $result = checkLoginDataGet($conn,$u_name,$password);
    if($result==-1){
        echo "userNotExist";
    }elseif ($result==-2){
        echo "minus 2";
    }else{
        echo print_r($result);
    }
}