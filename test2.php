<!DOCTYPE html>
 <html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<script src="jquery-3.4.1.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
<div id="targetDiv"></div>
    <!--
      EL script que hace el reload, trabaja con milisegundos
     -->
    <script>
      setTimeout(function(){
   window.location.reload(1);
}, 10000);
    </script>
  <?php
/**
 * PHP/cURL function to check a web site status. If HTTP status is not 200 or 302, or
 * the requests takes longer than 10 seconds, the website is unreachable.
 */

/**
 * Incluyendo la conexion 
 */
include('connection.php');


//THis function make the email 
function send_email($site){
  require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'email-smtp.us-east-1.amazonaws.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'AKIA4UYIPFNQX63GWG63';                 // SMTP username
$mail->Password = 'BCKDQoU3nsty5zZPGAjw1muT1TEt6BIFVEE+yS4viSiX';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587 ;                                    // TCP port to connect to

$mail->setFrom('dev@orbitweb.ca', 'Sites Monitoring');
$mail->addAddress('dev@orbitweb.ca', 'Developers');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sites Monitoring';
$mail->Body    = 'The site with the name: '.$site.'  is Down, please check it<br/> Att: Orbitweb Developers';
$mail->AltBody = 'Some Site is Down, please check it<br/> Att: Orbitweb Developers';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '';
}
}

//La funcion que verifica el estado del sitio
function url_test( $url ) {
  $timeout = 10;
  $ch = curl_init();
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
  $http_respond = curl_exec($ch);
  $http_respond = trim( strip_tags( $http_respond ) );
  $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
  if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
    return true;
  } else {
    // return $http_code;, possible too
    return false;
  }
  curl_close( $ch );
}

$yes = "tick.png";
$nope = "minus.png";


$sql = "SELECT * FROM sitios";
$result = $conn->query($sql);

if ($result->num_rows >= 0) {
  echo  "<ul class='tContent'>";
    while($row = $result->fetch_assoc()) {
        //hago la condicional para determinar que sitio esta caido 
        if( !url_test( $row["url"] ) ) {
          //SI el sitio esta caido
          echo  "<li style='font-size: 15px'>"."id:" .$row["id"]. "<li style='font-size: 15px'>Name of Site: " . $row["nombre"]. "<li style='font-size: 15px'>Url of Site:" . $row["url"]."</li><ul style='font-size: 15px; margin-left:500px; margin-top:-30px'>is Down!";
          echo '<img style="width: 25px; height: 25px; padding-left: 78px" src="'.$nope.'"/></ul><hr/>';
	echo '<button id="btn_borrar" name="btn_borrar" onclick="borrar('.$row["id"].');" type="submit" class="cancel">Delete</button><hr/>';
          //Invoco la funcion y le mando el parametro para dar el nombre del sitio caido
          send_email($row["nombre"]);
        }
        else { 
          //Si no esta caido
          echo  "<li style='font-size: 15px'>"."id:" .$row["id"]. "<li style='font-size: 15px'>Name of Site: " . $row["nombre"]. "<li style='font-size: 15px'>Url of Site:" . $row["url"]."</li><ul style='font-size: 15px; margin-left:500px; margin-top:-30px'>is Up!";
          echo '<img class="check"  src="'.$yes.'"/></ul><hr/>'; 
	echo '<button id="btn_borrar" onclick="borrar('.$row["id"].');" name="btn_borrar" type="button" class="cancel">Delete</button><hr/>';
}
        
    }
    echo  "</ul>";
} else {
  //Si no hay resultados en la BD
    echo "0 results";
}

?>    
    <script type="text/javascript">
function borrar(id) {
  $.post('delete.php', {
            Id: id,
        },
        function(data, status) {
            $('#targetDiv').html(data);
            //alert(data);
        });

        alert('se borro correctamente');
        window.location="index.html";
}
</script>
  </body>
</html>
