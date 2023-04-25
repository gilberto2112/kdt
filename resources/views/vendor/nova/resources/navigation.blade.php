@if (count(\Laravel\Nova\Nova::availableResources(request())))
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="var(--sidebar-icon)"
                  d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"
            />
        </svg>
        <span class="sidebar-label">Estructuras</span>
    </h3>
    <ul class="list-reset mb-8">
        @if(in_array(auth()->user()->role,['administrador']))
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'alumnos'}}"
                         class="text-white text-justify no-underline dim">
                Alumnos
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'etiquetas'}}"
                         class="text-white text-justify no-underline dim">
                Etiquetas
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['maestro','administrador']))
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'grupos'}}"
                         class="text-white text-justify no-underline dim">
                Grupos
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))

        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'institucions'}}"
                         class="text-white text-justify no-underline dim">
                Instituciones
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))

        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'maestros'}}"
                         class="text-white text-justify no-underline dim">
                Maestros
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))

        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'problemas'}}"
                         class="text-white text-justify no-underline dim">
                Problemas
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['maestro','administrador','alumno']))

        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'unidads'}}"
                         class="text-white text-justify no-underline dim">
                Unidades
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'usuarios'}}"
                         class="text-white text-justify no-underline dim">
                Usuarios
            </router-link>
        </li>
        @endif
        @if(in_array(auth()->user()->role,['administrador']))

        <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill="var(--sidebar-icon)"
                      d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"
                />
            </svg>
            <span class="sidebar-label">Reportes</span>

        </h3>
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'resultados-por-leccions'}}"
                         class="text-white text-justify no-underline dim">
                Resultados Por Lección
            </router-link>
        </li>
        <li class="leading-tight mb-4 ml-8 text-sm">
            <router-link :to="{name: 'index',params: {resourceName: 'top100s'}}"
                         class="text-white text-justify no-underline dim">
                Top 100
            </router-link>
        </li>
        @endif

    </ul>
@endif
