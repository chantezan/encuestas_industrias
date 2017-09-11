<!DOCTYPE html>
<html>
<head>

    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


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
                    <h3 class="panel-title">Subir Excel</h3>
                </div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" action="{{action('SubirEncuestaController@guardarExcel')}}" method="post">
                <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Cursos</label>
                                    <div id="camaras_container" class="col-md-7">
                                        <select class='select2 form-control input-sm' name='curso'>
                                            <option value=''>Selecciona un curso</option>
                                            @foreach($cursos as $curso)
                                                <option data-secciones='{{$curso->secciones}}' value='{{ $curso->id }}'>{{ $curso->codigo }}</option>
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

                <div class="col-md-6">



                            <div class="form-group">
                                <label class="col-md-3 control-label">archivo</label>
                                <div class="col-md-3">
                                    <input id="file-1" type="file" name="file" class="file" >
                                </div>
                            </div>

                    <div class="col-md-3 col-md-offset-9">
                        <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Subir Excel</button>
                    </div>

                </div>
                    </form>
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

<!--Morris Chart
		<script src="{{ URL::asset('light/assets/plugins/morris/morris.min.js')}}"></script>
		<script src="{{ URL::asset('light/assets/plugins/raphael/raphael-min.js')}}"></script>

        Dashboard init
        <script src="{{ URL::asset('light/assets/pages/jquery.dashboard.js')}}"></script>
    -->
<!-- App js -->
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
        @if($guardado)
            swal("Guardado", "{{$guardado}}", "success");
        @endif
        @if($fallo)
            swal("Error", "{{$fallo}}", "error");
        @endif


        $("[name='curso']").change(function(){
            $("[name='seccion'] ").html("");
            var secciones = $("[name='curso'] option:selected").data('secciones');
            $("[name='seccion'] ").append('<option value="">Seleccione una unidad</option>');
            secciones.forEach(function (item,index) {
                    $("[name='seccion'] ").append('<option value='+item.id+'>'+item.numero+'</option>');
            });

        });

    });

    $("select").select2();

</script>

</body>
</html>