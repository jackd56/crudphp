<?php
    require 'funciones.php';
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=GestionActivos','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
	SELECT * FROM Activos");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY ACTIVOS PARA MOSTRAR';
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>GESTION DE ACTIVOS</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <link href="assets/css/demo.css" rel="stylesheet" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" >

    	<div class="sidebar-wrapper">


            <ul class="nav">
                <li class="active">
                    <a href="index.php">
                        <i class="pe-7s-note2"></i>
                        <p>INICIO</p>
                    </a>
                    <a href="cronograma.php">
                        <i class="pe-7s-note2"></i>
                        <p>CRONOGRAMAS</p>
                    </a>
                    <a href="tecnicos.php">
                        <i class="pe-7s-note2"></i>
                        <p>TÉCNICOS</p>                    
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <i class="sr-only">Toggle navigation</i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </button>
                    <a class="navbar-brand" href="#">GESTION DE ACTIVOS</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Lista de Activos</h4>
                                <a type="button" href="AgregarActivo.php" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                    	<th>Nombre</th>
                                    	<th>Descripcion</th>
                                    	<th>Fecha de compra</th>
                                        <th>Fecha de instalación</th>
                                        <th>Tiempo de vida</th>
                                        <th>Garantía</th>
                                        <th><i class="fa fa-wrench" aria-hidden="true"></i>Opciones</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($consulta as $Sql): ?>
                                           <tr>
                                                <?php echo "<td>". $Sql['ID']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['NOMBRE']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['DESCRIPCION']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['FCOMPRA']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['FINSTALACION']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['TVIDA']. "</td>"; ?>
                                                <?php echo "<td>". $Sql['GARANTIA']. "</td>"; ?>
                                                <?php echo "<td>"."<a href='update.php?id=".$Sql['ID']."' class='btn btn-warning btn-sm'><i class='fa fa-pencil' aria-hidden='true'></i></a>"; ?>
                                            <?php echo "<a href='delete.php?id=".$Sql['ID']."' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></a>". "</td>"; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php  if(!empty($mensaje)): ?>
                                    <div class="alert alert-danger">
                                        <p><b> Error - </b> <?php echo $mensaje; ?></p>
                                    </div>
                                <?php  endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                ACTIVOS
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>


    </div>
</div>
</body>

    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<script src="assets/js/chartist.min.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
	<script src="assets/js/demo.js"></script>


</html>
