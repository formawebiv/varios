<?php
require_once('core/connection.php');

/** Consultar tódolos eventos */
$sqlAllEvents = "SELECT id, title, start, end, color FROM eventos ";

/** Prepara a consulta */
$result = $dbConn->prepare($sqlAllEvents);

/**Executa a consulta */
$result->execute();

/**Garda os eventos nunha variable de resultados 
 * que conterá todos os eventos activos */
$events = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="gl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendario</title>
    <!-- Incluimos Bootstrap CSS-->
    <!-- link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"  -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Incluimos FullCalendar CSS -->
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <!-- CSS Mod -->
    <style>
    /* axustes de estilo */
        body {
            padding-top: 5px;
        }

        #calendar {
            max-width: 800px;
        }

        .col-centered {
            float: none;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- contido da paxina -->
    <!--container -->
    <div class="container">
        <!-- calendario -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="">Almanaque</h1>
                <p class="lead">(NomeUsuario)</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
        <!-- /Calendario -->
        <!-- Modal Novo Evento -->
        <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/newEvent.php">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Novo Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Cor</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Cor</option>
                                        <option style="color:#159E4A;" value="#159E4A">&#9724;Verde </option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724;Amarelo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724;Laranxa</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724;Vermello</option>
                                        <option style="color:#000;" value="#000">&#9724;Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-10 control-label">Data e Hora de início</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-10 control-label">Data e Hora de remate</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Axendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Novo Evento -->
        <!-- Modal Editar Titulo ou Eliminar Evento -->
        <div class="modal fade" id="editDeleteEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/editTitleDeleteEvent.php">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Editar título ou Eliminar evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Cor</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Cor</option>
                                        <option style="color:#159E4A;" value="#159E4A">&#9724;Verde</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724;Amarelo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724;Laranxa</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724;Vermello</option>
                                        <option style="color:#000;" value="#000">&#9724;Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox" name="delete"> Eliminar Evento</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Mandamos o id do Evento para poder editalo -->
                            <input type="hidden" name="id" class="form-control" id="id">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Axendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal editar titulo ou eliminar evento -->
        <!-- Modal Cambiar evento -->
        <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/editTitleDeleteEvent.php">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Atento!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-10" id="result">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Pechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Cambios -->
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
    <script src='js/fullcalendar/locale/es.js'></script>

    <!-- FullCalendar Funcións-->
    <script>
        $(document).ready(function() {
            /**Algunha variable coa data que imos a empregar máis adiante */
            var date = new Date(); //Data completa
            var yyyy = date.getFullYear().toString(); //Só o ano
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString(); //Só o mes
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString(); //Só o día

            $('#calendar').fullCalendar({
                columnFormat: 'dddd', //Nome completo dos días.
                firstDay: 1, //Para que a semana comece en Luns, 0 sería Dom
                header: {
                    language: 'gl-es', //Linguaxe galego(?)
                    left: 'prev,next today', //Opcións de menús para avanzar ou ir ao día actual
                    center: 'title',
                    right: 'month,basicWeek,basicDay' //Máis opcións de menús para cambiar de vistas
                },
                /**Cores distintos para o fin de semana */
                businessHours: {
                    dow: [1, 2, 3, 4, 5] // días da semana, 0=Domingo
                },
                displayEventTime: false, //NON amosar a hora
                defaultDate: yyyy + "-" + mm + "-" + dd,
                editable: true,
                eventLimit: false, //en false para que mostre tódolos eventos e non o enlace 'máis'
                selectable: true,
                selectHelper: true,
                /**Novo Evento */
                select: function(start, end) {
                    $('#newEvent #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent').modal('show');
                },
                /**Editar titulo ou Eliminar evento */
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#editDeleteEvent #id').val(event.id);
                        $('#editDeleteEvent #title').val(event.title);
                        $('#editDeleteEvent #color').val(event.color);
                        $('#editDeleteEvent').modal('show');
                    });
                },
                /**Se cambiamos o evento de lugar */
                eventDrop: function(event, delta, revertFunc) {
                    /**Chamar á función que se vai a encargar de editar  */
                    update(event);
                },
                /**Se cambiamos o tamaño do evento */
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                    /**Chamar á función que se vai a encargar de editar  */
                    update(event);
                },
                /**Mostrar tódolos eventos */
                events: [
                    /**Percorremos tódolos resultados */
                    <?php foreach ($events as $event) {
                    ?> {
                            id: '<?php echo $event["id"]; ?>',
                            title: '<?php echo $event["title"]; ?>',
                            start: '<?php echo $event["start"]; ?>',
                            end: '<?php echo $event["end"]; ?>',
                            color: '<?php echo $event["color"]; ?>',
                        },
                    <?php } ?>
                ]
            }); // fin Full Calendar

            /**Función encargada de editar o evento cos eventos anteriores */
            function update(event) {
                /**Capturar a data e a hora de início */
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                /**Comprobar a data de remate */
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }
                /**Capturamos os Datos do evento */
                id = event.id;
                eventId = id;
                eventStart = start;
                eventEnd = end;
                /**Editamos cunha petición AJAX */
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
                            $( "#result" ).html('O evento foi modificado con éxito.');
                            $('#alert').modal('show');
                        } else {
                            $( "#result" ).html('Non se puido editar. Intentao de novo.');
                            $('#alert').modal('show');
                        }
                    }
                });
            } // fin Update
        });
    </script>
</body>

</html>