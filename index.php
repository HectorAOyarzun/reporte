<?php include('connection.php'); ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

   <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <!-- <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> -->
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Data Table</title>
  <style type="text/css">
    
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box; /* Opcional, pero recomendado */
}
    .btnAdd {
      text-align: right;
     max-width: 100%;
    margin-bottom: 20px;
    }
    body{
      max-width: 100%;
    }
    .container{
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
   
    <div class="card mb-4"><!-- aqui era Row  -->
       <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Hallazgos</div>
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Nuevo Hallazgo</a>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="table-responsive"> <!-- aqui era 8-->
            <table id="example" class=" table table-striped table-bordered "> <!--aqui solo era table-->
              <thead>
                <th>Id</th>
                <th>Category</th>
                <th>Fecha</th>
                <th>Planta</th>
                <th>Área</th>
                <th>Lugar</th>
                <th>Peligro</th>
                <th>Riesgo</th>
                <th>Descripción</th>
                <th>Obervación</th>
                <th>imagen</th>
                <th>Acción</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js" type="text/Javascript"></script>
   <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js" type="text/Javascript"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [10]//aqui habia un 6

          },

         
        ]
          
             
            
      });
    });
    $(document).on('submit', '#addUser', function(e) {
      e.preventDefault();

      var category = $('#addCategoryField').val();
      var planta = $('#addPlantaField').val();
      var area = $('#addAreaField').val();
      var fecha = $('#addFechaField').val();
      var lugar = $('#addLugarField').val();
      var usuario = $('#addUsuarioField').val();
      var riesgo = $('#addRiesgoField').val();
      var descripcion = $('#addDescripcionField').val();
      var observacion = $('#addObservacionField').val();
      var image = $('#addImageField').val();

      if ( category != '' && planta != '' && area != ''  && fecha != '' && lugar != ''&& usuario != '' && riesgo != '' && descripcion != '' && observacion != '' && image != '') {
        $.ajax({
          url: "add_user.php",
          type: "post",
          data: {
           
            category: category,
            planta: planta,
             area: area,
            fecha: fecha,
            lugar: lugar,
            usuario: usuario,
            riesgo: riesgo,
            descripcion: descripcion,
            observacion: observacion,
            image: image
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addUserModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
   
      var category = $('#categoryField').val();
      var planta = $('#plantaField').val();
      var area = $('#areaField').val();
      var fecha = $('#fechaField').val();
      var lugar = $('#lugarField').val();
      var usuario = $('#usuarioField').val();
      var riesgo = $('#riesgoField').val();
      var descripcion = $('#descripcionField').val();
      var observacion = $('#observacionField').val();
      var image = $('#imageField').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if ( category != '' && planta != '' && area != '' && fecha != '' && lugar != '' && usuario != '' && riesgo != '' && descripcion != '' && observacion != '' && image != '') {
        $.ajax({
          url: "update_user.php",
          type: "post",
          data: {
         
            category: category,
            planta: planta,
            area: area,
            fecha: fecha,
            lugar: lugar,
            usuario: usuario,
            riesgo: riesgo,
            descripcion: descripcion,
            observacion: observacion,
            image: image,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
           
              
               //table.cell(parseInt(trid) - 1,0).data(id);
               //table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
  

              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, category, fecha, planta, area, lugar, usuario, riesgo, descripcion, observacion, image,  button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#categoryField').val(json.category);
          $('#fechaField').val(json.fecha);
          $('#plantaField').val(json.planta);
          $('#areaField').val(json.area);
          $('#lugarField').val(json.lugar);
          $('#usuarioField').val(json.usuario);
          $('#riesgoField').val(json.riesgo);
          $('#descripcionField').val(json.descripcion);
          $('#observacionField').val(json.observacion);
          $('#imageField').val(json.image);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "delete_user.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }



    })
  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Hallazgo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="categoryField" class="col-md-3 form-label">Category</label>
              <div class="col-md-9">
          <select class="form-control" id="categoryField" name="category">
            <?php
            $categories = array("Acción insegura", "Condición insegura"); 
            foreach ($categories as $category) {
                echo "<option value='$category'>$category</option>";
            }
            ?>
        </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="fechaField" class="col-md-3 form-label">Fecha</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="fechaField" name="fecha">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="plantaField" class="col-md-3 form-label">Planta</label>
              <div class="col-md-9">
              
                <select class="form-control" id="plantaField" name="planta">
                  <?php
                  $categories = array("Riesgo Bajo", "Moderado", "altp");
                  foreach ($categories as $planta){
                     echo "<option value='$planta'>$planta</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="areaField" class="col-md-3 form-label">Área</label>
              <div class="col-md-9">
                 <select class="form-control" id="areaField" name="area">
                  <?php
                  $areas = array("Bodega", "Despacho", "Recepcion", "Envasado", "Mantencion");
                  foreach ($areas as $area){
                     echo "<option value='$area'>$area</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
             <div class="mb-3 row">
              <label for="lugarField" class="col-md-3 form-label">Lugar</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="lugarField" name="lugar">
              </div>
            </div>
             <div class="mb-3 row">
              <label for="usuarioField" class="col-md-3 form-label">Peligro</label>
              <div class="col-md-9">
                    <select class="form-control" id="usuarioField" name="usuario">
                  <?php
                  $usuarios = array("Selecciona una opcion", "Contacto con vehiculos en movimiento", "Contacto con sustancias quimicas", "Trabajo en altura", "Contacto con proyeccion de particulas", "Contacto con objetos");
                  foreach ($usuarios as $usuario){
                     echo "<option value='$usuario'>$usuario</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
             <div  class="mb-3 row">
              <label  for="riesgoField" class="col-md-3 form-label">Riesgo</label>
              <div class="col-md-9">
                    <select class="form-control" id="riesgoField" name="riesgo">
                  <?php
                  $riesgos = array("Selecciona una opcion", "Atropello", "Colision", "Choque", "Irritacion", "Quemadura quimica", "Intoxicacion", "Dano ambiental", "Incendio o explosion", 
                  "caida a distinto nivel", "Caida a mismo nivel", "Lesiones oculares", "lesiones cutaneas", "Contaminacion del ambiente", "golpeado por");
                  foreach ($riesgos as $riesgo){
                     echo "<option value='$riesgo'>$riesgo</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
             <div class="mb-3 row">
              <label for="descripcionField" class="col-md-3 form-label">Descripción</label>
              <div class="col-md-9">
                <textarea type="text" class="form-control" id="descripcionField" name="descripcion"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="observacionField" class="col-md-3 form-label">Observación</label>
              <div class="col-md-9">
                <textarea type="text" class="form-control" id="observacionField" name="observacion"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="imageField" class="col-md-3 form-label">Imagen</label>
              <div class="col-md-9">
                <input type="img" class="form-control" id="imageField" name="iamge">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  


<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Hallazgo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addCategoryField" class="col-md-3 form-label">Category</label>
              <div class="col-md-9">
                    <select class="form-control" id="addCategoryField" name="Category">
                    <?php
                     $categories = array("Selecciona una opcion","Acción insegura", "Condición insegura"); 
                     foreach ($categories as $category) {
                    echo "<option value='$category'>$category</option>";
                   }
                    ?>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addFechaField" class="col-md-3 form-label">Fecha</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="addFechaField" name="Fecha">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addPlantaField" class="col-md-3 form-label">Planta</label>
              <div class="col-md-9">
                
                  <select class="form-control" id="addPlantaField" name="Planta">
                  <?php
                  $categories = array("Selecciona una opcion", "Osorno", "Los Lagos", "Frutillar", "Purranque", "Puyehue");
                  foreach ($categories as $planta){
                     echo "<option value='$planta'>$planta</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addAreaField" class="col-md-3 form-label">Área</label>
              <div class="col-md-9">
                  <select class="form-control" id="addAreaField" name="Area">
                  <?php
                  $areas = array("Selecciona una opcion", "Bodega", "Despacho", "Recepcion", "Envasado", "Mantencion");
                  foreach ($areas as $area){
                     echo "<option value='$area'>$area</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addLugarField" class="col-md-3 form-label">Lugar</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addLugarField" name="lugar">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addUsuarioField" class="col-md-3 form-label">Peligro</label>
              <div class="col-md-9">
             
                 <div class="col-md-9">
                    <select class="form-control" id="addUsuarioField" name="usuario">
                  <?php
                  $usuarios = array("Selecciona una opcion", "Contacto con vehiculos en movimiento", "Contacto con sustancias quimicas", "Trabajo en altura", "Contacto con proyeccion de particulas", "Contacto con objetos");
                  foreach ($usuarios as $usuario){
                     echo "<option value='$usuario'>$usuario</option>";
                  }
                  ?>

                </select>
              </div>
              </div>
            </div>
               <div class="mb-3 row">
              <label for="addRiesgoField" class="col-md-3 form-label">Riesgo</label>
              <div class="col-md-9">
           

                    <select class="form-control" id="addRiesgoField" name="riesgo">
                  <?php
                  $riesgos = array("Selecciona una opcion", "Atropello", "Colision", "Choque", "Irritacion", "Quemadura quimica", "Intoxicacion", "Dano ambiental", "Incendio o explosion", 
                  "caida a distinto nivel", "Caida a mismo nivel", "Lesiones oculares", "lesiones cutaneas", "Contaminacion del ambiente", "golpeado por");
                  foreach ($riesgos as $riesgo){
                     echo "<option value='$riesgo'>$riesgo</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addDescripcionField" class="col-md-3 form-label">Descripción</label>
              <div class="col-md-9">
                <textarea type="text" class="form-control" id="addDescripcionField" name="Descripcion"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addObservacionField" class="col-md-3 form-label">Observación</label>
              <div class="col-md-9">
              <textarea type="text" class="form-control" id="addObservacionField" name="Observacion"></textarea>
              </div>
            </div>
              <div class="mb-3 row">
              <label for="addImageField" class="col-md-3 form-label">Imagen</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addImageField" name="Image">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
         <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; prevesafe 2019 Versión 1.0</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
							</div>
						</div>
					</div>
				</footer>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>




<script>
   //ingresar nuevos usuarios 
    const peligroAddRiesgoMap = {
       "Selecciona una opcion": ["Digita una opcion"],
        "Contacto con vehiculos en movimiento": ["Atropello", "Colision", "Choque"],
        "Contacto con sustancias quimicas": ["Irritacion","Quemadura quimica", "Intoxicacion", "Dano ambiental", "Incendio o explosion"],
        "Trabajo en altura": ["caida a distinto nivel", "Caida a mismo nivel"],
        "Contacto con proyeccion de particulas": ["Lesiones oculares", "lesiones cutaneas", "Contaminacion del ambiente"],
        "Contacto con objetos": ["Golpeado por"],
      
    };


    const peligroAddSelect = document.getElementById('addUsuarioField');
    const riesgoAddSelect = document.getElementById('addRiesgoField');


    function actualizarRiesgos2() {
        const peligroSeleccionado = peligroAddSelect.value;
        const riesgosDisponibles = peligroAddRiesgoMap[peligroSeleccionado] || []; 

   
        riesgoAddSelect.innerHTML = '';

   
        riesgosDisponibles.forEach(riesgo => {
            const option = document.createElement('option');
            option.value = riesgo;
            option.text = riesgo;
            riesgoAddSelect.add(option);
        });
    }


    peligroAddSelect.addEventListener('change', actualizarRiesgos2);


    actualizarRiesgos2();
</script> 