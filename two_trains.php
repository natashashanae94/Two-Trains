<?php
/*Natasha Johnson
  CTP 130-840
  Lab #6*/

  $speedA = $_POST['trainA'];
  $speedB = $_POST['trainB'];
  $distance = $_POST['distance'];
  $errorCount = 0;
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Two Trains</title>
  </head>
  <body>
    <!--PURPOSE: This program calculates the the speed
     of two trains and the distance between them
     before they cross paths-->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  validateForm($speedA, $speedB, $distance, $errorCount);
}

function validateForm($speedA, $speedB, $distance,$errorCount) {

  if(!empty($speedA) && is_numeric($speedA)){
    if($speedA < 1) {
      print "<p>\"Speed of Train A\" must be greater than zero.</p>";
      $speedA = "";
      $errorCount++;
    }
  } else {
    print "<p>\"Speed of Train A\" is a required field.</p>";
    $speedA = "";
    $errorCount++;
  }

  if(!empty($speedB) && is_numeric($speedB)){
    if($speedB < 1) {
      print "<p>\"Speed of Train B\" must be greater than zero.</p>";
      $speedB = "";
      $errorCount++;
    }
  } else {
    print "<p>\"Speed of Train B\" is a required field.</p>";
    $speedB = "";
    $errorCount++;
  }


  if(!empty($distance) && is_numeric($distance)){
    if($distance < 1){
      print "<p>\"Distance between trains\" must be greater than zero.</p>";
      $distance = "";
      $errorCount++;
    }
  } else {
    print "<p>\"Distance between trains\" is a required field.</p>";
    $distance = "";
    $errorCount++;
  }

  if($errorCount > 0){
    print "<p>Please re-enter the form information below.</p>";
  }

  showForm($speedA, $speedB, $distance, $errorCount);
}

function showForm($speedA, $speedB, $distance, $errorCount) {
?>
<script type="text/javascript">
  function resetForm() {
    document.getElementById("trainA").value = "";
    document.getElementById("trainB").value = "";
    document.getElementById("distance").value = "";
  }
</script>

<!--STICKY FORM-->
  <form id="myForm" method="POST" action="">
    <table>
      <tr>
        <th><h1>Two Trains</h1></th>
      </tr>
      <tr>
        <td>Speed of Train A:</td>
        <td><input type="text" id="trainA" name="trainA" value="<?php echo $speedA ?>"> mph</td>
      </tr>
      <tr>
        <td>Speed of Train B:</td>
        <td><input type="text" id="trainB" name="trainB" value="<?php echo $speedB ?>"> mph</td>
      </tr>
      <tr>
        <td>Distance between trains:</td>
        <td><input type="text" id="distance" name="distance" value="<?php echo $distance ?>"> miles</td>
      </tr>
      <tr>
        <td>
          <input type="button" name="reset" value="Clear Form" onclick="resetForm();">
          <input type="submit" name="submit" value="Send Form">
        </td>
      </tr>
    </table>
  </form>
<?php
  if ($errorCount === 0) {

    if ($speedA == 0 || $speedB == 0){
      echo "<p>Division by zero is not allowed.</p>";
    }
    $distanceA = (($speedA/$speedB)*$distance)/(1+($speedA/$speedB));
    $distanceB = $distance - $distanceA;
    $timeA = $distance - $distanceA;
    $timeB = $distance - $distanceB;
    $sum = $distanceA + $distanceB;

    echo "<p>Train A traveled ". number_format($distanceA, 2)." miles in ". number_format($timeA, 2)." hours at $speedA mph.</p>";
    echo "<p>Train B traveled ". number_format($distanceB, 2)." miles in ". number_format($timeB, 2)." hours at $speedB mph.</p>";
    echo "<p>The sum of the two distances is $sum miles.</p>";
  }

} ?>
  </body>
</html>
