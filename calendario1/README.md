#  Calendario sinxelo PHP+MySQL+jQuery

Proposta para poder organizar os horarios, os acontecementos e os compromisos. Unha pequena axenda… A idea é crear un calendario usando a librería **“**[**FullCalendar**](https://fullcalendar.io/)**”** de **jQuery**, xunto con **PHP** e **MySQL.** Co obxectivo de poder gardar os eventos nunha base de datos.

Temos que dispor (ou instalar) os programas que nos permitan o desenvolvemento. Arrancamos instalando [**Laragon**](https://laragon.org/)**,** un paquete \*AMP que trae todo o necesario - PHP, MySQL, Node, phpMyAdmin,... - para desenvolver o proxecto [**https://laragon.org/download/**](https://laragon.org/download/) (tamén se podería usar [**XAMPP**](https://www.apachefriends.org/es/index.html), ou calquera outra altrnativa \*AMP coa que poidas estar familiarizado)**

Instalar Laragon é relativamente fácil, empregando o asistente e seguindo os pasos do mesmo:  siguiente…siguiente…siguiente. :eye: durante a instalación o asistente te pedirá de incluír seus compoñentes no PATH do sistema -php, node, mysql, cmd,...- marca que SI.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0eqqb_D97jAdN5jHo.png)

Una vez terminada a instalación, executa o programa.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0g3CiRuI9HH__36gn.png)

Non é obrigatorio pero podes tamén agregar  [**phpMyAdmin**](https://www.phpmyadmin.net/). En **“Menu &rarr; Herramientas &rarr; Quick add”** e aí selecciona **“\*phpmyadmin”**. Espera a que termine de instalalo.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0jkBV_9bQiPaWfpkD.png)

Podes revisar as ferramentas dispoñibles e as alternativas que ofrece o entorno de Laragon. Cando esteas listo, fai clic no botón “**Iniciar todo”**. Logo, para traballar coas bases de datos, preme no botón **“Base de Datos”** (un atallo ao recen instalado phpMyAdmin). 

Vai a xanela do navegador que recen se abriu. Inicia sesión en phpMyAdmin. Non hai que dicir que phpMyAdmin é un xestor de bases de datos en contacto co meu SXBD local. Desde phpMyAdmin imos crear a base de datos **“simpleCalendario”** que contén a táboa **“eventos”** na que gardaremos os eventos que vaiamos agregando ao calendario.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0SzYkOvGIBAgkuS1y.png)

```sql
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-05-2020 a las 21:54:54
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;--
-- Base de datos: `simplecalendario`
---- ----------------------------------------------------------
-- Estrutura de datos da táboa `eventos`
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;--

-- Volcado de datos para a táboa `eventos`
INSERT INTO `eventos` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'MateLab', '#159E4A', '2020-05-14 00:00:00', '2020-05-18 00:00:00'),
(3, 'Doble Click y Editemos', '#159E4A', '2020-05-14 00:00:00', '2020-05-18 18:00:00');

--
-- Índices para táboas volcadas
----
-- Indices da táboa `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT das táboas volcadas
----
-- AUTO_INCREMENT da táboa `eventos`
--

ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

En phpMyAdmin, na lapela **“SQL”**, ingresa o código anterior e premo o botón **“continuar”.** Xa temos todo listo.

Na ruta onde instalaches [**Laragon**](https://laragon.org/)**,** - xeralmente **“C:\laragon”,** imos ao cartafol **“www”** e crea un cartafol para o proxecto **“simplecalendario”** . Logo abrea no teu editor de código preferido. *[**VSCODE**](https://code.visualstudio.com/)**

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0q2UqZtO_snf2OMV-.png)

Crea o arquivo **``index.php``** e agrega nel o necesario.

- Inclúe [**Bootstrap**](https://getbootstrap.com/docs/4.5/getting-started/introduction/)

```html
:<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendario</title>
    <!-- Incluir Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    
    
<!-- Ao final do arquivo antes de pecha body incluir Bootstrap JS, a dependencia Popper e por suposto jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
```

Para probar que todo funciona - até o de agora- inclue algún código php no corpo do documento e probao.

```php
<body>
    <?php
    echo "Estou a facer unha proba con php";
    ?>
```

Recarga Laragon para darlle a oportunidade de incluir o cartafol do teu proxecto coma un sitio con dirección propia.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0Nz6kuIbNrQVYQITR.png)

Lo dendo navegador, vai a nova dirección  **“simplecalendario.test”** (ou calquera outro nome que teñas empregado: **“nombre-carpeta.test”**) e deberías ver algo como isto.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\069iqMkew3ezdrg7T.png)

