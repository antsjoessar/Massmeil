<?php
$servername = "localhost";
$username = "kasutaja";
$password = "parool";
$dbname = "e_postid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Nr, Eesnimi, Perenimi, Epost  FROM Epost";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Nr: " . $row["Nr"]. " - Eesnimi: " . $row["Eesnimi"]. " - Perenimi: " . $row["Perenimi"]. " - Epost: " . $row["Epost"]. "<br>";
    }
} else {
    echo "0 results";
}
?>

<?php
//if "Epost" variable is filled out, send Epost
  if (isset($_REQUEST['Epost']))  {

  //Email information
  $admin_Epost = "epost@aadress.ee";
  $Epost = $_REQUEST['Epost'];
  $subject = $_REQUEST['subject'];
  $comment = $_REQUEST['comment'];
  $headers = "From: ants.joessar@khk.ee\r\n";
  $headers .= "Reply-To: ants.joessar@khk.ee\r\n";
  $headers .= "BCC: ants.joessar@khk.ee\r\n";

  //send Epost
  mail($admin_Epost, $admin_Password, "$subject", $comment, "From:" . $Epost);
  sleep(4);
  //Epost response
  echo "Thank you for contacting us!";
  }

  //if "Epost" variable is not filled out, display the form
  else  {
$conn->close();
?>

 <form method="post">

  Epost: <input name="Epost" type="text" />

  Subject: <input name="subject" type="text" />

  Message:

  <textarea name="comment" rows="15" cols="40"></textarea>

  <input type="submit" value="Submit" />
  </form>

<?php
  }
?>

