<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ระบบจัดการข้อมูลประเภทอาหาร</title>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>


  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/bootstrap.min.js"></script>
  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<style type="text/css">
  .navbar {
      font-family: Montserrat, sans-serif;
      margin-bottom: 0;
      background-color: #2d2d30;
      border: 0;
      font-size: 11px !important;
      letter-spacing: 4px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #2d2d30;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }
</style>
<div class="container">
  <ul class=""></ul>
</div>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">NUTRITION SYSTEM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">NUTRITION
          <span class="caret"></span></a>

           <ul class="dropdown-menu">
              <li align = "center"><a href="HN_patient.php">ข้อมูลผู้ป่วย</a></li>
            <li align = "center"><a href="user.php">ข้อมูลเจ้าหน้าที่</a></li>
            <li align = "center"><a href="department.php">ข้อมูลแผนก</a></li>
             <li align = "center"><a href="matandunit.php">ข้อมูลวัตถุดิบและหน่วยนับ</a></li>
            <li align = "center"><a href="insert_restaurant.php">ข้อมูลร้านค้าวัตถุดิบ</a></li>
            <li align = "center"><a href="typefood.php">ข้อมูลประเภทอาหาร</a></li>
            <li align = "center"><a href="insert_menu.php">ข้อมูลเมนูอาหาร</a></li>
            <li align = "center"><a href="patient.php">การสั่งอาหารและจัดส่งอาหาร</a></li>
            <li align = "center"><a href="insert_buymaterial.php">สั่งซื้อวัตถุดิบ</a></li>
            <li align = "center"><a href="insert_feed.php">สั่งซื้ออาหารทางสายยาง</a></li>
          </ul>



        </li>
        <li><a href=""><span class="glyphicon glyphicon-user"> <? echo $_SESSION["Username"];?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <div class="jumbotron">
       <!--<h1><font face ="JasmineUPC">โรงพยาบาลเจ้าพระยาอภัยภูเบศร</font></h1>-->
       <br>
      <p>ข้อมูลเมนูอาหาร</p>
<?php
$flag=0;
if(isset($_POST['submit'])){
  @include('conn.php');
  $strSQL = "SELECT * FROM menu";
  $objQuery = mysql_query($strSQL, $connect1);
  while ($objReSult = mysql_fetch_array($objQuery)) {
   $gname= $objReSult["menu_name"];
   if($gname==$_POST['name_menu']){
     $flag=1;
   }
}
if($flag==0){
  $insert_food = "INSERT INTO menu (menu_id,menu_name,id_type)  VALUES ('".$_POST['id_menu']."','".$_POST['name_menu']."','".$_POST['store']."')";
  		  $query = mysql_query($insert_food,$connect1);
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');
  		  window.location='insert_menu.php';</script>");


  if(!$insert){
  	echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
  		  window.location='insert_menu.php';</script>");
  }
}
}
@include('conn.php');
$strSQL = "SELECT MAX(menu_id) FROM menu";
$objQuery = mysql_query($strSQL, $connect1);
while ($objReSult = mysql_fetch_array($objQuery)) {
 $result= $objReSult["MAX(menu_id)"];
 $ina="";
   for($a=0;$a<Strlen($result);$a++){
   if($a>=2)$ina =$ina.intval($result[$a])  ;
   }
   $id= "MN-".sprintf("%04d", $ina+1);
 }
 ?>
  <div class="modal-body">
         <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">

                    <h4> รหัสเมนูอาหาร : &nbsp;<input type="text" name="id_menu" placeholder="name" value="<?php echo $id; ?>" readonly=""></h4>
                    <h4> ชื่อเมนูอาหาร &nbsp;&nbsp;: &nbsp;<input type="text" name="name_menu" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"><font color="red"> &nbsp;*</font><?php if($flag==1)echo "<font color=red>ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>
                    <h4> ประเภทอาหาร :
                      <select name = "store">
                        <option>------กรุณาเลือกประเภทอาหาร-----</option>
                      <?
                    @include('conn.php');

                    $strSQL = "SELECT * FROM type_food ";
                    $objQuery = mysql_query($strSQL, $connect1);

                    while ($objReSult = mysql_fetch_array($objQuery)) {
                     
                  ?>
                <option value="<? echo $objReSult["id_type"];?>" <? echo $sel; ?> > <? echo $objReSult["type_name"];?></option>
                <?
                }
                ?>
                </select><font color="red">&nbsp;*</font>
                </h4>

         <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit"
            onclick="submitModal()"">&nbsp;&nbsp;
         &nbsp;&nbsp; <a href="index.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
        </form>
</div>
 </div>
  </div>

  <form method="post" action="#"
  <h4><font color=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ค้นหาจากชื่อเมนูอาหาร : </font></label> <input type="text" name="sen" >
   <!--<input type="hidden" name="selected_text" id="selected_text" value="" />-->

     <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
  </form>

  <?php
  @include('conn.php');
  $see=$_POST["sen"];
  $strSQL = "SELECT * FROM menu a join type_food b on a.id_type=b.id_type where menu_name like '%$see%' order by menu_id";
  $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
  $num=mysql_num_rows($objQuery);
  if($num==0){
    echo"<script language=\"JavaScript\">";

  echo"alert('ไม่พบข้อมูล')";

  echo"</script>";
  echo( "<script>window.location='insert_menu.php';</script>");
  }
  ?>
  <br>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสเมนูอาหาร</div></th>
    <th><div align="center">ชื่อเมนูอาหาร</div></th>
    <th><div align="center">ประเภทอาหาร</div></th>
    <th width="100"><div align="center">แก้ไขข้อมูล</div></th>
    <th width="100"><div align="center">ลบข้อมูล</div></th>
  </tr>

<?
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["menu_id"];?></div></td>
  <td><div align = "left"><? echo $objReSult["menu_name"];?></div></td>
  <td><div align = "left"><? echo $objReSult["type_name"];?></div></td>
  <td><div align = "center"><a href='edit_menu.php?id=<? echo $objReSult['menu_id'];?>&id2=<? echo $objReSult['menu_name'];?>&id3=<? echo $objReSult['id_type'];?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_menu.php?id=<? echo $objReSult['menu_id']?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>
    </tr>
  <?
}

?>
</table>
</div>




<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์  จันทร์กระจ่าง</a></p>
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>






</body>
</html>