Imos agora a engadir todo o necesario para usar **“**[**FullCalendar**](https://fullcalendar.io/)**”.** e construír así o noso calendario.

Na cartafol que creaches para o proxecto, agrega:

 https://github.com/matelab/mateBlog_calendarioPHP

El directorio de nuestro proyecto debería quedar así.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0Q6EMqFdwG6McUV6H.png)

**“index.php”** quedaría así ahora con todo lonecesario para mostrar el calendario.

En el “**head”**

```
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendario</title>
    <!-- Incluimos Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Incluimos FullCalendar CSS -->
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <!-- CSS Mod -->
    <style>
        body {
            padding-top: 5px;        }        #calendar {
            max-width: 800px;
        }        .col-centered {
            float: none;
            margin: 0 auto;
        }
    </style>
</head>
```

Y el **“body”** quedaría así

```
<body>
    <!-- Contenido de la Pagina -->
    <!--container -->
    <div class="container">
	<!-- Calendario -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Un Simple Calendario</h1>
                <p class="lead">MateLab</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
<!-- Calendario -->
    </div>
    <!-- /container -->
    <!-- Incluimos Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Incluimos FullCalendar JS -->
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.js'></script>
    <script src='js/fullcalendar/locale/es.js'></script>    <!-- FullCalendar Funciones-->
    <script>
        $(document).ready(function() {
            /**Alguna Variables con la Fecha que vamos a Usar mas Adelante */
            var date = new Date(); //Fecha Completa
            var yyyy = date.getFullYear().toString(); //Solo el Año
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString(); //Solo el Mes
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString(); //Solo el Dia            $('#calendar').fullCalendar({
                columnFormat: 'dddd', //Nombre Completo de los Dias.
                firstDay: 0, //Para que comience en Domingo la semana
                header: {
                    language: 'es', //Lenguaje en Español
                    left: 'prev,next today', //Opciones de Menus para avanzar o ir al Dia Actual
                    center: 'title',
                    right: 'month,basicWeek,basicDay' //Mas Opciones de Menus para cambiar de Vistas
                },
                /**Colores distintos para el fin de Semana */
                businessHours: {
                    dow: [1, 2, 3, 4, 5] // dias de semana, 0=Domingo
                },
displayEventTime : false,//NO Mostrar la Hora
                defaultDate: yyyy + "-" + mm + "-" + dd,
                editable: true,
                eventLimit: false, //esta en false para que muestre todos los eventos y no el link mas
                selectable: true,
                selectHelper: true,
            });//Fin Full Calendar        });
    </script>
</body>
```

Si todo salió bien deberíamos ver algo como esto al probar.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0ZftMGkjn1ph6cUoe.png)

Vamos a ir agregando más configuraciones a nuestro Calendario. Vamos a crear en el directorio de nuestro proyecto una carpeta llamada **“core”** solo para ser más ordenados; dentro de este directorio vamos a crear un nuevo archivo **“connection.php”** que se va a encargar de conectar con nuestra base de datos.

Quedaría así

```
<?php
try
{
    $host = "localhost";//Servidor
    $db ="simpleCalendario";//Nombre de la Base de Datos
    $userDb = "root"; //Usuario de la Base de Datos en este caso es root para localhost por defecto
    $password = ""; //Por defecto esta en blanco para localhost 
    $dbConn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $userDb, $password);
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
```

Si queremos probar si se conecta o no a nuestra base de datos escribimos en el navegador **“http://simplecalendario.test/core/connection.php”**.

Si nos muestra una página en blanco quiere decir que conecto, de lo contrario nos mostraría algo como esto por ejemplo:

En caso de que la contraseña este mal

**Ups! algo no está Bien: SQLSTATE[HY000] [1045] Access denied for user ‘root’@’localhost’ (using password: YES)**

O también si no encontró la base de datos sería algo así

**Ups! algo no está Bi en : SQLSTATE[HY000] [1049] Unknown database ‘simplecalendarioa’**

Ahora lo vamos a incluir o requerir en nuestro archivo **“index.php”** al principio de todo.

Algo así

```
<?php
    require_once('core/connection.php');
?>
<!DOCTYPE html>
```

Ahora en la línea siguiente o dos líneas después como quieran de nuestro “**require_once”**,vamos a hacer una consulta a nuestra táboa de eventos para traer todos los eventos que tenemos creados.

Quedaría así

```
/**Consulta para Traer Todos los Eventos */
    $sqlAllEvents = "SELECT id, title, start, end, color FROM eventos ";
    /**Preparamos la Consulta */
    $result = $dbConn->prepare($sqlAllEvents);
    /**Ejecutamos la Consulta */
    $result->execute();
    /**Guardamos Todos los Eventos */
    $events = $result->fetchAll();
```

