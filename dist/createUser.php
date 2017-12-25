<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 12/25/2017
 * Time: 6:15 PM
 */
include_once("assests/common/dbconnection.php");
include_once("assests/common/basic_support.php");
include_once("assests/common/classes/Person.php");
$sideBar = authenticate($dbh,array(1,2),$_SERVER['REQUEST_URI']);
$user = unserialize($_SESSION["user"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>iClass</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>
<body class="sidebar-mini fixed">
<div class="wrapper">
    <!-- Navbar-->
    <header class="main-header hidden-print"><a class="logo" href="home.php">iClass</a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu">
                <ul class="top-nav">
                    <!--Notification Menu-->
                    <li class="dropdown notification-menu"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o fa-lg"></i></a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                    <!-- User Menu-->
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                        <ul class="dropdown-menu settings-menu">
                            <li><a href="profile.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image"><img class="img-circle" src="images/home_user_white.png" alt="User Image"></div>
                <div class="pull-left info">
                    <p><?php echo $user->getName(); ?></p>
                </div>
            </div>
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                <?php echo $sideBar; ?>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <!-- Page content




        -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h3 class="card-title">Register</h3>
                    <div class="card-body">
                        <form>
                            <div class="form-group" id="div_name">
                                <label class="control-label">Name <span style = 'color:red'>*</span></label><label class="control-label" id="nameError"></label>
                                <input class="form-control" type="text" placeholder="Enter name" id="inp_name">
                            </div>
                            <div class="form-group" id="div_full_name">
                                <label class="control-label">Full Name <span style = 'color:red'>*</span></label><label class="control-label" id="fullNameError"></label>
                                <input class="form-control" type="text" placeholder="Enter full name" id="inp_full_name">
                            </div>
                            <div class="form-group" id="div_nationalID">
                                <label class="control-label">National ID</label><label class="control-label" id="nationalIDError"></label>
                                <input class="form-control" type="text" placeholder="Enter national ID" id="inp_national_id">
                            </div>
                            <div class="form-group" id="div_dob">
                                <label class="control-label">Date Of Birth <span style = 'color:red'>*</span></label><label class="control-label" id="dobError"></label>
                                <input class="form-control" type="text" placeholder="Ex- 1990-01-02" id="inp_dob">
                            </div>
                            <div class="form-group" id="div_email">
                                <label class="control-label">Email</label><label class="control-label" id="emailError"></label>
                                <input class="form-control" type="email" placeholder="Enter email address" id="inp_email">
                            </div>
                            <div class="form-group" id="div_address">
                                <label class="control-label">Address <span style = 'color:red'>*</span></label><label class="control-label" id="addressError"></label>
                                <textarea class="form-control" rows="4" placeholder="Enter address" id="inp_address"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="inp_male" checked="">Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="inp_female">Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="select">Role</label>
                                <select class="form-control" id="inp_role_id">
                                    <option value="2">Manager</option>
                                    <option value="3">Office Staff</option>
                                </select>
                            </div>
                            <div class="form-group" id="div_userName">
                                <label class="control-label">User Name <span style = 'color:red'>*</span></label><label class="control-label" id="userNameError"></label>
                                <input class="form-control" type="text" placeholder="Enter username" id="inp_user_name">
                            </div>
                            <div class="form-group" id="div_password">
                                <label class="control-label">Password <span style = 'color:red'>*</span></label><label class="control-label" id="passwordError"></label>
                                <input class="form-control" type="password" placeholder="Enter password" id="inp_password">
                            </div>
                            <div class="form-group" id="div_cPassword">
                                <label class="control-label">Confirm Password <span style = 'color:red'>*</span></label><label class="control-label" id="cPasswordError"></label>
                                <input class="form-control" type="password" placeholder="Enter confirm password" id="inp_cpassword">
                            </div>
                            <div class="form-group" id="div_notes">
                                <label class="control-label">Notes</label><label class="control-label" id="notesError"></label>
                                <textarea class="form-control" rows="4" placeholder="Enter notes" id="inp_notes"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary icon-btn" type="button" onclick="submitForm()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add User</button>&nbsp;
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Javascripts-->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/pace.min.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript">
    function submitForm() {
        clearErrors([["nameError","div_name"],["fullNameError","div_full_name"],
            ["nationalIDError","div_nationalID"],["dobError","div_dob"],
            ["emailError","div_email"],["addressError","div_address"],
            ["userNameError","div_userName"],["passwordError","div_password"],
            ["cPasswordError","div_cPassword"],["notesError","div_notes"]]);
        var name = getValueOfInput("inp_name");
        var fullName = getValueOfInput("inp_full_name");
        var nid = getValueOfInput("inp_national_id");
        var dob = getValueOfInput("inp_dob");
        var email = getValueOfInput("inp_email");
        var address = getValueOfInput("inp_address");
        var sex = getSex("inp_male","inp_female");
        var roleId = getValueOfInput("inp_role_id");
        var userName = getValueOfInput("inp_user_name");
        var password = getValueOfInput("inp_password");
        var cPassword = getValueOfInput("inp_cpassword");
        var notes = getValueOfInput("inp_notes");

        var error = false;
        if(!basicCheck(name,false,0,50,"nameError","div_name",error)){
            error=true;
        }
        if(!basicCheck(fullName,false,0,120,"fullNameError","div_full_name",error)){
            error=true;
        }
        if(!basicCheck(userName,false,0,25,"userNameError","div_userName",error)){
            error=true;
        }
        if(!basicCheck(email,true,0,100,"emailError","div_email",error)){
            error=true;
        }else{
            if(email.length>0) {
                if (!validateEmail(email)) {
                    error = true;
                    putErrorMsg("emailError", "Invalid email", "div_email");
                }
            }
        }
        if(!basicCheck(address,true,0,200,"addressError","div_address",error)){
            error=true;
        }
        if(!basicCheck(notes,true,0,1000,"notesError","div_notes",error)){
            error=true;
        }
        if(!basicCheck(password,false,8,25,"passwordError","div_password",error)){
            error=true;
        }else{
            if(password!=cPassword){
                putErrorMsg("cPasswordError","Password mismatch.","div_cPassword");
                error=true;
            }
        }
        if(!error){
            alert();
        }






    }

    function basicCheck(value,nullAllow,minLength,maxLength,errorID,div_id,error){
        if(!nullAllow){
            if(value.length==0){
                putErrorMsg(errorID,"Required",div_id);
                return false;
            }
        }
        if(value.length<minLength){
            putErrorMsg(errorID,"Minumum "+minLength+" characters required",div_id);
            return false;
        }
        if(value.length>maxLength){
            putErrorMsg(errorID,"Too long. Only "+maxLength+" characters",div_id);
            return false;
        }
        return true;

    }

    function putErrorMsg(id,msg,div_id){
        var errorMsg = "<span style = 'color:red'>&nbsp";
        document.getElementById(id).innerHTML=errorMsg+msg;
        document.getElementById(div_id).className= "form-group has-error";
    }

    function clearErrors(idArray){
        for (i = 0; i < idArray.length; i++) {
            document.getElementById(idArray[i][0]).innerHTML="";
            document.getElementById(idArray[i][1]).className= "form-group";
        }
    }

    function getValueOfInput(id){
        return document.getElementById(id).value;
    }

    function getSex(male_id,female_id){
        if(document.getElementById(male_id).checked){
            return 1;
        }
        if(document.getElementById(female_id).checked){
            return 0;
        }
        return -1;
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
</body>
</html>