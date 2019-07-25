

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <style>

</style>
</head>
<body>
<div class="row">
  <div class="left" style="background-color:#bbb;">
    <h2>Menu</h2>
    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    <ul id="myMenu">
      <li><a href="index.php">table 1</a></li>
      <li><a href="table2.php">table 2</a></li>
      <li><a href="#">table 3</a></li>
      <li><a href="#">table 4</a></li>
      <li><a href="#">table 5</a></li>
      <li><a href="#">table 6</a></li>
      <li><a href="#">table 7</a></li>
      <li><a href="#">table 8</a></li>
      <li><a href="#">table 9</a></li>
      <li><a href="#">table 10</a></li>
    </ul>
</div>
  <div class="right" style="background-color:#d9d9d9;">
    <div class="div-header">
<form style="position: absolute;">
  <input type="texts" name="search" placeholder="Search..">
</form>
    <h2 style="text-align: center;">Product</h2>
    </div>
  </div>
 <table style="position: absolute;margin-left: 415%;">
  <tr>
    <th>Porduct Name</th>
    <th>Unit price</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Delete</th>
  </tr>
  <tr>
    <td>Chicken Burger</td>
    <td>100</td>
    <td>2</td>
    <td>200</td>
    <td>try</td>
  </tr>
  <tr>
    <td>Dacca Fish</td>
    <td>100</td>
    <td>1</td>
    <td>200</td>
  </tr>
  <tr>
    <td>Corn Soup</td>
    <td>100</td>
    <td>6</td>
    <td>200</td>
  </tr>
  <tr>
    <td>Thai Soup</td>
    <td>100</td>
    <td>1</td>
    <td>200</td>
  </tr>
  <tr>
    <td>Special Soup</td>
    <td>100</td>
    <td>3</td>
    <td>200</td>
  </tr>
  <tr>
    <td>Fried Fish</td>
    <td>100</td>
    <td>1</td>
    <td>200</td>
  </tr>
    <tr>
    <td>Finger Fish</td>
    <td>100</td>
    <td>2</td>
    <td>200</td>
  </tr>
    <tr>
    <td>Hot Soup</td>
    <td>100</td>
    <td>5</td>
    <td>200</td>
  </tr>
    <tr>
    <td>Chow men</td>
    <td>100</td>
    <td>2</td>
    <td>200</td>
  </tr>
</table>
<!--total-->
<div class="containery">
  <div class="div-1">
    <p style="position: absolute;margin-left: 10px;font-size: 25px;margin-top: 9px;color: #e6b800;">Total :<b style="color: #2e5cb8;"> 2801</b></p>
  </div>
  <a href="#">
  <div class="div-2">
   <p style="position: absolute;color: white;font-size: 20px;margin-top: 2.5%;margin-left: 50px;">Fast Cash</p>
    </a>
    <a href="#">
    <div class="div-3">
      <p style="position: absolute;color: white;font-size: 20px;margin-top: 2.5%;margin-left: 50px;">Check Out</p>
    </a>
  </div>
  </div>
  
</div>
    
    <?php
include("db_conection.php");
$results = mysqli_query($dbcon,"SELECT * FROM `items`");
while($row = mysqli_fetch_array($results)) {   
?>
  <!-- borders of the product-->
  <div class="div-border1">
    <tr>
        <td>
        <a href="save.php?id='.$row['item_id'].'&product='.$row['item_name'].'&up='.$row['item_price'].'&qty=1" class="btn btn-primary">
        <div class="div-container1">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
            <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>  </div></a>
            </td>
    </tr>
    <tr>
        <td>
   <div class="div-container2">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>  </div></td></tr>

    <div class="div-container3">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>  </div>

    <div class="div-container4">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>  </div>
</div>

   <div class="div-border1">
<br><br><br><br><br><br><br><br><br><br>
  <div class="div-container1">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>
  </div>

   <div class="div-container2">
        <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>
  </div>

    <div class="div-container3">
        <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>
  </div>

    <div class="div-container4">
    <img src="item_images/<?php echo $row['item_image']; ?>" class="img img-rounded" />
    <p><?php echo $row['item_name'] ?><br><p style="margin-left: 30px;margin-top: -12px;"><b>Only <?php echo $row['item_price'] ?> Frw</b></p>  </div>
</div>

<?php } ?>

<script>
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("mySearch");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myMenu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>


</body>
</html>