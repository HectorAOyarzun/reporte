<?php 
include('connection.php');
$category = $_POST['category'];
$fecha = $_POST['fecha'];
$planta = $_POST['planta'];
$area = $_POST['area'];
$lugar = $_POST['lugar'];
$usuario = $_POST['usuario'];
$riesgo = $_POST['riesgo'];
$descripcion = $_POST['descripcion'];
$observacion = $_POST['observacion'];
$image = $_POST['image'];

$sql = "INSERT INTO `users` (`category`,`fecha`,`planta`,`area`,`lugar`,`usuario`,`riesgo`,`descripcion`,`observacion`,`image`) values ('$category', '$fecha', '$planta', '$area', '$lugar' , '$usuario', '$riesgo', '$descripcion', '$observacion', '$image' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>