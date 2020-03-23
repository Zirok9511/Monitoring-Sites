<?php
/**
 * PHP/cURL function to check a web site status. If HTTP status is not 200 or 302, or
 * the requests takes longer than 10 seconds, the website is unreachable.
 */
/**
 * Incluyendo la conexion 
 */
include('connection.php');





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

if ($result->num_rows > 0) {
  echo  "<ul>";
    while($row = $result->fetch_assoc()) {
        
        
        echo  "<li>"."id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["url"]."</li>";
               
        if( !url_test( $row["url"] ) ) {
          echo $row["url"] ." is down!";
          echo '<img class="check" src="'.$nope.'"/>';
        }
        else { echo $row["url"] ." is Up!"; }
        echo '<img class="check" src="'.$yes.'"/>';
    }
    echo  "</ul>";
} else {
    echo "0 results";
}

?>