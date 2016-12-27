<div class="content">
    <div id="main" class="row" data-url="{{ url('programacion') }}">
        @if ($status == 'success')
            <div id="alerta" class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Datos actualizados satisfactoriamente.
                </div>                                
            </div>
        @endif
        <div class="col-xs-12"><br></div>
        <div class="col-xs-12">
            Total de sesiones asignadas: {{ count($elementos) }}
        </div>
        <div class="col-xs-12"><br></div>
        <div class="col-xs-12">
            @if (count($elementos) > 0)
                <ul class="list-group" id="principal">
                    @foreach($elementos as $sesion)
                         <li class="list-group-item">
                            <h5 class="list-group-item-heading">
                                Sesión {{ $sesion->Objetivo_General }}
                                <a data-role="editar" href="{{ url('/profesores/sesiones/'.$sesion['Id'].'/editar') }}" class="pull-right btn btn-primary btn-xs">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                            </h5>
                            <p class="list-group-item-text">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <small>
                                                    Punto: {{ $sesion->cronograma->punto->toString() }} <br>
                                                	Fecha: {{ $sesion->Fecha }} / Horario: {{ $sesion->Inicio.' a '.$sesion->Fin }} <br>
                                                	Objetivos específicos: {{ $sesion->Objetivos_Especificos }} <br>
                                                	Recursos: {{ $sesion->Recursos }} <br>
                                                	Metodología a aplicar: {{ $sesion->Metodologia_Aplicar }} <br>
                                                	Fase Inicial: {{ $sesion->Fase_Inicial }} <br>
                                                	Fase Central: {{ $sesion->Fase_Central }} <br>
                                                	Fase Final: {{ $sesion->Fase_Final }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </p>
                            <?php
                                switch ($sesion->Estado)
                                {
                                    case 'Pendiente':
                                        $class = 'label-default';
                                    break;
                                    case 'Diligenciado':
                                        $class = 'label-primary';
                                    break;
                                    case 'Aprobado':
                                        $class = 'label-success';
                                    break;
                                    case 'Rechazado':
                                        $class = 'label-danger';
                                    break;
                                }
                            ?>
                            <span class="label {{ $class }}">{{ $sesion->Estado }}</span> 
                        </li>
                    @endforeach
                </ul>
            @else
                No se ha registrado ninguna sesión hasta el momento.
            @endif
        </div>
        <div id="paginador" class="col-xs-12">{!! $elementos->render() !!}</div>
    </div>
</div>