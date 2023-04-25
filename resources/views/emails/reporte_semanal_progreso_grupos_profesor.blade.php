<style>
    table {
        width: 100%;
    }

    table tbody td {
        border: 1px solid black;
    }
</style>

@foreach($grupos as $grupo)
    Grupo: {{$grupo->nombre}}<br>
    <table>
        <thead>
        <tr>
            <td><br>
                Nombre
            </td>
            <td><br>
                Apellido Paterno
            </td>
            <td><br>
                Apellido Materno
            </td>
            @foreach($grupo->progresoSemanualGrupoAlumno->groupBy('fecha')->keys()->sort() as $key=>$fecha)
                <td>
                    Periodo #{{$fecha}}<br>
                    Puntos
                </td>
                <td><br>
                    Progreso
                </td>
                <td><br>
                    Puntos Examen
                </td>
                <td><br>
                    Cal Examen
                </td>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($grupo->progresoSemanualGrupoAlumno->groupBy('alumno_id') as $alumno)
            <tr>
                <td>
                    {{$alumno[0]->alumno->nombre}}
                </td>
                <td>
                    {{$alumno[0]->alumno->apellido_paterno}}

                </td>
                <td>
                    {{$alumno[0]->alumno->apellido_materno}}
                </td>
                @foreach($grupo->progresoSemanualGrupoAlumno->groupBy('fecha')->keys()->sort() as $key=>$fecha)
                    @php
                        $row = $alumno->groupBy('fecha')->values()->filter(function($q) use ($fecha) {
                            return $q->first()->fecha===$fecha;
                        })
                    @endphp

                    @if($row->count()>0)
                        @php
                            $row = $row->first();
                        @endphp
                        <td>
                            {{$row->first()->puntos}}
                        </td>
                        <td>
                            {{$row->first()->porcentaje}}%
                        </td>
                        <td>
                            {{$row->first()->examen_semanal_puntos}}
                        </td>
                        <td>
                            {{$row->first()->examen_semanal_porcentaje}}%
                        </td>
                    @else
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br>
@endforeach
