<template>
    <main class="main" style="background-color: white;">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Proyectos Aplicados</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div v-if="loadTable==true" class="card" style="border: none;">
                    <table-loader></table-loader>
                </div>
                <div v-else class="card" style="border: none;">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" style="font-size: 1.25em;">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 10%;">Nombre</th>
                                    <th style="text-align: center;" id="disappear">Descripción</th>
                                    <th style="width: 10%; text-align: center;">Cupos</th>
                                    <th style="width: 10%; text-align: center;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="proyecto in arrayProyectos" :key="proyecto.idProyecto">
                                    <td v-text="proyecto.nombre" data-toggle="modal" data-target="#modal-info" @click="abrirModal('info', proyecto)"></td>
                                    <td id="disappear" v-text="proyecto.descripcion" data-toggle="modal" data-target="#modal-info" @click="abrirModal('info', proyecto)"></td>
                                    <td v-text="`${proyecto.cupos_act}${'/'}${proyecto.cupos}`" data-toggle="modal" data-target="#modal-info" @click="abrirModal('info', proyecto)" style="text-align: center;"></td>
                                    <td>
                                        <div style="margin: 8px -9px 8px -5px;">
                                            <div style="display: flex; flex-direction: row; justify-content: center; margin: 0px 10px;">
                                                <button type="button" data-toggle="modal" data-target="#modal-eliminar" @click="abrirModal('desaplicar', proyecto)" class="btn btn-warning btn-sm" style="border-radius: 5px;">
                                                    <i class="icon-trash"></i>
                                                    <span class="btn-label">Desaplicar</span>
                                                </button> &nbsp;
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

            <!--Inicio del modal informacion de proyecto-->
            <div class="modal fade" tabindex="-1" id="modal-info" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="modal_nombre"></h4>
                            <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-sm" style="font-size: 1.35em; margin-top: 10px">
                                <tbody>                                    
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Descripción</th>
                                        <td v-text="modal_desc" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Tipo</th>
                                        <td v-text="modal_tipo_horas" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Cupos</th>
                                        <td v-text="`${modal_cupos_act}${'/'}${modal_cupos}`" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Horario</th>
                                        <td v-text="modal_horario" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Inicio</th>
                                        <td v-text="modal_fecha_in" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Fin</th>
                                        <td v-text="modal_fecha_fin" style="padding-left: 16px;"></td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #dedede; width: 15%;">Encargado</th>
                                        <td v-text="modal_encargado" style="padding-left: 16px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!--Inicio del modal eliminar-->
            <div class="modal fade" tabindex="-1" id="modal-eliminar" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="nombre"></h4>
                            <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2>¿Eliminar proyecto de su lista de aplicados?</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click ="desAplicarProyecto()">Confirmar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <footer class="app-footer" id="footer" style="display: flex; flex-direction: column; justify-content: center; font-size: 15px; padding: 10px 0px">
                <span><a target="_blank" href="http://www.uca.edu.sv/servicio-social/">Centro de Servicio Social | UCA</a> &copy; 2021</span>
                <span>Desarrollado por <a href="#"></a>Grupo de Horas Sociales</span>
            </footer>
        </main>
</template>

<script>
import {API_HOST} from '../constants/endpoint.js';
    export default {
        data(){
            return{
                loadTable : false,
                user_email: '',
                nombre : '',
                user_id : '',
                user_email: '',
                descripcion : '',
                arrayProyectos : [''],
                arrayPXE : [''],
                modal : 0,
                modal2 : 0,
                id_proyecto : 0,
                modal_encargado : '',
                modal_nombre : '',
                modal_desc : '',
                modal_tipo_horas : '',
                modal_cupos_act : 0,
                modal_cupos : 0,
                modal_horario : '',
                modal_fecha_in : '',
                modal_fecha_fin : '',
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 3
            }
        },
        computed:{
            isActived : function(){
                return this.pagination.current_page;
            },
            pagesNumber : function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = []
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            bindData(page){
                let me = this
                me.loadTable = true;
                var url = `${API_HOST}/proyectos_aplicados` /*?page=' + page*/;
                axios.get(url).then(function (response) {
                    me.arrayProyectos = response.data;
                    me.loadTable = false;
                })
                .catch(function (error) {
                    console.log(error);
                });

                axios.get(`${API_HOST}/get_user`).then(function (response) {
                    me.user_id = response.data.idUser;
                    me.user_email = response.data.correo;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            desAplicarProyecto(){
                let me = this;
                axios.post(`${API_HOST}/proyecto/desaplicar`, {
                    'idProyecto' : this.id_proyecto,
                    'idUser' : this.user_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.bindData();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal = 0;
                this.modal2 = 0;
            },
            abrirModal(modelo, data = []){
                switch (modelo) {
                    case "info":
                    {
                        this.modal = 1;
                        this.id_proyecto = data.idProyecto;
                        this.modal_encargado = data.encargado;
                        this.modal_nombre = data.nombre;
                        this.modal_desc = data.descripcion;
                        this.modal_tipo_horas = data.tipo_horas;
                        this.modal_cupos_act = data.cupos_act;
                        this.modal_cupos = data.cupos;
                        this.modal_horario = data.horario;
                        this.modal_fecha_in = data.fecha_inicio;
                        this.modal_fecha_fin = data.fecha_fin;
                        break;
                    }
                    case "desaplicar":
                    {
                        this.modal2 = 1;
                        this.id_proyecto = data.idProyecto;
                        this.nombre = data.nombre;
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
        mounted() {
            this.bindData();
        }
    }
</script>
<style>
    @font-face {
    font-family: 'Abel';
    src: url(/css-proyecto/public/fonts/Abel-Regular.ttf);
    }

    .main{
        font-family: 'Abel';
    }
    #footer{
    margin-left: 0px;
    }

    .modal-content{
        width : 100% !important;
        position : absolute !important;
    }
    .mostrar{
        display : list-item !important;
        opacity : 1 !important;
        background-color: #3c29297a !important;
    }
    @media screen and (min-width: 991px) {
    #logout {
        margin-right: 30px;
        }
    }
    @media screen and (max-width: 991px) {
    #logout {
        margin-right: 30px;
        }
    }

    @media screen and (max-width: 500px) {
    #disappear{
        display: none;
        }
        
    }

    @media screen and (max-width: 450px) {
        .btn-label {
            display: none;
        }
    }

    @media screen and (max-width: 760px) {
        .btn-label {
            display: none;
        }
    }

</style>