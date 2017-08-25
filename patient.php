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
  <title>ระบบการสั่งอาหารและจัดส่งอาหารให้ผู้ป่วย</title>
  <meta http-equiv=Content-Type content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

<link rel="icon" href="img/icon300.ico" type="image/x-icon"/>


  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/css/myStyle2.css">

  <script src="css/js/jquery.min.js"></script>
  <script src="css/js/bootstrap.min.js"></script>

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
<?
// $dep = "0";
$eats = "0";

?>
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
      <p>ระบบการสั่งอาหารและจัดส่งอาหารให้ผู้ป่วย</p>
      <?php
          $user2 = $_SESSION['Username'];
          $sqll = "SELECT DISTINCT * FROM jhosdb.fpatient_info f JOIN cpa.department d ON f.clinicdescribe = d.dep_name
                  JOIN cpa.sys_user s ON d.Dep_phone = s.group WHERE s.username = '$user2'";
          $ress = mysql_query($sqll,$connect1);
          $roww = mysql_fetch_array($ress);
          $dep = $roww['clinic'];
       ?>
      <form method="POST">
<label for="department"> แผนก : </label>
  <select id="dep" name="dep"   onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
  <option value="">-------แสดงทั้งหมด-------</option>
  <?
    $strSQL = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info order by clinicdescribe";
    $objQuery = mysql_query($strSQL, $connect2);
    while ($objReSult = mysql_fetch_array($objQuery)) {
      $sql = "SELECT * FROM sys_user s JOIN department d ON s.group=d.Dep_phone  WHERE s.username = '$user2'";
      $res2 = mysql_query($sql,$connect1);
      $row = mysql_fetch_array($res2);
      if ($row['dep_name'] ==  $objReSult['clinicdescribe']) {
        $sel = "selected";
      }
      elseif ($_POST["dep"] == $objReSult['clinic']) {
        $sel = "selected";
      }
      else
      {
        $sel = "";
      }
  ?>
<option value="<? echo $objReSult["clinic"];?>" <? echo $sel; ?> > <? echo $show." ".$objReSult["clinicdescribe"];?></option>
<?
}
error_reporting(0);
?>
</select>
 <br>
 <label for="fooder"> มื้ออาหาร : </label>
 <?php $eats = $_POST['eats']; ?>
<select id="food" name="eats">
  <option disabled>---เลือกมื้ออาหาร---</option>
  <option value="4" <?php if($eats == '4' && isset($eats)){echo "selected";} ?> >เช้า</option>
  <option value="5" <?php if($eats == '5' && isset($eats)){echo "selected";} ?> >กลางวัน</option>
  <option value="6" <?php if($eats == '6' && isset($eats)){echo "selected";} ?> >เย็น</option>
</select>
<?php
 date_default_timezone_set("Asia/Bangkok");
 $d=strtotime('+1 day');
 $todate = date("d-m-Y",$d);
 $day = date("l");
 $dayy = substr($todate,0,2);
 $mon = substr($todate,3,2);
 if($mon == '01' ){
   $mon = 'มกราคม';
 }else if($mon == '02'){
   $mon = 'กุมภาพันธ์';
 }else if($mon == '03'){
   $mon = 'มีนาคม';
 }else if($mon == '04'){
   $mon = 'เมษายน';
 }else if($mon == '05'){
   $mon = 'พฤษภาคม';
 }else if($mon == '06'){
   $mon = 'มิถุนายน';
 }else if($mon == '07'){
   $mon = 'กรกฏาคม';
 }else if($mon == '08'){
   $mon = 'สิงหาคม';
 }else if($mon == '09'){
   $mon = 'กันยายน';
 }else if($mon == '10'){
   $mon = 'ตุลาคม';
 }else if($mon == '11'){
   $mon = 'พฤศจิกายน';
 }else if($mon == '12'){
   $mon = 'ธันวาคม';
 }
 if ($day = "Monday") {
   $day = "วันอังคาร";
 }
 elseif ($day = "Tuesday"){
   $day = "วันพุธ";
 }
 elseif ($day = "Wednesday"){
   $day = "วันพฤหัสบดี";
 }
 elseif ($day = "Thursday"){
   $day = "วันศุกร์";
 }
 elseif ($day = "Friday"){
   $day = "วันเสาร์";
 }
 elseif ($day = "Saturday"){
   $day = "วันอาทิตย์";
 }
 elseif ($day = "Sunday"){
   $day = "วันจันทร์";
 }
 $year = substr($todate,6,4);
 $year += 543;

