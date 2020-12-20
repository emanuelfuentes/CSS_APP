@extends('principal')
@section('edashboard')

    <template v-if="menu==0">
        <student-dashboard></student-dashboard>
    </template>
    
    <template v-if="menu==1">
        <h1>Componente de Proyectos Disponibles</h1>
    </template>

    <template v-if="menu==2">
        <h1>Componente de Proyectos Aplicados</h1>
    </template>

    <template v-if="menu==3">
        <h1>Componente de Historial de Proyectos</h1>
    </template>

@endsection