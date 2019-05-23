<?php
$con=mysqli_connect("localhost","kasutaja","parool","e_postid");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM Epost");

echo "<table border='1'>
<tr>
<th>Nr</th>
<th>Eesnimi</th>
<th>Perenimi</th>
<th>Epost</th>
<th>Asutus</th>
<th>Ametikoht</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['Nr'] . "</td>";
echo "<td>" . $row['Eesnimi'] . "</td>";
echo "<td>" . $row['Perenimi'] . "</td>";
echo "<td>" . $row['Epost'] . "</td>";
echo "<td>" . $row['Asutus'] . "</td>";
echo "<td>" . $row['Ametikoht'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>

<?php
//if "Epost" variable is filled out, send Epost
  if (isset($_REQUEST['Epost']))  {

  //Email information
  $admin_Epost = "ajoessar@gmail.com";
  $Epost = $_REQUEST['Epost'];
  $subject = $_REQUEST['subject'];
  $comment = $_REQUEST['comment'];
  $headers = "From: ants.joessar@khk.ee\r\n";
  $headers .= "Reply-To: ants.joessar@khk.ee\r\n";
  $headers .= "Return-Path: ants.joessar@khk.ee\r\n";
  $headers .= "CC: ants.joessar@khk.ee\r\n";
  $headers .= "BCC: ants.joessar@khk.ee\r\n";

  //send Epost
  mail($admin_Epost, $admin_Password, "$subject", $comment, "From:" . $Epost);
  sleep(4);
  //Epost response
  echo "Thank you for contacting us!";
  }

  //if "Epost" variable is not filled out, display the form
  else  {
?>

 <form method="post">

  Epost: <input name="Epost" type="text" />

  Teema: <input name="subject" type="text" />

  Sõnum:

  <textarea name="comment" rows="15" cols="40"></textarea>

  <input type="submit" value="Saada" />
  </form>

<?php
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.nooruse.ee/application/files/6815/0289/1291/korgkooli_logo-500px.jpg">
<html>
<img src="/root/korgkooli_logo-500px.jpg" width="280" height="125" title="Kooli logo" alt="Kooli logo" />

</html>
';
?>

<?php
  }
mysqli_close($con);
?>