?>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <b>ประจำวันที่ : <?php echo "$day $dayy $mon $year"; ?></b>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<? $strDefault = $objReSult['clinic']; ?>
<input type="hidden" name="selected_text" id="selected_text" value="" />
  &nbsp;&nbsp;<input type="submit" name = "search" class="btn btn-success" value="ค้นหา">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="radio" name="check_food" value="t1" >
  <label>สามัญทั้งหมด</label>
  <input type="radio" name="check_food" value="t2"
  <label>พิเศษทั้งหมด</label>
<!--<input type="submit" name="search" value="Search"/>-->
</form>
    </div>
</div>
<div class="container">
<?php
error_reporting(0);
@include('conn.php');
$eats = 4;
if ($_POST) {
  $dep = $_POST['dep'];
  $eats = $_POST['eats'];
  $chec1 = $_POST['check_food'];
  $chec2 = $_POST['check_food'];
}
if ($dep != 0) {
$strSQL = "SELECT * FROM fpatient_info where clinic = '".$dep."'";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");
}
else{
  $strSQL = "SELECT * FROM fpatient_info where clinic = '$dep'";
$objQuery = mysql_query($strSQL) or die("Error Query [".$strSQL."]");

}
?>
<form method="POST" action="chkPHP.php" name="form1">
<table class="table table-striped table-bordered">
  <tr class="warning">
    <th>
      <div class="text-center">
        มื้ออาหาร :
        <?php if ($eats == 4): ?>
          เช้า
        <?php elseif ($eats == 5): ?>
          กลางวัน
        <?php elseif ($eats == 6): ?>
          เย็น
        <?php endif; ?>
      </div>
    </td>
  </tr>
  <tr class="warning">
    <th><div align="center">ลำดับ</div></th>
    <th><div align="center">ชื่อแผนก</div></th>
    <th><div align="center">HN</div></th>
    <th><div align="center">AN</div></th>
    <th><div align="center">ชื่อ</div></th>
    <th><div align="center">นามสกุล</div></th>
    <th><div align="center">สามัญ</div></th>
    <th><div align="center">พิเศษ</div></th>
    <th><div align="center">อาหารเฉพาะโรค</div></th>
  </tr>

<?
$new_hn = array();
$i = 0;
while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
$i++;
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $i; ?></div></td>
  <td><div><? echo $objReSult["clinicdescribe"];?></div></td>
  <td><div align = "center"><? echo $objReSult["hn"];?></div></td>
  <td><div align = "center"><? echo $objReSult["an"];?></div></td>
  <td><div><? echo $objReSult["fname"];?></div></td>
  <td><div><? echo $objReSult["lname"];?></div></td>
  <input type=hidden name="eats" value = "<? echo $eats;?>">
  <?php
      $chkdate = date("Y-m-d",$d);
      $hnn = $objReSult['hn'];
      $chk = "SELECT type_order FROM order_food WHERE HN = '$hnn' AND eats = '$eats' AND date_order = '$chkdate'";
      $reschk = mysql_query($chk,$connect1);
      $rowc = mysql_fetch_array($reschk);
      $rchk = $rowc['type_order'];
   ?>
  <td><div>
  <center>
      <input type="radio" name="chkfood<?echo "$i";?>" value="1_<? echo $objReSult["hn"];?>" <?php
       if($chec1=='t1' ||$rchk == '1'){echo "checked";}?> onclick="del(<? echo $objReSult['hn'];?>,<?php echo $eats; ?>)" required >
  </center>
  </div></td>
  <td><div>
  <center>
      <input type="radio" name="chkfood<?echo "$i";?>" value="2_<? echo $objReSult["hn"];?>" <?php
      if($chec1=='t2' ||$rchk == '2'){echo "checked";}?> onclick="del(<? echo $objReSult['hn'];?>,<?php echo $eats; ?>)" required >
  </center>
  </div></td>
  <td><div>
    <center>
        <input type="radio" name="chkfood<?php echo $i;?>" value="" <?php if($rchk == '3'){echo "checked";}?> data-toggle="modal" name="hn" onclick="setHn(<? echo $objReSult['hn'];?>)" href="#myModal" value = "<? echo $objReSult['hn'];?>" required ></center></div></td>
        <input type=hidden name="$new_hn[]" value = <? echo $objReSult["hn"];?> >
  </tr>
  <?
 // $temp = array("a", "b", "c");
  // $_SESSION['hn'] = $new_hn[];
  $test = $_POST['chkfood'.$i];
  $_SESSION['hn'] = $objReSult["hn"];
  $_SESSION['fname'] = $objReSult["fname"];
  }
  ?>

