@foreach($maestro->grupos as $grupo)
Grupo: {{$grupo->nombre}}<br>
<table>
    <thead>
        <tr>
            <td>
                Alumno
            </td>
            <td>
                Email
            </td>
            <td>
                Avance
            </td>
            <td>
                Puntos
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($grupo->alumnos->sortByDesc(function($q){return $q->usuario->problemasResueltosDePrograma();}) as $alumno)
        <tr>
            <td>{{$alumno->nombre}} {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}}</td>
            <td>{{$alumno->usuario->email}}</td>
            <td>{{number_format(($alumno->usuario->problemasResueltosDePrograma()/$totalProblemas)*100,1)}}</td>
            <td>{{$alumno->usuario->totalPuntosPrograma()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
@endforeach
