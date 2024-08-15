<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM users ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'category',
	2 => 'fecha',
	3 => 'planta',
	4 => 'area',
	5 => 'lugar',
	6 => 'usuario',
	7 => 'riesgo',
	8 => 'descripcion',
	9 => 'observacion',
	10 => 'image',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE Category like '%".$search_value."%'";
	$sql .= " OR fecha like '%".$search_value."%'";
	$sql .= " OR planta like '%".$search_value."%'";
	$sql .= " OR area like '%".$search_value."%'";
	$sql .= " OR lugar like '%".$search_value."%'";
	$sql .= " OR usuario like '%".$search_value."%'";
	$sql .= " OR riesgo like '%".$search_value."%'";
	$sql .= " OR descripcion like '%".$search_value."%'";
	$sql .= " OR observacion like '%".$search_value."%'";
	$sql .= " OR image like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['category'];
	$sub_array[] = $row['fecha'];
	$sub_array[] = $row['planta'];
	$sub_array[] = $row['area'];
	$sub_array[] = $row['lugar'];
	$sub_array[] = $row['usuario'];
	$sub_array[] = $row['riesgo'];
	$sub_array[] = $row['descripcion'];
	$sub_array[] = $row['observacion'];
	$sub_array[] = $row['image'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
