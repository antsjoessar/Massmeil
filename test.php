<?php
$con=mysqli_connect("localhost","kasutaja","parool","e_postid");
// Kontrollib ühendust
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
?>

<?php
//kui "Epost" väli on täidetud, saada Epost
  if (isset($_REQUEST['Epost']))  {

  //Epost andmed
  $admin_Epost = $_REQUEST['Epost'];
  $Epost = "ants.joessar@khk.ee";
  $subject = $_REQUEST['subject'];
  $comment = $_REQUEST['comment'];
  //saada Epost
  mail($admin_Epost, "$subject", $comment, "From:" . $Epost);
  sleep(4);
  //Epost vastus
  echo "Kiri on välja saadetud!";
  }

  //kui "Epost" väli on tühi, kuva algvorm 
else  {
?>

 <form method="post">

  Saaja: <input name="Epost" type="text" />
   
  Teema: <input name="subject" type="text" />

  Sõnum:

  <textarea name="comment" rows="15" cols="40"></textarea>

  <input type="submit" value="Saada" />
  </form>

<?php
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.nooruse.ee/applica$
<html>
<img src="/root/korgkooli_logo-500px.jpg" width="280" height="125" title="Kooli l$
</html>
';
?>

<?php
  }
mysqli_close($con);
?>
