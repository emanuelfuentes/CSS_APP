<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Administración de Estudiantes</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Estudiantes
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" v-model="carnet" class="form-control" placeholder="Ingrese el carnet del estudiante">
                                    <button type="submit" @click="buscarEstudiante()" class="btn btn-primary">Buscar</button>
                                </div>
                                <div class="input-group">
                                    <div v-if="flagError" class="mt-2 text-danger">
                                        No se ha encontrado resultados
                                    </div>
                                    <div v-else class="mt-2" style="visibility:hidden">
                                        Nada
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div v-if="nombre_completo == ''">
                            <h2 style="visibility:hidden; margin-bottom:0">Nada</h2>
                        </div>
                        <div v-else>
                            <h2 v-text="nombre_completo" style="margin-bottom:0"></h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-control-label">Facultad</label>
                                <select class="form-control custom-select" id="facultad" v-model="idFacultad">
                                    <option v-for="facultad in arrayFacultad" :value="facultad.idFacultad" :key="facultad.idFacultad">{{facultad.nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label">Carrera</label>
                                <select class="form-control custom-select" id="carrera" v-model="idCarrera">
                                    <option v-for="carrera in arrayCarrera" :value="carrera.idCarrera" :key="carrera.idCarrera">{{carrera.nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label">Año de carrera</label>
                                <select class="form-control custom-select" id="carrera" v-model="idPerfil">
                                    <option v-for="perfil in arrayPerfil" :value="perfil.idPerfil" :key="perfil.idPerfil">{{perfil.perfil}}</option>
                                </select>
                            </div>
                            <div v-if="flag" style="margin-bottom:0" class="alert alert-success row" role="alert">
                                Estudiante actualizado correctamente
                            </div>
                            <div v-else style="visibility:hidden; margin-bottom:0"  class="alert alert-success row" role="alert">
                                Estudiante actualizado correctmente
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" @click ="actualizarEstudiante()">Confirmar</button>
                    </div>
                </div>
            </div>
        </main>
</template>

<script>
import {API_HOST} from '../constants/endpoint.js';
    export default {
        data(){
            return{
                carnet : '',
                nombres : '',
                apellidos : '',
                idCarrera : 0,
                idFacultad : 0,
                idPerfil : 0,
                nombre_completo : '',
                arrayFacultad : [],
                arrayCarrera : [],
                arrayPerfil : [],
                flag : false,
                flagError : false 
            }
        },
        methods:{
            bindData(){
                let me = this
                axios.get(`${API_HOST}/facultad`).then(function (response){
                    me.arrayFacultad = response.data
                })
                axios.get(`${API_HOST}/perfil`).then(function (response) {
                    me.arrayPerfil = response.data;
                })
                $('#facultad').change(function(){
                    me.getCarreras()
                })
            },
            buscarEstudiante(){
                let me = this
                this.flag = false
                var url = `${API_HOST}/estudiante_por_carnet`
                axios.get(url, {
                    params:{
                        carnet: me.carnet
                    }
                }).then(function (response) {
                    var estudiante = response.data[0];
                    if(estudiante != null){
                        me.flagError = false
                        var carrera = response.data[1];
                        me.nombres = estudiante.nombres;
                        me.apellidos = estudiante.apellidos;
                        me.idCarrera = estudiante.idCarrera;
                        me.idPerfil = estudiante.idPerfil;
                        me.nombre_completo = estudiante.nombres + " " + estudiante.apellidos;
                        me.idFacultad = carrera.idFacultad;
                        me.getCarreras()
                    }
                    else me.flagError = true
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCarreras(){
                let me = this
                $.ajax({
                    type: "GET",
                    url: './carreraxfacultad',
                    data: {idFact:me.idFacultad},
                    success: function(res){
                        $('#carrera').empty();
                        $.each(res, function(key){
                            $('#carrera').append($("<option></option>").val(res[key]['idCarrera']).text(res[key]['nombre']));
                        })
                    },
                    error: function(){
                        console.log("No se ha seleccionado facultad");
                    }
                })
            },
            actualizarEstudiante(){
                let me = this
                axios.put(`${API_HOST}/estudiante/actualizar`, {
                    'carnet' : this.carnet,
                    'idCarrera' : this.idCarrera,
                    'idPerfil' : this.idPerfil
                }).then(function (response) {
                    me.flag = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cerrarModal(){
                
            },
            abrirModal(modelo, data = []){
                switch (modelo) {
                    case "editar":
                        {
                            
                        }
                    case "aplicar":
                        {
                            
                            break;
                        }
                    default:
                        break;
                }
            },
        },
        mounted(){
            this.bindData()
        }
    }
</script>
<style lang="scss">
@import '/public/css/ProyectosAdmin.css';
</style>