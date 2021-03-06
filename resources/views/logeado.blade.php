<!DOCTYPE html>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ URL::asset('/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ URL::asset('/favicon-16x16.png') }}" sizes="16x16">
    <link rel="manifest" href="{{ URL::asset('/manifest.json') }}">
    <link rel="mask-icon" href="{{ URL::asset('/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <title>Subir Encuestas</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ URL::asset('light/assets/plugins/morris/morris.css') }}">

    <!-- App css -->
    <link href="{{ URL::asset('light/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/plugins/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('light/assets/plugins/select2/dist/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('Horizontal/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('Horizontal/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ URL::asset('Horizontal/assets/js/modernizr.min.js') }}"></script>
    <style>
        b { cursor: pointer; cursor: hand; }
    </style>
</head>


<body>




<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Resultados</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-5 control-label">Cursos</label>
                                <div id="camaras_container" class="col-md-7">
                                    <select class='select2 form-control input-sm' name='curso'>
                                        <option value=''>Selecciona un curso</option>
                                        @foreach($cursos as $curso)
                                            <option data-tipo='{{$curso->id_tipo}}' data-preguntas='{{$curso->tipo->preguntas}}' data-secciones='{{$curso->secciones}}' value='{{ $curso->id }}'>{{ $curso->codigo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Secciones</label>
                                <div id="camaras_container" class="col-md-7">
                                    <select class='select2 form-control input-sm' name='seccion'>
                                        <option value=''>Selecciona una seccion</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="respuestas">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Profesores</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="profesores"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Dimension General</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="dimension_general"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Evaluaciones</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="evaluacion"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Auxiliares</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="auxiliares"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Comentarios</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="comentarios"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ URL::asset('light/assets/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/detect.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/fastclick.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/waves.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{ URL::asset('light/assets/js/jquery.scrollTo.min.js')}}"></script>

<script src="{{ URL::asset('light/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('light/assets/plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('light/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>


<script src="{{ URL::asset('light/assets/plugins/moment/moment.js')}}"></script>



<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="{{ URL::asset('light/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>


<script src="{{ URL::asset('light/assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/raphael/raphael-min.js')}}"></script>


<script src="{{ URL::asset('Horizontal/assets/js/jquery.core.js')}}"></script>
<script src="{{ URL::asset('Horizontal/assets/js/jquery.app.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('light/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<link href="{{ URL::asset('light/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<script src="{{ URL::asset('light/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('light/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="{{ URL::asset('light/assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" type="text/css" media="screen">

<script src="{{ URL::asset('light/assets/js/underscore.min.js')}}"></script>

<script>
    jQuery(document).ready(function() {
        var escala1 = [];
        escala1.push({
            respuesta : "Muy de acuerdo",
            valor :5
        });
        escala1.push({
            respuesta : "De acuerdo",
            valor :4
        });
        escala1.push({
            respuesta : "Ni de acuerdo ni en desacuerdo",
            valor :3
        });
        escala1.push({
            respuesta : "En desacuerdo",
            valor :2
        });
        escala1.push({
            respuesta : "Muy en desacuerdo",
            valor :1
        });
        var escala2 = [];
        escala2.push({
            respuesta : "No se implementó",
            valor : 0
        });
        escala2.push({
            respuesta : "Mucha",
            valor :4
        });
        escala2.push({
            respuesta : "Bastante",
            valor :3
        });
        escala2.push({
            respuesta : "Poco",
            valor :2
        });
        escala2.push({
            respuesta : "Nada",
            valor :1
        });


        $("[name='curso']").change(function(){
            $("[name='seccion'] ").html("");
            $("#profesores").html("");
            $("#dimension_general").html("");
            $("#evaluacion").html("");
            $("#auxiliares").html("");
            $("#comentarios").html("");
            var secciones = $("[name='curso'] option:selected").data('secciones');
            console.log(secciones);
            $("[name='seccion'] ").append('<option value="">Seleccione una unidad</option>');
            secciones.forEach(function (item,index) {
                if (item.esta) {
                    $("[name='seccion'] ").append('<option value=' + item.id + '>' + item.numero + '</option>');
                }
            });
            $("select").select2();
        });

        $("#respuestas").on('click','.mostrar',function () {
            if($("#"+$(this).data('pregunta')).parent().is(':visible'))
                $("#"+$(this).data('pregunta')).parent().hide();
            else
                $("#"+$(this).data('pregunta')).parent().show();
        });

        $("[name='seccion']").change(function(){
            $("#profesores").html("");
            $("#dimension_general").html("");
            $("#evaluacion").html("");
            $("#auxiliares").html("");
            $("#comentarios").html("");
            var total_1 = 0;
            var total_2 = 0;
            var total_3 = 0;
            var total_4 = 0;
            var total_5 = 0;

            var seccion = $(this).val();

            var preguntas = $("[name='curso'] option:selected").data('preguntas');

            //console.log(preguntas);
            $.ajax({
                url: '{{action('GraficosController@getSeccion')}}',
                data: 'seccion=' + seccion,
                success: function (data) {
                    var contador = 1;
                    var profesores = data.profesores;
                    var auxiliares = data.auxiliares_all;
                    var respuestas = data.respuestas;
                    if ($("[name='curso'] option:selected").data('tipo') == 1 || $("[name='curso'] option:selected").data('tipo') == 3) {

                        preguntas.forEach(function (pregunta, index) {
                            if (pregunta.profesor==1) {
                                profesores.forEach(function (profesor, index2) {

                                    var val5 = 0;
                                    var val4 = 0;
                                    var val3 = 0;
                                    var val2 = 0;
                                    var val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id && respuesta.id_user == profesor.id) {
                                            if (respuesta.respuesta == "Muy de acuerdo") {
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "De acuerdo") {
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "En desacuerdo") {
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    if (index == 0) {
                                        profesor.val5 = val5*1;
                                        profesor.val4 = val4*1;
                                        profesor.val3 = val3*1;
                                        profesor.val2 = val2*1;
                                        profesor.val1 = val1*1;
                                    } else {
                                        profesor.val5 += val5*1;
                                        profesor.val4 += val4*1;
                                        profesor.val3 += val3*1;
                                        profesor.val2 += val2*1;
                                        profesor.val1 += val1*1;
                                    }

                                    var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                    var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;
                                    aux = aux.replace("REEMPLAZAR", profesor.name);
                                    $("#profesores").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="p' + profesor.id + 'y' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="p' + profesor.id + 'y' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'p' + profesor.id + 'y' + pregunta.id,
                                        data: [
                                            {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},
                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (val3 / total * 100).toFixed(2),
                                                b: val3
                                            },
                                            {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},
                                            {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},

                                        ],
                                        barColors: function (row, series, type) {

                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#p' + profesor.id + 'y' + pregunta.id).parent().hide();
                                }); //terminan graficos profesores
                            } else {
                                if (index == 2) {
                                    profesores.forEach(function (profesor, index2) {
                                        var aux = "Dimension Comunicacional de " + profesor.name;
                                        var total = profesor.val5 + profesor.val4 + profesor.val3 + profesor.val2 + profesor.val1;
                                        var promedio = profesor.val5 * 5 + profesor.val4 * 4 + profesor.val3 * 3 + profesor.val2 * 2 + profesor.val1 * 1;
                                        //console.log(profesor);
                                        if (total == 0)
                                            promedio = "no hay respuestas";
                                        else {
                                            promedio = (promedio / total).toFixed(0);

                                            var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                            promedio = promedio1.respuesta;
                                        }

                                        $("#profesores").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="p' + profesor.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="p' + profesor.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'p' + profesor.id,
                                            data: [
                                                {
                                                    y: 'Muy en \ndesacuerdo',
                                                    a: (profesor.val1 / total * 100).toFixed(2),
                                                    b: profesor.val1
                                                },
                                                {
                                                    y: 'En \ndesacuerdo',
                                                    a: (profesor.val2 / total * 100).toFixed(2),
                                                    b: profesor.val2
                                                },

                                                {
                                                    y: 'Ni de acuerdo \nni en desacuerdo',
                                                    a: (profesor.val3 / total * 100).toFixed(2),
                                                    b: profesor.val3
                                                },
                                                {
                                                    y: 'De \nacuerdo',
                                                    a: (profesor.val4 / total * 100).toFixed(2),
                                                    b: profesor.val4
                                                },
                                                {
                                                    y: 'Muy de \nacuerdo',
                                                    a: (profesor.val5 / total * 100).toFixed(2),
                                                    b: profesor.val5
                                                },

                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                                else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                                else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                                else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                                else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 100,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                            }
                                        });
                                        $('#p' + profesor.id).parent().hide();
                                    }) // termina resumen de profesores
                                }
                                if (index >= 2 && index <= 5) {
                                    var val5 = 0;
                                    var val4 = 0;
                                    var val3 = 0;
                                    var val2 = 0;
                                    var val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            if (respuesta.respuesta == "Mucha") {
                                                total_5 += respuesta.total*1;
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Bastante") {
                                                total_4 += respuesta.total*1;
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Poco") {
                                                total_3 += respuesta.total*1;
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Nada") {
                                                total_2 += respuesta.total*1;
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "No se implementó") {
                                                total_1 += respuesta.total*1;
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    var total = val5*1 + val4*1 + val3*1 + val2*1;
                                    var promedio = val5 * 4 + val4 * 3 + val3 * 2 + val2 * 1 + val1 * 0;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala2, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;

                                    $("#dimension_general").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="n' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'n' + pregunta.id,
                                        data: [
                                            {y: 'No se \nimplementó', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'Nada', a: (val2 / total * 100).toFixed(2), b: val2},
                                            {y: 'Poco', a: (val3 / total * 100).toFixed(2), b: val3},
                                            {y: 'Bastante', a: (val4 / total * 100).toFixed(2), b: val4},
                                            {y: 'Mucha', a: (val5 / total * 100).toFixed(2), b: val5},
                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Nada') return "#F7830F";
                                            else if(row.label == 'Poco') return "#fec04c";
                                            else if(row.label == 'No se \nimplementó') return "#AD1D28";
                                            else if(row.label == 'Bastante') return "#D0EC1D";
                                            else if(row.label == 'Mucha') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#n' + pregunta.id).parent().hide();
                                }
                                if (index == 6) {
                                    var total = total_5*1 + total_4*1 + total_3*1 + total_2*1;
                                    var promedio = total_5 * 4 + total_4 * 3 + total_3 * 2 + total_2 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala2, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = "Resumen Dimension General";

                                    $("#dimension_general").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="n" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'n',
                                        data: [
                                            {y: 'No se \nimplementó', a: (total_1 / total * 100).toFixed(2), b: total_1},
                                            {y: 'Nada', a: (total_2 / total * 100).toFixed(2), b: total_2},
                                            {y: 'Poco', a: (total_3 / total * 100).toFixed(2), b: total_3},
                                            {y: 'Bastante', a: (total_4 / total * 100).toFixed(2), b: total_4},
                                            {y: 'Mucha', a: (total_5 / total * 100).toFixed(2), b: total_5},

                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Nada') return "#F7830F";
                                            else if(row.label == 'Poco') return "#fec04c";
                                            else if(row.label == 'No se \nimplementó') return "#AD1D28";
                                            else if(row.label == 'Bastante') return "#D0EC1D";
                                            else if(row.label == 'Mucha') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#n').parent().hide();
                                    total_5 = 0;
                                    total_4 = 0;
                                    total_3 = 0;
                                    total_2 = 0;
                                    total_1 = 0;

                                }
                                if (index >= 6 && index <= 7) {
                                    val5 = 0;
                                    val4 = 0;
                                    val3 = 0;
                                    val2 = 0;
                                    val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            if (respuesta.respuesta == "Muy de acuerdo") {
                                                total_5 += respuesta.total*1;
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "De acuerdo") {
                                                total_4 += respuesta.total*1;
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                total_3 += respuesta.total*1;
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "En desacuerdo") {
                                                total_2 += respuesta.total*1;
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                total_1 += respuesta.total*1;
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                    var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);
                                        //console.log(total);
                                        promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;

                                    $("#evaluacion").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="e' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="e' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'e' + pregunta.id,
                                        data: [
                                            {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},
                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (val3 / total * 100).toFixed(2),
                                                b: val3
                                            },
                                            {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},
                                            {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},

                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#e' + pregunta.id).parent().hide()
                                }
                                if (index == 8) {
                                    var total = total_5*1 + total_4*1 + total_3*1 + total_2*1 + total_1*1;
                                    var promedio = total_5 * 5 + total_4 * 4 + total_3 * 3 + total_2 * 2 + total_1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = "Resumen Dimensión Evaluaciones";

                                    $("#evaluacion").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="t" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="t" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 't',
                                        data: [
                                            {
                                                y: 'Muy en \ndesacuerdo',
                                                a: (total_1 / total * 100).toFixed(2),
                                                b: total_1
                                            },
                                            {y: 'En \ndesacuerdo', a: (total_2 / total * 100).toFixed(2), b: total_2},

                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (total_3 / total * 100).toFixed(2),
                                                b: total_3
                                            },
                                            {y: 'De \nacuerdo', a: (total_4 / total * 100).toFixed(2), b: total_4},

                                            {y: 'Muy de \nacuerdo', a: (total_5 / total * 100).toFixed(2), b: total_5},

                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#t').parent().hide();
                                }
                                if (index >= 8 && index <= 9) {

                                    auxiliares.forEach(function (auxiliar, index2) {

                                        var val5 = 0;
                                        var val4 = 0;
                                        var val3 = 0;
                                        var val2 = 0;
                                        var val1 = 0;
                                        respuestas.forEach(function (respuesta, index3) {
                                            if (respuesta.id_pregunta == pregunta.id && respuesta.id_user == auxiliar.id) {
                                                if (respuesta.respuesta == "Muy de acuerdo") {
                                                    val5 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "De acuerdo") {
                                                    val4 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                    val3 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "En desacuerdo") {
                                                    val2 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                    val1 += respuesta.total*1;
                                                }
                                            }
                                        });
                                        if (index == 8) {
                                            auxiliar.val5 = val5*1;
                                            auxiliar.val4 = val4*1;
                                            auxiliar.val3 = val3*1;
                                            auxiliar.val2 = val2*1;
                                            auxiliar.val1 = val1*1;
                                        } else {
                                            auxiliar.val5 += val5*1;
                                            auxiliar.val4 += val4*1;
                                            auxiliar.val3 += val3*1;
                                            auxiliar.val2 += val2*1;
                                            auxiliar.val1 += val1*1;
                                        }

                                        var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                        var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                        if (total == 0)
                                            promedio = "no hay respuestas";
                                        else {
                                            promedio = (promedio / total).toFixed(0);

                                            var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                            promedio = promedio1.respuesta;
                                        }
                                        var aux = pregunta.nombre;
                                        aux = aux.replace("REEMPLAZAR", auxiliar.name);
                                        $("#auxiliares").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + auxiliar.id + 'y' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="n' + auxiliar.id + 'y' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'n' + auxiliar.id + 'y' + pregunta.id,
                                            data: [
                                                {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                                {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},
                                                {
                                                    y: 'Ni de acuerdo \nni en desacuerdo',
                                                    a: (val3 / total * 100).toFixed(2),
                                                    b: val3
                                                },
                                                {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},
                                                {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},
                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                                else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                                else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                                else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                                else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 100,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                            }
                                        });
                                        $('#n' + auxiliar.id + 'y' + pregunta.id).parent().hide();

                                    });

                                }
                                if (index == 9) {
                                    auxiliares.forEach(function (auxiliar, index2) {
                                        var aux = "Dimensión Docencia Auxiliar de " + auxiliar.name;
                                        var total = auxiliar.val5*1 + auxiliar.val4*1 + auxiliar.val3*1 + auxiliar.val2*1 + auxiliar.val1*1;
                                        var promedio = auxiliar.val5 * 5 + auxiliar.val4 * 4 + auxiliar.val3 * 3 + auxiliar.val2 * 2 + auxiliar.val1 * 1;
                                        if (total == 0)
                                            promedio = "no hay respuestas";
                                        else {
                                            promedio = (promedio / total).toFixed(0);

                                            var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                            promedio = promedio1.respuesta;
                                        }

                                        $("#auxiliares").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="a' + auxiliar.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="a' + auxiliar.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'a' + auxiliar.id,
                                            data: [
                                                {
                                                    y: 'Muy en \ndesacuerdo',
                                                    a: (auxiliar.val1 / total * 100).toFixed(2),
                                                    b: auxiliar.val1
                                                },
                                                {
                                                    y: 'En \ndesacuerdo',
                                                    a: (auxiliar.val2 / total * 100).toFixed(2),
                                                    b: auxiliar.val2
                                                },
                                                {
                                                    y: 'Ni de acuerdo \nni en desacuerdo',
                                                    a: (auxiliar.val3 / total * 100).toFixed(2),
                                                    b: auxiliar.val3
                                                },
                                                {
                                                    y: 'De \nacuerdo',
                                                    a: (auxiliar.val4 / total * 100).toFixed(2),
                                                    b: auxiliar.val4
                                                },
                                                {
                                                    y: 'Muy de \nacuerdo',
                                                    a: (auxiliar.val5 / total * 100).toFixed(2),
                                                    b: auxiliar.val5
                                                },

                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                                else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                                else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                                else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                                else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 100,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                            }
                                        });
                                        $('#a' + auxiliar.id).parent().hide();
                                    }) // termina resumen de profesores
                                }
                                if (index >= 10 && index <= 11) {

                                    var aux = pregunta.nombre;
                                    $("#comentarios").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b></h4></a></div>' +
                                        '<div class="col-md-8"><div id="' + pregunta.id + '"></div></div></div>');

                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            $('#' + pregunta.id).append("<h5><i>"+(contador++)+": " + respuesta.respuesta + "</i><h5><br>");
                                        }
                                    });

                                    $('#' + pregunta.id).parent().hide();

                                }
                            }
                        });
                    } else {
                        preguntas.forEach(function (pregunta, index) {
                            if (pregunta.profesor==1) {
                                profesores.forEach(function (profesor, index2) {

                                    var val5 = 0;
                                    var val4 = 0;
                                    var val3 = 0;
                                    var val2 = 0;
                                    var val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id && respuesta.id_user == profesor.id) {
                                            if (respuesta.respuesta == "Muy de acuerdo") {
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "De acuerdo") {
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "En desacuerdo") {
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    if (index == 0) {
                                        profesor.val5 = val5*1;
                                        profesor.val4 = val4*1;
                                        profesor.val3 = val3*1;
                                        profesor.val2 = val2*1;
                                        profesor.val1 = val1*1;
                                    } else {
                                        profesor.val5 += val5*1;
                                        profesor.val4 += val4*1;
                                        profesor.val3 += val3*1;
                                        profesor.val2 += val2*1;
                                        profesor.val1 += val1*1;
                                    }

                                    var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                    var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;
                                    aux = aux.replace("REEMPLAZAR", profesor.name);
                                    $("#profesores").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + profesor.id + 'y' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="n' + profesor.id + 'y' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'n' + profesor.id + 'y' + pregunta.id,
                                        data: [
                                            {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},

                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (val3 / total * 100).toFixed(2),
                                                b: val3
                                            },
                                            {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},
                                            {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},

                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#n' + profesor.id + 'y' + pregunta.id).parent().hide();
                                }); //terminan graficos profesores
                            } else {
                                if (index == 2) {
                                    profesores.forEach(function (profesor, index2) {
                                        var aux = "Dimension Comunicacional de " + profesor.name;
                                        var total = profesor.val5*1 + profesor.val4*1 + profesor.val3*1 + profesor.val2*1 + profesor.val1*1;
                                        var promedio = profesor.val5 * 5 + profesor.val4 * 4 + profesor.val3 * 3 + profesor.val2 * 2 + profesor.val1 * 1;
                                        if (total == 0)
                                            promedio = "no hay respuestas";
                                        else {
                                            promedio = (promedio / total).toFixed(0);

                                            var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                            promedio = promedio1.respuesta;
                                        }

                                        $("#profesores").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="p' + profesor.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="p' + profesor.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'p' + profesor.id,
                                            data: [
                                                {
                                                    y: 'Muy en \ndesacuerdo',
                                                    a: (profesor.val1 / total * 100).toFixed(2),
                                                    b: profesor.val1
                                                },
                                                {
                                                    y: 'En \ndesacuerdo',
                                                    a: (profesor.val2 / total * 100).toFixed(2),
                                                    b: profesor.val2
                                                },

                                                {
                                                    y: 'Ni de acuerdo \nni en desacuerdo',
                                                    a: (profesor.val3 / total * 100).toFixed(2),
                                                    b: profesor.val3
                                                },
                                                {
                                                    y: 'De \nacuerdo',
                                                    a: (profesor.val4 / total * 100).toFixed(2),
                                                    b: profesor.val4
                                                },
                                                {
                                                    y: 'Muy de \nacuerdo',
                                                    a: (profesor.val5 / total * 100).toFixed(2),
                                                    b: profesor.val5
                                                },

                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                                else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                                else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                                else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                                else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 100,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                            }
                                        });
                                        $('#p' + profesor.id).parent().hide();
                                    }) // termina resumen de profesores
                                }
                                if (index >= 2 && index <= 6) {
                                    var val5 = 0;
                                    var val4 = 0;
                                    var val3 = 0;
                                    var val2 = 0;
                                    var val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            if (respuesta.respuesta == "Mucha") {
                                                total_5 += respuesta.total*1;
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Bastante") {
                                                total_4 += respuesta.total*1;
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Poco") {
                                                total_3 += respuesta.total*1;
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Nada") {
                                                total_2 += respuesta.total*1;
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "No se implementó") {
                                                total_1 += respuesta.total*1;
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    var total = val5*1 + val4*1 + val3*1 + val2*1;
                                    var promedio = val5 * 4 + val4 * 3 + val3 * 2 + val2 * 1 + val1 * 0;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala2, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;

                                    $("#dimension_general").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="n' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'n' + pregunta.id,
                                        data: [
                                            {y: 'No se \nimplementó', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'Nada', a: (val2 / total * 100).toFixed(2), b: val2},
                                            {y: 'Poco', a: (val3 / total * 100).toFixed(2), b: val3},
                                            {y: 'Bastante', a: (val4 / total * 100).toFixed(2), b: val4},
                                            {y: 'Mucha', a: (val5 / total * 100).toFixed(2), b: val5},
                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Nada') return "#F7830F";
                                            else if(row.label == 'Poco') return "#fec04c";
                                            else if(row.label == 'No se \nimplementó') return "#AD1D28";
                                            else if(row.label == 'Bastante') return "#D0EC1D";
                                            else if(row.label == 'Mucha') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#n' + pregunta.id).parent().hide();
                                }
                                if (index == 7) {
                                    var total = total_5*1 + total_4*1 + total_3*1 + total_2*1;
                                    var promedio = total_5 * 4 + total_4 * 3 + total_3 * 2 + total_2 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala2, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = "Resumen Dimension General";

                                    $("#dimension_general").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="n" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'n',
                                        data: [
                                            {y: 'No se \nimplementó', a: (total_1 / total * 100).toFixed(2), b: total_1},
                                            {y: 'Nada', a: (total_2 / total * 100).toFixed(2), b: total_2},

                                            {y: 'Poco', a: (total_3 / total * 100).toFixed(2), b: total_3},
                                            {y: 'Bastante', a: (total_4 / total * 100).toFixed(2), b: total_4},
                                            {y: 'Mucha', a: (total_5 / total * 100).toFixed(2), b: total_5},
                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Nada') return "#F7830F";
                                            else if(row.label == 'Poco') return "#fec04c";
                                            else if(row.label == 'No se \nimplementó') return "#AD1D28";
                                            else if(row.label == 'Bastante') return "#D0EC1D";
                                            else if(row.label == 'Mucha') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#n').parent().hide();
                                    total_5 = 0;
                                    total_4 = 0;
                                    total_3 = 0;
                                    total_2 = 0;
                                    total_1 = 0;

                                }
                                if (index >= 7 && index <= 8) {
                                    val5 = 0;
                                    val4 = 0;
                                    val3 = 0;
                                    val2 = 0;
                                    val1 = 0;
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            if (respuesta.respuesta == "Muy de acuerdo") {
                                                total_5 += respuesta.total*1;
                                                val5 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "De acuerdo") {
                                                total_4 += respuesta.total*1;
                                                val4 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                total_3 += respuesta.total*1;
                                                val3 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "En desacuerdo") {
                                                total_2 += respuesta.total*1;
                                                val2 += respuesta.total*1;
                                            } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                total_1 += respuesta.total*1;
                                                val1 += respuesta.total*1;
                                            }
                                        }
                                    });
                                    var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                    var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);
                                        //console.log(total);
                                        promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = pregunta.nombre;

                                    $("#evaluacion").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="e' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="e' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 'e' + pregunta.id,
                                        data: [
                                            {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                            {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},

                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (val3 / total * 100).toFixed(2),
                                                b: val3
                                            },
                                            {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},
                                            {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},

                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#e' + pregunta.id).parent().hide()
                                }
                                if (index == 9) {
                                    var total = total_5*1 + total_4*1 + total_3*1 + total_2*1 + total_1*1;
                                    var promedio = total_5 * 5 + total_4 * 4 + total_3 * 3 + total_2 * 2 + total_1;
                                    if (total == 0)
                                        promedio = "no hay respuestas";
                                    else {
                                        promedio = (promedio / total).toFixed(0);

                                        var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                        promedio = promedio1.respuesta;
                                    }
                                    var aux = "Resumen Dimensión Evaluaciones";

                                    $("#evaluacion").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="t" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                        '<div class="col-md-8"><div id="t" style="height:300px; width:100%"></div></div></div>');
                                    Morris.Bar({
                                        element: 't',
                                        data: [
                                            {
                                                y: 'Muy en \ndesacuerdo',
                                                a: (total_1 / total * 100).toFixed(2),
                                                b: total_1
                                            },
                                            {y: 'En \ndesacuerdo', a: (total_2 / total * 100).toFixed(2), b: total_2},
                                            {y: 'De \nacuerdo', a: (total_4 / total * 100).toFixed(2), b: total_4},
                                            {
                                                y: 'Ni de acuerdo \nni en desacuerdo',
                                                a: (total_3 / total * 100).toFixed(2),
                                                b: total_3
                                            },
                                            {y: 'De \nacuerdo', a: (total_4 / total * 100).toFixed(2), b: total_4},
                                            {y: 'Muy de \nacuerdo', a: (total_5 / total * 100).toFixed(2), b: total_5},
                                        ],
                                        barColors: function (row, series, type) {
                                            if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                            else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                            else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                            else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                            else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                        },
                                        xkey: 'y',
                                        ykeys: ['a'],
                                        ymax: 100,
                                        labels: ['Series A'],
                                        barSize: 40,
                                        hoverCallback: function (index, options, content, row) {
                                            if (total == 0)
                                                return "no hay respuestas";
                                            return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                        }
                                    });
                                    $('#t').parent().hide();

                                    auxiliares.forEach(function (auxiliar, index2) {

                                        var val5 = 0;
                                        var val4 = 0;
                                        var val3 = 0;
                                        var val2 = 0;
                                        var val1 = 0;
                                        respuestas.forEach(function (respuesta, index3) {
                                            if (respuesta.id_pregunta == pregunta.id && respuesta.id_user == auxiliar.id) {
                                                if (respuesta.respuesta == "Muy de acuerdo") {
                                                    val5 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "De acuerdo") {
                                                    val4 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "Ni de acuerdo ni en desacuerdo") {
                                                    val3 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "En desacuerdo") {
                                                    val2 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "Muy en desacuerdo") {
                                                    val1 += respuesta.total*1;
                                                }
                                            }
                                        });
                                        if (auxiliar.val5 == undefined) {
                                            auxiliar.val5 = val5*1;
                                            auxiliar.val4 = val4*1;
                                            auxiliar.val3 = val3*1;
                                            auxiliar.val2 = val2*1;
                                            auxiliar.val1 = val1*1;
                                        } else {
                                            auxiliar.val5 += val5*1;
                                            auxiliar.val4 += val4*1;
                                            auxiliar.val3 += val3*1;
                                            auxiliar.val2 += val2*1;
                                            auxiliar.val1 += val1*1;
                                        }

                                        var total = val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                        var promedio = val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                        if (total == 0)
                                            promedio = "no hay respuestas";
                                        else {
                                            promedio = (promedio / total).toFixed(0);

                                            var promedio1 = _.find(escala1, {valor: parseInt(promedio)});

                                            promedio = promedio1.respuesta;
                                        }
                                        var aux = pregunta.nombre;
                                        aux = aux.replace("REEMPLAZAR", auxiliar.name);
                                        $("#auxiliares").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + auxiliar.id + 'y' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="n' + auxiliar.id + 'y' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'n' + auxiliar.id + 'y' + pregunta.id,
                                            data: [
                                                {y: 'Muy en \ndesacuerdo', a: (val1 / total * 100).toFixed(2), b: val1},
                                                {y: 'En \ndesacuerdo', a: (val2 / total * 100).toFixed(2), b: val2},

                                                {
                                                    y: 'Ni de acuerdo \nni en desacuerdo',
                                                    a: (val3 / total * 100).toFixed(2),
                                                    b: val3
                                                },
                                                {y: 'De \nacuerdo', a: (val4 / total * 100).toFixed(2), b: val4},
                                                {y: 'Muy de \nacuerdo', a: (val5 / total * 100).toFixed(2), b: val5},
                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == 'Muy en \ndesacuerdo') return "#AD1D28";
                                                else if(row.label == 'En \ndesacuerdo') return "#F7830F";
                                                else if(row.label == 'Ni de acuerdo \nni en desacuerdo') return "#fec04c";
                                                else if(row.label == 'De \nacuerdo') return "#D0EC1D";
                                                else if(row.label == 'Muy de \nacuerdo') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 100,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return row.y + " : " + row.b + "\n porcentaje\n : " + row.a;
                                            }
                                        });
                                        $('#n' + auxiliar.id + 'y' + pregunta.id).parent().hide();

                                    });
                                }

                                if (index == 10) {
                                    auxiliares.forEach(function (auxiliar, index2) {
                                        var val7 = 0;
                                        var val6 = 0;
                                        var val5 = 0;
                                        var val4 = 0;
                                        var val3 = 0;
                                        var val2 = 0;
                                        var val1 = 0;
                                        respuestas.forEach(function (respuesta, index3) {
                                            if (respuesta.id_pregunta == pregunta.id && respuesta.id_user == auxiliar.id) {
                                                if (respuesta.respuesta == "7") {
                                                    val7 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "6") {
                                                    val6 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "5") {
                                                    val5 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "4") {
                                                    val4 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "3") {
                                                    val3 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "2") {
                                                    val2 += respuesta.total*1;
                                                } else if (respuesta.respuesta == "1") {
                                                    val1 += respuesta.total*1;
                                                }
                                            }
                                        });


                                        var total = val7*1 + val6*1 + val5*1 + val4*1 + val3*1 + val2*1 + val1*1;
                                        var promedio = val7 * 7 + val6 * 6 + val5 * 5 + val4 * 4 + val3 * 3 + val2 * 2 + val1 * 1;
                                        if (total == 0) {
                                            promedio = "no hay respuestas";
                                            desviacion = "";
                                        }
                                        else {
                                            promedio = (promedio / total).toFixed(2);
                                            var desviacion = Math.pow((7 - promedio), 2) * val7 + Math.pow((6 - promedio), 2) * val6 + Math.pow((5 - promedio), 2) * val5 + Math.pow((4 - promedio), 2) * val4 +
                                                Math.pow((3 - promedio), 2) * val3 + Math.pow((2 - promedio), 2) * val2 + Math.pow((1 - promedio), 2) * val1;
                                            desviacion = (desviacion / (total - 1)).toFixed(2);
                                            desviacion = (Math.sqrt(desviacion, 2)).toFixed(2);
                                            ;
                                        }
                                        var aux = pregunta.nombre;
                                        aux = aux.replace("REEMPLAZAR", auxiliar.name);
                                        $("#auxiliares").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="n' + auxiliar.id + 'y' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b><br>Respuesta : ' + promedio + '<br>Desviacion : ' + desviacion + '</h4></a></div>' +
                                            '<div class="col-md-8"><div id="n' + auxiliar.id + 'y' + pregunta.id + '" style="height:300px; width:100%"></div></div></div>');
                                        Morris.Bar({
                                            element: 'n' + auxiliar.id + 'y' + pregunta.id,
                                            data: [
                                                {y: '1', a: val1},
                                                {y: '2', a: val2},
                                                {y: '3', a: val3},
                                                {y: '4', a: val4},
                                                {y: '5', a: val5},
                                                {y: '6', a: val6},
                                                {y: '7', a: val7},
                                            ],
                                            barColors: function (row, series, type) {
                                                if(row.label == '1') return "#AD1D28";
                                                else if(row.label == '2') return "#F7830F";
                                                else if(row.label == '3') return "#fec04c";
                                                else if(row.label == '4') return "#f0f586";
                                                else if(row.label == '5') return "#D0EC1D";
                                                else if(row.label == '6') return "#cdd60d";
                                                else if(row.label == '7') return "#1AB244";
                                            },
                                            xkey: 'y',
                                            ykeys: ['a'],
                                            ymax: 7,
                                            labels: ['Series A'],
                                            barSize: 40,
                                            hoverCallback: function (index, options, content, row) {
                                                if (total == 0)
                                                    return "no hay respuestas";
                                                return "Cantidad de " + row.y + " : " + row.a;
                                            }
                                        });
                                        $('#n' + auxiliar.id + 'y' + pregunta.id).parent().hide();

                                    });
                                }

                                if (index >= 11 && index <= 12) {

                                    var aux = pregunta.nombre;
                                    $("#comentarios").append('<div class="row"><div class="col-md-12"><a type="button" data-pregunta="' + pregunta.id + '" class="mostrar"><h4><b>' + aux + '</b></h4></a></div>' +
                                        '<div class="col-md-8"><div id="' + pregunta.id + '"></div></div></div>');
                                    respuestas.forEach(function (respuesta, index3) {
                                        if (respuesta.id_pregunta == pregunta.id) {
                                            $('#' + pregunta.id).append("<h5><i>" +(contador++)+": " + respuesta.respuesta + "</i><h5><br>");
                                        }
                                    });

                                    $('#' + pregunta.id).parent().hide();

                                }
                            }
                        });
                    }
                }
            });
        });



    });

    $("select").select2();

</script>

</body>
</html>