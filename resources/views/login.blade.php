
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">



    <title>login</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ URL::asset('light/assets/plugins/morris/morris.css') }}">



    <!-- App css -->
    <link href="{{ URL::asset('light/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/plugins/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('light/assets/plugins/select2/dist/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('light/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('light/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="m-t-40 card-box">
            @if (count($message) > 0)
                <div class="alert alert-danger">
                    <ul>

                        <li>{{$message}}</li>

                    </ul>
                </div>
            @endif
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">Ingresar</h4>
            </div>
            <div class="panel-body">

                <form class="form-horizontal m-t-20" action="{{action('LoginController@entrar')}}" method="POST">

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input name="user" class="form-control" type="text" required="" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input name="password" class="form-control" type="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button id="enviar" class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <!-- end card-box-->


    </div>