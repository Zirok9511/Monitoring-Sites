<?php
   include('connection.php');
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add new Site</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <center>
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
    <div >
            <label class="titulos">Name of site:</label><br/><br/>
            <div >
                <input type="text"  name="name" id="name"  class="este"   autofocus="true">
            </div>
        </div> 
        <div class="form-group">
            <label class="titulos">Url</label><br/><br/>
            <div >
                <input type="text"  name="url" id="url"  class="este"   autofocus="true">
            </div>
        </div> 
    <div class="form-group" align="center">
            <button id="btn_aceptar" name="btn_aceptar" type="submit" class="hecho">Done</button>
            &nbsp;&nbsp;&nbsp;
            <a href="add.php"> <input type="button"  value="  Cancel  " class="cancel"></a>

        </div>        
        <?php
/**
 * creating variables for each of values in the fields
 */
if(isset($_POST["btn_aceptar"])){
 $name = $_POST['name'];
 $url=$_POST['url'];
 /**
  * the query for insert values from fields
  */
 $sql="insert into sitios(nombre, url) values ('$name', '$url')";
 //echo $sql; //just for view the syntax of query
 $resultado = mysqli_query($conn, $sql);
 if ($resultado) {
    echo 'Sitio Agregado Correctamente';
    
} else {
    echo ' No se pudo agregar sitio';   
}
}
?>
</form>
</center>
        <script src="" async defer></script>
    </body>
</html>
