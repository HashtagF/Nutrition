<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{
header('location:login.php');
exit();
}
?>
<?php

?>
<?php
  $date=$_POST['daytime'];
  $check_box1 = $_POST['check_list1'];
  $check_box2 = $_POST['check_list2'];
  $check_box3 = $_POST['check_list3'];
  $check_box4 = $_POST['check_list4'];
  $check_box5 = $_POST['check_list5'];
  $check_box6 = $_POST['check_list6'];
  $check_box7 = $_POST['check_list7'];
  $check_box8 = $_POST['check_list8'];
  $check_box9 = $_POST['check_list9'];
  $check_box10 = $_POST['check_list10'];
  $check_box11 = $_POST['check_list11'];
  $check_box12 = $_POST['check_list12'];
  $check_box13 = $_POST['check_list13'];
  $check_box14 = $_POST['check_list14'];
  $check_box15 = $_POST['check_list15'];
  $deta = $_POST['deta'];
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
  <script type="text/javascript"> 
            function printTable(tableprint) { 
                var printContents = document.getElementById(tableprint).innerHTML; 
                var originalContents = document.body.innerHTML; 
                document.body.innerHTML = printContents; 
                window.print();
                document.body.innerHTML = originalContents; 
            } 
        </script>
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
      <div id="print_table">
       <br />
