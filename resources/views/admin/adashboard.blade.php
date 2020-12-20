@extends('admin')
@section('adashboard')


<template v-if="amenu==0">
    <admin-dashboard></admin-dashboard>
</template>
    
<template v-if="amenu==1">
    <h1>Componente de admin</h1>
</template>

<template v-if="amenu==2">
        <h1>Componente de admin</h1>
    </template>

<template v-if="amenu==3">
        <h1>Componente de admin</h1>
    </template>

@endsection