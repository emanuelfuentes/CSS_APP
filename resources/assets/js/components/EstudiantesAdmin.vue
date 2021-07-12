<template>
    <main class="main">
            <!-- Breadcrumb -->
            <header class="app-header navbar container-fluid">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="nav navbar-nav ml-auto" id="logout">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none" v-text="user_email"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <button class="dropdown-item" type="button" 
                    @click="logout()" style="cursor: pointer;"><i class="fa fa-lock"></i> Cerrar sesión</button>
                </div>
            </li>
        </ul>
    </header>
            <ol class="breadcrumb" style="padding-left: 30px;">
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
                                    <option v-for="carrera in arrayCarreraFact" :value="carrera.idCarrera" :key="carrera.idCarrera">{{carrera.nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label">Año de carrera</label>
                                <select class="form-control custom-select" id="carrera" v-model="idPerfil">
                                    <option v-for="perfil in arrayPerfil" :value="perfil.idPerfil" :key="perfil.idPerfil">{{perfil.perfil}}</option>
                                </select>
                            </div>
                            <div v-if="errorActualizar == 1" id="message" style="margin-bottom:0" class="alert alert-success row" role="alert">
                                Estudiante actualizado correctamente
                            </div>
                            <div v-else-if="errorActualizar == 2" id="message" style="margin-bottom:0" class="alert alert-danger row" role="alert">
                                Busque un estudiante
                            </div>
                            <div v-else-if="errorActualizar == 3" id="message" style="margin-bottom:0" class="alert alert-danger row" role="alert">
                                Seleccione una carrera
                            </div>
                            <div v-else style="visibility:hidden; margin-bottom:0"  class="alert row" role="alert">.</div>
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
                user_email: '',
                nombres : '',
                apellidos : '',
                idCarrera : 0,
                idFacultad : 1,
                idPerfil : 1,
                nombre_completo : '',
                arrayFacultad : [],
                arrayCarrera : [],
                arrayCarreraFact : [],
                arrayPerfil : [],
                errorActualizar : false,
                flagError : false,
            }
        },
        methods:{
            bindData(){
                let me = this
                axios.get(`${API_HOST}/facultad`).then(function (response){
                    me.arrayFacultad = response.data
                })
                axios.get(`${API_HOST}/carrera`).then(function (response) {
                    me.arrayCarrera = response.data;
                    me.getCarreras(false)
                })
                axios.get(`${API_HOST}/perfil`).then(function (response) {
                    me.arrayPerfil = response.data;
                })
                $('#facultad').change(function(){
                    me.getCarreras(false)
                })
                axios.get(`${API_HOST}/get_user`).then(function (response) {
                    me.user_email = response.data.correo;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            buscarEstudiante(){
                let me = this
                this.errorActualizar = false
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
                        me.getCarreras(true)
                    }
                    else me.flagError = true
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCarreras(flag){
                let me = this
                if(!flag) this.idCarrera = 0
                this.arrayCarreraFact = []
                this.arrayCarrera.forEach(function(element){
                    if(element.idFacultad == me.idFacultad) me.arrayCarreraFact.push(element)
                })
            },
            actualizarEstudiante(){
                let me = this
                if(this.carnet != ''){
                    if(this.idCarrera != null && this.idCarrera != 0){
                        axios.put(`${API_HOST}/estudiante/actualizar`, {
                            'carnet' : this.carnet,
                            'idCarrera' : this.idCarrera,
                            'idPerfil' : this.idPerfil
                        }).then(function (response) {
                            me.errorActualizar = 1
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                    else{
                        this.errorActualizar = 3
                    }
                }
                else{
                    this.errorActualizar = 2;
                }
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
            logout(){
                var url = `${API_HOST}/logout`;
                axios.post(url).then(() => location.href = `${API_HOST}/`)
            }
        },
        mounted(){
            this.bindData()
        }
    }
</script>
<style lang="scss">
@import '/public/css/ProyectosAdmin.css';
</style>