Ahora vamos a mostrar los resultados los eventos en nuestro calendario.

En la línea siguiente a **«selectHelper: true,”** que se encuentra en nuestro script que activa el nuestro calendario, agregamos lo siguiente

```
/**Mostramos todos los Eventos */
                events: [
                    /**Recorremos todos los resultados */
                    <?php foreach ($events as $event):
                    ?> {
                            id: '<?php echo $event["id"]; ?>',
                            title: '<?php echo $event["title"]; ?>',
                            start: '<?php echo $event["start"]; ?>',
                            end: '<?php echo $event["end"]; ?>',
                            color: '<?php echo $event["color"]; ?>',
                        },
                    <?php endforeach; ?>
                ]
```

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0QOm6Ob-we6l3Mx6_.png)

Ahora vamos a agregar un modal para agregar un Evento Nuevo y la función para ver ese modal.

En la línea siguiente a **“<!– /Calendario –>”** agregamos el modal

```
<!-- Modal Nuevo Evento -->
        <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/newEvent.php">                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Nuevo Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Color</option>
                                        <option style="color:#159E4A;" value="#159E4A">Verde Matelab</option>
                                        <option style="color:#FFD700;" value="#FFD700">Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">Rojo</option>
                                        <option style="color:#000;" value="#000">Negro</option>                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-10 control-label">Fecha y Hora de Inicio</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-10 control-label">Fecha y Hora de Finalización</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end">
                                </div>
                            </div>                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- /Modal Nuevo Evento -->
```

Este modal contiene un formulario con una acción a **“core/newEvent.php”** que va a ser el encargado de guardar el evento en nuestra táboa de eventos, entonces ahora vamos a crear este archivo dentro de la carpeta **“core”** y agregamos esto

```
<?php
require_once('connection.php');
/**Comprobamos que todos los Campos vengan Completos */
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
    
    /**Recibimos los Datos */
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];    $sqlAddEvent = "INSERT INTO eventos(title, start, end, color) values ('$title', '$start', '$end', '$color')";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare( $sqlAddEvent );
    if ($queryPrepare == false) {
    /**Mostramos el Error */
     print_r($dbConn->errorInfo());
     die ('Ups! algo no está Bien cuando Preparamos la Query');
    }
    /**Si todo esta bien Ejecutamos la Query Preparada */
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
    /**Mostramos el Error */
     print_r($queryPrepare->errorInfo());
     die ('Ups! algo no está Bien cuando Ejecutamos la Query');
    }}
/**Volvemos a la Pagina que Genero la Petición */
header('Location: '.$_SERVER['HTTP_REFERER']);
```

Probemos si todo está bien, deberíamos ver esto, al guardar debería aparecer el evento en la fecha que seleccionaste

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0FvpgikyR6JVfYXGG.png)

Ahora vamos a agregar otro modal para editar el título del evento o eliminar el evento, y los hacemos debajo de **“<!– /Modal Nuevo Evento –>”**

```
<!-- Modal Editar Titulo o Eliminar Evento -->
        <div class="modal fade" id="editDeleteEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/editTitleDeleteEvent.php">                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Editar Titulo o Eliminar Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Color</option>
                                        <option style="color:#159E4A;" value="#159E4A">Verde Matelab</option>
                                        <option style="color:#FFD700;" value="#FFD700">Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">Rojo</option>
                                        <option style="color:#000;" value="#000">Negro</option>                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox" name="delete"> Eliminar Evento</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Mandamos el id del Evento para poder editarlo -->
                            <input type="hidden" name="id" class="form-control" id="id">                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Editar Titulo o Eliminar Evento -->
```

Y agregamos otra función para llamar el modal, lo vamos a hacer en la línea siguiente al cierre de la función de Nuevo evento quedaría algo así

```
/**Nuevo Evento */
                select: function(start, end) {
                    $('#newEvent #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent').modal('show');
                },
                /**Editar Titulo o Eliminar Evento */
                eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#editDeleteEvent #id').val(event.id);
                    $('#editDeleteEvent #title').val(event.title);
                    $('#editDeleteEvent #color').val(event.color);
                    $('#editDeleteEvent').modal('show');
                });
            },
```

Y como antes vamos a crear otro archivo en la carpeta **“core”** que va editar o eliminar el evento, el archivo va a ser **“editTitleDeleteEvent.php”.**

