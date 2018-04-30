<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Help</title>
    <style>
      body{margin: 0px; background: #DDD}
      .contanier{ width: 1300px;margin:10px auto; color: #FFF}
      h1{background: MediumSeaGreen;margin: 0px;text-align: center; font-size: 55px}
      .student{background: MediumSeaGreen;}
      h2{padding: 12px;font-size: 52px}
      .content{width:1100px;margin:0px auto ; height: 327px;}
      .firstp,.secp{ width:500px;margin: 0px;margin-right:80px ;float: left; text-align: center;
        font-size: 50px}
        .secp{margin-right: 0px;}
      .firstim,.secm{width:500px;text-align: center;margin-top: 10px}
      .secm{float: left;margin-right:80px}
    </style>
  </head>
  <body>
    <div class="contanier">
      <h1>User Help</h1>
      <div class="student">
        <h2>Student :</h2>
        <div class="content">
          <p class="firstp">
            Click on button Group select To open this page then choose one group from your group
            then click select.
          </p>
          <img class="firstim"src="image/1.jpg" alt="" />
        </div>
        <div class="content">
          <img class="secm"src="image/2.jpg" alt="" />
          <p class="secp">
             choose one manager from all manager is not there in this group
            then click invite
          </p>
        </div>
      </div>
      <div class="student">
        <h2>Manager :</h2>
        <div class="content">
          <p class="firstp">
            if a student invite you ? you will recive a message click on message
          </p>
          <img class="firstim"src="image/3.jpg" alt="" />
        </div>
        <div class="content">
          <img class="secm"src="image/5.jpg" alt="" />
          <p class="secp">
            You have two option accept or reject
            if you rejected the invite you will not join in the group.
          </p>
        </div>
        <div class="content">
          <p class="firstp">
           here you accepted so you join in the group
          </p>
          <img class="firstim"src="image/4.jpg" alt="" />
        </div>
      </div>
    </div>
    <?php
?>
<style>
	#center
	{	
		text-align: center;
	}
	

</style>
<h1 id="center">Welcome User</h1>
<h2>If You are A student</h2>
<h3>You Can create group into group-self selection by choose group-self selection name-> create group and set password if you need..

 You can Also join to any group and can leave group ..
 You can also invite supervisor to your group by select : select a group then choose group that you want to invite supervisor to it -> Press Select Button -> Select supervisor name -> Press Invite Button if the supervisor accept or reject the invitation you will recieve a message for Invitation</h3>

 <h2>If You are A Teacher</h2>
<h3> You Can Assign any Student to Any group by select the student you want and click submit then choose the group you want to add him to it and click add..

Select Course-> group-self selection name-> create group and set password if you need..
You can Also join to any group and can leave group..
..You can also invite supervisor to your group by select : select a group then choose group that you want to invite supervisor to it -> Press Select Button -> Select supervisor name -> Press Invite Button if the supervisor accept or reject the invitation you will recieve a message for Invitation</h3>


<h2>If You are A Manager</h2>
<h3> You Can Accept Or reject Invitation to any group by read the message then you will see all invitation if you set accept or reject a message will be sent to the students to notify them </h3>


  </body>
</html>
