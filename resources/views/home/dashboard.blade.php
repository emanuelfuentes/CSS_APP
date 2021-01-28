@extends('principal')
@section('dashboard')
    @if(Auth::check())
        @if(Auth::user()->idRol == 1)
            <template v-if="menu==0">
                <admin-proyectos></admin-proyectos>
            </template>
            <template v-if="menu==1">
                <h1>Componente de Historial Aplicados2</h1>
            </template>
            <template v-if="menu==2">
                <recordatorio></recordatorio>
            </template>

        @elseif(Auth::user()->idRol == 2)
            <template v-if="menu==0">
                <todos-proyectos></todos-proyectos>
            </template>
            
            <template v-if="menu==1">
                <mis-proyectos></mis-proyectos>
            </template>

            <template v-if="menu==2">
                <h1>Componente NUEWVOOO</h1>
            </template>

            <template v-if="menu==3">
                <recordatorio></recordatorio>
            </template>
        @else
        @endif
    @endif
@endsection