<?php
$p=$_POST["print"]+1;
 ?>
      <H3>ข้อมูลเมนูอาหาร</H3>
      <br />
      <h5 align=right>พิมพ์ครั้งที : <?php echo $p ;?></h5>่
      <div style="float:left; font-size: 1.5em;">วันที่</div><div style="float:left; font-size: 1.5em;">&nbsp;
      <?php

         $m1=$m2=$m3=$m4=$m5=$m6=$m7=$m8=$m9=$m10=$m11=$m12=$m13=$m14=$m15="";

    $dayy = substr($_POST['daytime'],-2);
    $mon =substr($_POST['daytime'],-5,2);
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
    $year = substr($_POST['daytime'],-10,4);
    $year += 543;
  ?>
      <? echo $dayy." ".$mon." ".$year;?></div>
      <br />
      <br />
      <div style="float:left; font-size: 1.5em;">เจ้าหน้าที่</div><div style="float:left; font-size: 1.5em;">&nbsp;
        <?php echo $_SESSION["fnname"];?>&nbsp;<?php echo $_SESSION["lnname"];?>
      </div>
      <br />

  <?php
  @include('conn.php');
   ?>
    <div class="modal-body">
      <form method="post" action="#">
      <div id="print_table">
          <table class="table table-striped table-bordered" border="1" width="100%">
            <tr class="warning">
              <th></th><th></th><th><div align="center">พิเศษ</th><th><div align="center">สามัญ</th><th><div align="center">เจ้าหน้าที่</th><br />
            </tr>
            <tr class ="info">
              <td align="center"><b>เช้า</td>
              <td></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box1);$i++ ){
                              echo "<h5>".$check_box1[$i]."</h5>";
                              $m1=$m1.$check_box1[$i];
                              if($i<sizeof($check_box1)-1){
                                $m1=$m1." ";
                              }

                          }

                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box2);$i++ ){
                              echo "<h5>".$check_box2[$i]."</h5>";
                              $m2=$m2.$check_box2[$i];
                              if($i<sizeof($check_box2)-1){
                                $m2=$m2." ";
                              }

                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box3);$i++ ){
                              echo "<h5>".$check_box3[$i]."</h5>";
                              $m3=$m3.$check_box3[$i];
                              if($i<sizeof($check_box3)-1){
                                $m3=$m3." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td rowspan="2" align="center"><b>กลางวัน</td>
              <td align="center"><b>ธรรมดา</td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box4);$i++ ){
                              echo "<h5>".$check_box4[$i]."</h5>";
                              $m4=$m4.$check_box4[$i];
                              if($i<sizeof($check_box4)-1){
                                $m4=$m4." ";
                              }
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box5);$i++ ){
                              echo "<h5>".$check_box5[$i]."</h5>";
                              $m5=$m5.$check_box5[$i];
                              if($i<sizeof($check_box5)-1){
                                $m5=$m5." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box6);$i++ ){
                              echo "<h5>".$check_box6[$i]."</h5>";
                              $m6=$m6.$check_box6[$i];
                              if($i<sizeof($check_box6)-1){
                                $m6=$m6." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box7);$i++ ){
                              echo "<h5>".$check_box7[$i]."</h5>";
                              $m7=$m7.$check_box7[$i];
                              if($i<sizeof($check_box7)-1){
                                $m7=$m7." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box8);$i++ ){
                              echo "<h5>".$check_box8[$i]."</h5>";
                              $m8=$m8.$check_box8[$i];
                              if($i<sizeof($check_box8)-1){
                                $m8=$m8." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box9);$i++ ){
                              echo "<h5>".$check_box9[$i]."</h5>";
                              $m9=$m9.$check_box9[$i];
                              if($i<sizeof($check_box9)-1){
                                $m9=$m9." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td td rowspan="2" align="center"><b>เย็น</td>
              <td align="center"><b>ธรรมดา</td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box10);$i++ ){
                              echo "<h5>".$check_box10[$i]."</h5>";
                              $m10=$m10.$check_box10[$i];
                              if($i<sizeof($check_box10)-1){
                                $m10=$m10." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box11);$i++ ){
                              echo "<h5>".$check_box11[$i]."</h5>";
                              $m11=$m11.$check_box11[$i];
                              if($i<sizeof($check_box11)-1){
                                $m11=$m11." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box12);$i++ ){
                              echo "<h5>".$check_box12[$i]."</h5>";
                              $m12=$m12.$check_box12[$i];
                              if($i<sizeof($check_box12)-1){
                                $m12=$m12." ";
                              }
                          }
                        ?></td>
            </tr>
            <tr class ="info">
              <td align="center"><b>อ่อน</td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box13);$i++ ){
                              echo "<h5>".$check_box13[$i]."</h5>";
                              $m13=$m13.$check_box13[$i];
                              if($i<sizeof($check_box13)-1){
                                $m13=$m13." ";
                              }
                          }
                        ?></td>
              <td>
                        <?php
                          for($i = 0; $i<sizeof($check_box14);$i++ ){
                              echo "<h5>".$check_box14[$i]."</h5>";
                              $m14=$m14.$check_box14[$i];
                              if($i<sizeof($check_box14)-1){
                                $m14=$m14." ";
                              }
                          }
                        ?></td>
              <td>
                         <?php
                          for($i = 0; $i<sizeof($check_box15);$i++ ){
                              echo "<h5>".$check_box15[$i]."</h5>";
                              $m15=$m15.$check_box15[$i];
                              if($i<sizeof($check_box15)-1){
                                $m15=$m15." ";
                              }
                          }
                        ?></td>
            </tr>
          </table>
          <h4>หมายเหตุ</h4>&nbsp;&nbsp;
          <?php echo $deta;?>
        </form>
        </div>
<?php
$strSQL = "SELECT * FROM detailmenu";
$objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");

while ($objReSult = mysql_fetch_array($objQuery)) {
# code...

}


$insert = "UPDATE detailmenu SET print='$p', mspec='$m1',msta='$m2',maut='$m3',lpspec='$m4',lpsta='$m5',lpaut='$m6',lsspec='$m7',lssta='$m8',lsaut='$m9',epspec='$m10',epsta='$m11',epaut='$m12',esspec='$m13',essta='$m14',esaut='$m15',comment='$deta' WHERE dm_date='$date' ";
      $query = mysql_query($insert,$connect1);


if(!$insert){
  echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิิดพลาดบางประการ');
      </script>");
}
 ?>

    </div>
   </div>
   <p style="text-align:center;"><button class="btn btn-success" OnClick="printTable('print_table');">พิมพ์ใบสั่งอาหาร</button></p>
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
