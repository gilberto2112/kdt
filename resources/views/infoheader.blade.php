@if(auth()->user()->role==='alumno')
    @if(auth()->user()->alumno)
        {{auth()->user()->alumno->grupo->nombre}} ({{auth()->user()->alumno->grupo->maestro->nombre}}) ({{auth()->user()->alumno->getNombreCompleto()}})<br>
        Puntos: {{auth()->user()->totalPuntosPrograma()}}, Avance:  {{number_format(\App\Top100::where('alumno_id',auth()->user()->alumno->id)->first()->avance,0)}}%

    @endif
@endif
