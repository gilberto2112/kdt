@foreach($gruposCodigos as $grupoCodigo)
    {{$grupoCodigo->grupo->nombre}}: {{$grupoCodigo->codigo}}
@endforeach