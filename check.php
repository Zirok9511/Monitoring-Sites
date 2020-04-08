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
  function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$to_email = 'dev@orbitweb.ca';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail ';
$headers = 'From: zirokguadron11@gmail.com';
//check if the email address is invalid $secure_check
$secure_check = sanitize_my_email($to_email);
if ($secure_check == false) {
    echo "Invalid input";
} else { //send email 
    mail($to_email, $subject, $message, $headers);
    echo "This email is sent using PHP Mail";
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
          echo '<img style="width: 25px; height: 25px; padding-left: 78px" src="'.$nope.'"/></ul>';
	echo '<button id="btn_borrar" name="btn_borrar" onclick="borrar('.$row["id"].');" type="submit" class="cancel">Delete</button><hr/>';
          //Invoco la funcion y le mando el parametro para dar el nombre del sitio caido
          send_email($row["nombre"]);
        }
        else { 
          //Si no esta caido
          echo  "<li style='font-size: 15px'>"."id:" .$row["id"]. "<li style='font-size: 15px'>Name of Site: " . $row["nombre"]. "<li style='font-size: 15px'>Url of Site:" . $row["url"]."</li><ul style='font-size: 15px; margin-left:500px; margin-top:-30px'>is Up!";
          echo '<img class="check"  src="'.$yes.'"/></ul>'; 
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

        alert('It was deleted correctly');
        window.location="#";
}
</script>
  </body>
</html>