```
<?php
require_once('connection.php');
/**Comprobamos si Activo eliminar el Evento */
if (isset($_POST['delete']) && isset($_POST['id'])) {
    /**Recibimos el ID */
    $id = $_POST['id'];
    $sqlDelete = "DELETE FROM eventos WHERE id = $id";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare($sqlDelete);
    if ($queryPrepare == false) {
        print_r($bdd->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Preparamos la Query');
    }
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
        print_r($queryPrepare->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
    /**SI no quiere eliminar Entonces Comprobamos que Vengo Todo Completo */
} elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])) {
    /**Recibimos los Datos */
    $id = $_POST['id'];
    $title = $_POST['title'];
    $color = $_POST['color'];    $sqlUpdate = "UPDATE eventos SET  title = '$title', color = '$color' WHERE id = $id ";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare($sqlUpdate);
    if ($queryPrepare == false) {
        print_r($dbConn->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
        print_r($queryPrepare->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
}
/**Volvemos a la Pagina de Inicio */
header('Location: ../index.php');
```

Probemos si todo funciona bien. Hace doble clic en un evento y veras este modal.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\0R1Ue-rJz7vsiPUYy.png)

Ahora vamos a agregar dos eventos más y una función para editar la fecha y hora de los eventos.

Así quedaría ahora

```
/**Editar Titulo o Eliminar Evento */
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#editDeleteEvent #id').val(event.id);
                        $('#editDeleteEvent #title').val(event.title);
                        $('#editDeleteEvent #color').val(event.color);
                        $('#editDeleteEvent').modal('show');
                    });
                },
                /**Si Cambiamos de lugar el Evento */
                eventDrop: function(event, delta, revertFunc) {
                    /**Llamamos a la Función que se va a Encargar de Editar  */
                    update(event);
                },
                /**Si Cambiamos el Tamaño del Evento */
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                    /**Llamamos a la Función que se va a Encargar de Editar  */
                    update(event);
                },
```

Y agregamos esta función después de **“});//Fin Full Calendar”**,es decir en la línea siguiente.

```
/**Función Encargada de Editar el Evento con los Eventos Anteriores */
            function update(event) {
                /**Capturamos la Fecha y Hora de Incio */
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                /**Comprobamos La Fecha de Fin */
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }
                /**Capturamos los Datos del Evento */
                id = event.id;
                eventId = id;
                eventStart = start;
                eventEnd = end;
                /**Lo Editamos por Una Petición AJAX */
                $.ajax({
                    url: 'core/editDateEvent.php',
                    type: "POST",
                    data: {
                        eventId: eventId,
                        eventStart: eventStart,
                        eventEnd: eventEnd,
                    },
                    success: function(rep) {
                        if (rep == 'ohSi') {
                            $( "#result" ).html('Se Editó Correctamente el Evento.');
                            $('#alert').modal('show');
                        } else {
                            $( "#result" ).html('No se pudo Editar. Intentemos de Nuevo.');
                            $('#alert').modal('show');
                        }
                    }
                });
            }//Fin Update
```

También vamos a crear otro archivo en la carpeta **“core”** que va ser **“editDateEvent.php”** y agregamos lo siguiente

```
<?php
require_once('connection.php');
/**Comprobamos que todos los Campos vengan Completos */
if (isset($_POST['eventId']) && isset($_POST['eventStart']) && isset($_POST['eventStart'])) {    /**Recibimos los Datos */
    $id = $_POST['eventId'];
    $start = $_POST['eventStart'];
    $end = $_POST['eventStart'];    $sqlUpdate = "UPDATE eventos SET  start = '$start', end = '$end' WHERE id = $id ";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare($sqlUpdate);
    if ($queryPrepare == false) {
        print_r($dbConn->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
        print_r($queryPrepare->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    } else {
        die('ohSi');
    }
}
```

También agreguemos un modal más debajo de **“<!– /Modal Editar Titulo o Eliminar Evento –>”** sería el siguiente

```
<!-- Modal Cambios -->
        <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/editTitleDeleteEvent.php">                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">¡Oye!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-10" id="result">                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Cambios -->
```

Con esto estamos, probemos si todo esta OK. Tenemos que ver algo así al cambiar de lugar el evento.

![img](C:\laragon\www\ajax-modal\varios\calendario1\assets\017BUtICHqwGM4W5E.png)

Si seguiste todos los pasos que te explique más arriba, estoy seguro que todo va a salir bien con tu primer calendario. Te invito a ver el demo de como tendría que quedar si cumpliste los pasos:

http://matelab.com.ar/blog/ejemplos/calendarioPHP

Y como siempre, te dejamos un repo con el código:

https://github.com/matelab/mateBlog_calendarioPHP



https://medium.com/@matelab/un-simple-calendario-afe598be92da