</table>
</div>
  <div class="container">
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-2 col-xs-2"><input type="button" name="" class="btn btn-lg btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูล&nbsp;&nbsp;&nbsp;&nbsp;" data-toggle="modal" data-target="#myModal2"></div>
  </div>
  <br>
  <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">ยืนยันการบันทึกข้อมูลการสั่งอาหาร</h4>
      </div>
      <div class="modal-body">
        <h4>
          <?php
            $sel = "SELECT DISTINCT clinic, clinicdescribe FROM fpatient_info WHERE clinic = '$dep' order by clinicdescribe";
            $res = mysql_query($sel,$connect2);
            $show = mysql_fetch_array($res);
            echo "แผนก : ".$show['clinicdescribe'];
          ?>
       </h4>
       <p>ประจำวันที่ : <?php echo "$day $dayy $mon $year"; ?></p>
       <p>
         มื้ออาหาร :
         <?php if ($eats == 4): ?>
           เช้า
         <?php elseif ($eats == 5): ?>
           กลางวัน
         <?php elseif ($eats == 6): ?>
           เย็น
         <?php endif; ?>
       </p>
       <p>
         <?php
            $sel = "SELECT COUNT(hn) FROM fpatient_info WHERE clinic = '$dep'";
            $res = mysql_query($sel,$connect2);
            $show = mysql_fetch_array($res);
            echo "จำนวนผู้ป่วย : ".$show['COUNT(hn)']." คน";
          ?>
       </p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="บันทึกข้อมูล">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>จัดทำโดย <a href="http://www.cpa.go.th" data-toggle="tooltip">นายนนธวัฒน์&nbsp;จันทร์กระจ่าง</a></p>
</footer>

<script>


function chk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
      list($data1,$data2) = split("_", $test);
        if(x[i].type=="radio"){
            x[i].checked=true;
        }
    }
}

function unchk_all(){
    var x=document.getElementsByTagName("input");
    for(i=0;i<=x.length;i++){
        if(x[i].type=="radio"){
            x[i].checked=false;
        }
    }
}
function del(id,eats){
  $.ajax({
    type: "GET",
    url: "delete_orderfood.php",
    data: {
      'hn': id,
      'eats' : eats,
    }
  });
}

function setHn(id){
  $('#hnModal').html(id);
  $.ajax({
  type: "GET",
  url: "loadPatient.php",
  data: { 'hn': id},
  success:function(response){
    var data = JSON.parse(response);
    $('#clinic').html(data.clinicdescribe);
    $('#fname_modal').html(data.fname);
    $('#lname_modal').html(data.lname);
    console.log(data);
  }
});
 // alert(id);
}
function submitModal(){
  var idFood = $('#idfood').val();
  var hn = $('#hnModal').html();
  var eats = $('#eats2').val();
  var roomno = $('#roomno').val();
  var bedno = $('#bedno').val();
  if(idFood === "" || roomno === "" || bedno === "" || eats === ""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน");
  }
  else{
    alert("เพิ่มข้อมูลสำเร็จ");
     //alert(eats);
   $.ajax({
  type: "POST",
  url: "insert_spec.php",
  data: {
    'hn': hn,
    'food' : idFood,
    'eats2' : eats,
    'roomno' : roomno,
    'bedno' : bedno
  }
})
  .done(function( msg ) {
     $('#myModal').modal('hide');
  });
 }
 document.getElementById("idfood").value = "";
 document.getElementById("roomno").value = "";
 document.getElementById("bedno").value = "";
}

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

<form method="POST" action="insert_spec.php" id="servform">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">การสั่งอาหารเฉพาะโรค</h4>
      </div>

      <div class="modal-body">

      <h4> รหัสผู้ป่วย : <label id="hnModal"></label></h4>
      <h4> แผนก : <span id="clinic"></span></h4>
      <h4> ชื่อผู้ป่วย :&nbsp;<span id="fname_modal"></span> &nbsp;<span id="lname_modal"></span></b></h4>
      <h4>มื้ออาหาร :
  <? if ($eats == 4) {
    # code...
    echo "เช้า";
    ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }

      elseif ($eats == 5) {
      echo "กลางวัน";
      ?>
    <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
    <?
    }
    elseif ($eats == 6) {
      # code...
      echo "เย็น";
      ?>
            <input type=hidden name="eats2" id="eats2" value ="<? echo $eats;?>">
            <?
    }
  ?></h4>

    <h4>ห้อง : <input type="text" name="roomno"  id="roomno"></h4>
    <h4>เตียง : <input type="text" name="bedno"  id="bedno"></h4>
    <h4>ชนิดของอาหาร : <input type="text" name="food"  id="idfood"></h4>
      </div>

      <div class="modal-footer">
        <input type="button" onclick="submitModal()" name= "submit" class="btn btn-success" value = "เพิ่มข้อมูล" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
</div>
</form>
</body>
</html>
