<?php
require'funciones.php';
try{
        $conexion = new PDO('mysql:host=localhost;dbname=GestionActivos','root','');
    }catch(PDOException $e){
        echo "ERROR: " . $e->getMessge();
        die();
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = limpiarDatos($_POST['id']);
        $nombre = limpiarDatos($_POST['nombre']);
        $descripcion = limpiarDatos($_POST['descripcion']);
        $fcompra = limpiarDatos($_POST['fcompra']);
        $finstalacion = limpiarDatos($_POST['finstalacion']);
        $tvida = limpiarDatos($_POST['tvida']);
        $garantia = limpiarDatos($_POST['garantia']);

        $statement = $conexion->prepare(
        "UPDATE ACTIVOS SET
        NOMBRE = :nombre,
        DESCRIPCION = :descripcion,
        FCOMPRA = :fcompra,
        FINSTALACION = :finstalacion,
        TVIDA = :tvida,
        GARANTIA = :garantia
        WHERE ID =:id");

        $statement ->execute(array(
            ':id'=>$id,
            ':nombre'=> $nombre,
            ':descripcion'=> $descripcion,
            ':fcompra'=> $fcompra,
            ':finstalacion'=> $finstalacion,
            ':tvida'=> $tvida,
            ':garantia'=> $garantia
            ));
        header('Location: index.php');
    }else{
        $id = id_numeros($_GET['id']);
        if(empty($id)){
            header('Location: index.php');
        }
        $contacto = obtener_id($conexion,$id);

        if(!$contacto){
            header('Location: index.php');
        }
        $contacto =$contacto[0];
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

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" >

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    <div class="sidebar-wrapper">
          <ul class="nav">
          <li class="active">
                    <a href="index.php">
                        <i class="pe-7s-note2"></i>
                        <p>INICIO</p>
                    </a>
                    <a href="#">
                        <i class="pe-7s-note2"></i>
                        <p>CRONOGRAMA</p>
                    </a>
                    <a href="#">
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
                                <h4 class="title">Actualizar Activo</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $contacto['ID'];?>" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Nombre:</label>
                                                        <input type="text" class="form-control" required="" name="nombre" value="<?php echo $contacto['NOMBRE'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Descripcion:</label>
                                                        <input type="text" class="form-control" required="" name="descripcion" value="<?php echo $contacto['DESCRIPCION'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Fecha de compra:</label>
                                                        <input type="text" class="form-control" required="" name="fcompra" value="<?php echo $contacto['FCOMPRA'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Fecha de instalación:</label>
                                                        <input type="text" class="form-control" required="" name="finstalacion" value="<?php echo $contacto['FINSTALACION'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Tiempo de vida:</label>
                                                        <input type="text" class="form-control" required="" name="tvida" value="<?php echo $contacto['TVIDA'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label">Garantía:</label>
                                                        <input type="text" class="form-control" required="" name="garantia" value="<?php echo $contacto['GARANTIA'];?>">
                                                    <i class="material-input"></i></div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Actualizar Activo</button>
                                                </div>
                                        </div>
                                    </form>
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
                            <a href="index.php">
                                Gestion
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>


    </div>
</div>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>


</html>
