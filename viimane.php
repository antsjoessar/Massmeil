<?php

$pdo = new PDO('mysql:host=localhost;dbname=e_postid', 'kasutaja', 'parool');			// andmbaasiga ühenduse loomine
$sql = "SELECT Epost FROM Epost";								// andmebaasist õige tabeli valimine

    foreach ($pdo->query($sql) as $row) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); 									// lihtnemeiliedastus protokoll (SMTP) lubatud
        $mail->SMTPDebug = 1; 									// debugging: 1 = error ja sõnum, 2 = sõnum ainult, 0 = mitte midagi
        $mail->CharSet = "UTF-8";								// teisendusvorming
        $mail->SMTPAuth = true; 								// audentimine lubatud
        $mail->SMTPSecure = 'ssl'; 								// turvasoklite kihi protokoll secure transfer enabled REQUIRED for Gmail
        $mail->Host = 'smtp.gmail.com';								// gmaili meiliserveri aadress
        $mail->Port = 465; 									// pordid TLS=587, SSL=465, random=25
        $mail->IsHTML(true);									// märgistuskeele (HTML) lubamine
        $mail->Username = 'ants.joessar@khk.ee';						// e-posti aadress, kus kohat kiri väljub
        $mail->Password = 'parool';								// parool
        $mail->SetFrom('ants.joessar@khk.ee', 'Ants Joessar');					// saatja e-post ja nimi
        $mail->Subject = $_POST['subject'];							// e-posti teema
        $mail->Body = $_POST['message'];							// e-posti sisu
        $mail->AddAddress($row['Epost']); 							// dünaamiline e-post andmebaasist iga silmusega
    }

if(!$mail->Send())
{
   echo "Esines viga saatmisel: " . $mail->ErrorInfo;
}
else
{
   echo "Meil saadetud!";
}
?>
<html>
<body>
<form method='POST' action='viimane.php'>
Subject: <input name='subject' type='text' />
Message:
<textarea name='message' rows='15' cols='40'>
</textarea>
<input type='submit'/>
</body>
</html>

