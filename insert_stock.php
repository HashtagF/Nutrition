<?php
include ('conn.php');
session_start();
if($_SESSION["Username"]=="") // ตรวจสอบว่าผ่านการ login หรือไม่
{


header('location:login.php');
exit();
}
$username=$_SESSION["Username"];
include 'header.php';
?>
<div class="container">
  <div class="jumbotron">
         <br>
        <p>ข้อมูลสต๊อก</p>
        <?php
          $num = 0;
          $sql = "SELECT COUNT(id_stock) FROM stock";
          $objQuery = mysql_query($sql,$connect1);
          $row = mysql_fetch_array($objQuery);
          $num = $row['COUNT(id_stock)'] + 1;
          $sql = "SELECT * FROM stock";
          $objQuery = mysql_query($sql,$connect1);
         ?>
    <div class="modal-body">
       <div class="modal-body">
           <form method="POST" action="#" onsubmit="return confirm('ต้องการเพิ่มข้อมูลนี้?');">
                      <h4> รหัสสต๊อก &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<input type="text" name="id" value="stock-<?php echo $num; ?>" readonly=""></h4>
                      <h4> ประเภทสต๊อก : &nbsp;<input type="text" name="name" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')"><font color="red"> &nbsp;</font><?php if($flag==1)echo "<font color=red>*ชื่อนี้มีในระบบแล้ว</font>"; ?></h4>

           <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล" name = "submit" onclick="submitModal()"> &nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp; <a href="matandunit.php"><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirm('ต้องการยกเลิกการเพิ่มข้อมูลนี้?')">ยกเลิก</button></a>
          </div>
          </form>
      </div>
    </div>
    <?php
        if($_POST){
          $stockid = $_POST['id'];
          $stockname = $_POST['name'];
          $sql = "INSERT INTO stock (id_stock,name_stock) VALUES ('$stockid','$stockname')";
          $objQuery = mysql_query($sql,$connect1);

          if(!$objQuery){
           echo( "<script> alert('ไม่สามารถเพิ่มข้อมูลได้ เกิดข้อผิดพลาดบางประการ');
               </script>");
          }
          else {
            echo( "<script> alert('เพิ่มข้อมูลสำเร็จ');</script>");
            echo( "<script>window.location='insert_stock.php';</script>");
          }
        }
     ?>
  </div>
<form method="get" action="?Search=1">
  <div class="text-right">
    <font color=white> ค้นหาจากประเภทสต๊อก : </font></label> <input type="text" name="sen" >
    <input type="submit" class="btn btn-success" name="submit2" value="ค้นหา">
  </div>
</form>
<br>

<table class="table table-striped table-bordered">
  <tr class="warning">
    <th><div align="center">รหัสสต๊อก</div></th>
    <th><div align="center">ประเภทสต๊อก</div></th>
    <th><div align="center">แก้ไขข้อมูล</div></th>
    <th><div align="center">ลบข้อมูล</div></th>
  </tr>
  <?php if ($_GET): ?>
    <?php
          $see=$_GET["sen"];
          $strSQL = "SELECT * FROM stock where name_stock like '%$see%' order by id_stock";
          $objQuery = mysql_query($strSQL,$connect1) or die("Error Query [".$strSQL."]");
          $num=mysql_num_rows($objQuery);
          if($num==0){
            echo"<script language=\"JavaScript\">";

          echo"alert('ไม่พบข้อมูล')";

          echo"</script>";
          echo( "<script>window.location='insert_stock.php';</script>");
        }
     ?>
    <?php
    while ($objReSult = mysql_fetch_array($objQuery)) {
      # code...
    ?>
      <tr class ="info">
      <td><div align = "center"><?php echo $objReSult["id_stock"];?></div></td>
      <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
      <td><div align = "center"><a href='edit_stock.php?id=<? echo $objReSult['id_stock']?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
      <td><div align = "center"><a href='delete_stock.php?id=<? echo $objReSult['id_stock']?>'
      onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

        </tr>
      <?
    }

    ?>
    </table>
  <?php endif; ?>
<?


while ($objReSult = mysql_fetch_array($objQuery)) {
  # code...
?>
  <tr class ="info">
  <td><div align = "center"><?php echo $objReSult["id_stock"];?></div></td>
  <td><div align = "left"><? echo $objReSult["name_stock"];?></div></td>
  <td><div align = "center"><a href='edit_stock.php?id=<? echo $objReSult['id_stock']?>' onclick="return confirm('ต้องการแก้ไขข้อมูลนี้?')"><b><font color="blue"><img src='img/edit.png' width=25></font></b></a></td>
  <td><div align = "center"><a href='delete_stock.php?id=<? echo $objReSult['id_stock']?>'
  onclick="return confirm('ยืนยันการลบข้อมูล')"><b><font color="red"><img src='img/delete.png' width=25></font></b></a></td>

    </tr>
  <?
}

?>
</table>
</div>


<?php include 'footer.php'; ?>
