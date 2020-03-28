<?php
if(isset($_POST["Id"]))
{
    include('connection.php');

    $sql = "delete from sitios where id = ".$_POST["Id"];
    //echo $sql;
    $resultado = mysqli_query($conn, $sql);

    mysqli_close($conn);
}
 ?>
