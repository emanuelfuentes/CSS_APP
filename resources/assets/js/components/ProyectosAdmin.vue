<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Administración de Proyectos</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Listado de Proyectos
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <button type="button" @click="abrirModal('insertar', null)" class="btn btn-primary"><i class="icon-plus"></i> Agregar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Información</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="proyecto in arrayProyectos" :key="proyecto.idProyecto">
                                    <td style="display:flex; height:100%;">
                                        <div class="button-container">
                                            <button type="button" @click="abrirModal('editar', proyecto)" class="btn btn-warning btn-sm">
                                                <i class="icon-pencil"></i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="button-container" v-if="proyecto.estado">
                                            <button type="button" @click="abrirModal('estado', proyecto)" class="btn btn-danger btn-sm">
                                                <i class="icon-close"></i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="button-container" v-else>
                                            <button type="button" @click="abrirModal('estado', proyecto)" class="btn btn-success btn-sm">
                                                <i class="icon-check"></i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="button-container">
                                            <button type="button" @click="abrirModal('estudiantes', proyecto)" class="btn btn-info btn-sm">
                                                <i class="icon-people"></i>
                                            </button> &nbsp;
                                        </div>
                                    </td>
                                    <td v-text="proyecto.nombre"></td>
                                    <td v-text="proyecto.descripcion"></td>
                                    <td>
                                        <div v-if="proyecto.estado">
                                            <span class="badge badge-success">Disponible</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No disponible</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="abrirModal('info', proyecto)" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>  &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal editar proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" style="display: none; overflow-y: scroll;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div v-if="add_edit_flag = 1">
                                <h4 class="modal-title">Insertar nuevo proyecto</h4>
                            </div>
                            <div v-else-if="add_edit_flag = 2">
                                <h4 class="modal-title">Editar proyecto existente</h4>
                            </div>
                            
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_nombre" class="form-control inputs" placeholder="Nombre del proyecto">
                                        <p :class="{show: errorProyecto[0] == 1, hide: errorProyecto[0] != 1}" class="error">El nombre no puede ir vacío</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Encargado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_encargado" class="form-control" placeholder="Nombre del encargado">
                                        <p :class="{show: errorProyecto[1] == 1, hide: errorProyecto[1] != 1}" class="error">El nombre del encargado no puede ir vacío</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Cupos</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="modal_cupos" class="form-control" placeholder="Cupos">
                                        <p :class="{show: errorProyecto[2] == 1, hide: errorProyecto[2] != 1}" class="error">Los cupos no pueden ir vacios</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de horas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="modal_tipo_horas">
                                            <option value="Internas">Internas</option>
                                            <option value="Externas">Externas</option>
                                        </select>
                                        <p :class="{show: errorProyecto[3] == 1, hide: errorProyecto[3] != 1}" class="error">Debe seleccionar un tipo de horas</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <div class="col-md-9">
                                        <textarea type="text" v-model="modal_desc" class="form-control" placeholder="Descripción"></textarea>
                                        <p :class="{show: errorProyecto[4] == 1, hide: errorProyecto[4] != 1}" class="error">La Descripción no puede ir vacía</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Horario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_horario" class="form-control" placeholder="Horario">
                                        <p :class="{show: errorProyecto[5] == 1, hide: errorProyecto[5] != 1}" class="error">El horario no puede ir vacío</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Contraparte</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_contraparte" class="form-control" placeholder="Contraparte">
                                        <p :class="{show: errorProyecto[6] == 1, hide: errorProyecto[6] != 1}" class="error">La contraparte no puede ir vacía</p>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de inicio</label>
                                    <div class="col-md-9">
                                        <input type="date" value="2017-06-01" v-model="modal_fecha_in">
                                        <div v-if="errorProyecto[7] == 1 || errorProyecto[7] == 2">
                                            <p class="show error">{{errorDateMsg}}</p>
                                        </div>
                                        <div v-else>
                                            <p class="hide error">.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de finalización</label>
                                    <div class="col-md-9">
                                        <input type="date" value="2021-01-01" v-model="modal_fecha_fin">
                                        <div v-if="errorProyecto[8] == 1 || errorProyecto[8] == 2">
                                            <p class="show error">{{errorDateMsg}}</p>
                                        </div>
                                        <div v-else>
                                            <p class="hide error">.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row div-form">
                                    <label class="col-md-3 form-control-label" for="text-input">Carreras</label>
                                    <div class="col-md-9">
                                        <button type="button" @click="agregarACP()" class="btn btn-primary mb-2"><i class="icon-plus"></i> Agregar</button>
                                        <table class="table-sm table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Carrera</th>
                                                    <th>Rango</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="acp in arrayCarreraPerfil" :key="acp">
                                                    <td>
                                                        <select class="form-control custom-select" v-model="acp[0]">
                                                            <option v-for="carrera in arrayCarreras" :value="carrera.idCarrera" :key="carrera.idCarrera">{{carrera.nombre}}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control custom-select" v-model="acp[1]">
                                                            <option v-for="perfil in arrayPerfiles" :value="perfil.idPerfil" :key="perfil.idPerfil">{{perfil.perfil}}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control custom-select" v-model="acp[2]">
                                                            <option v-for="perfil in arrayPerfiles" :value="perfil.idPerfil" :key="perfil.idPerfil">{{perfil.perfil}}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="close" @click="eliminarACP(acp)" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </td>   
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="flagError">
                                            <P class="show error">{{errorPerfilMsg}}</P>
                                        </div>
                                        <div v-else>
                                            <p class="hide error">.</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click ="actualizarInsertarProyecto()">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!--Inicio del modal estado del proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal2}" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Estado del proyecto</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div v-if="modal_estado" class="modal-body">
                            <h2>¿Desactivar este proyecto?</h2>
                        </div>
                        <div v-else class="modal-body">
                            <h2>¿Activar este proyecto?</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click ="estadoProyecto()">Confirmar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!--Inicio de modal de estudiantes por proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal3}" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg modal-student" role="document">
                    <div class="modal-content modal-student">
                        <div class="modal-header">
                            <h4 class="modal-title">Estudiantes</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Carnet</th>
                                        <th>Año de carrera</th>
                                        <th>Carrera</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="estudiante in arrayEstudiantes" :key="estudiante.idEstudiante">
                                        <td v-text="estudiante.nombres"></td>
                                        <td v-text="estudiante.apellidos"></td>
                                        <td>Proximamente</td>
                                        <td v-text="arrayPerfiles[estudiante.idPerfil-1].perfil"></td>
                                        <td v-text="arrayCarreras[estudiante.idCarrera-1].nombre"></td>
                                        <td>
                                            <div v-if="estudiante.estado == 0">
                                                <button type="button" @click="abrirModal('confirmacion', estudiante, true)" class="btn btn-success btn-sm">
                                                    Aceptar
                                                </button>  &nbsp;
                                                <button type="button" @click="abrirModal('confirmacion', estudiante, false)" class="btn btn-danger btn-sm">
                                                    Rechazar
                                                </button>  &nbsp;
                                            </div>
                                            <div v-else-if="estudiante.estado == 1">
                                                ACEPTADO
                                            </div>
                                            <div v-else>
                                                RECHAZADO
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin del modal-->
            <!--Inicio del modal de confirmacion para aceptar o rechazar estudiantes-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal4}" role="dialog" style="display: none; overflow-y: scroll;" aria-hidden="true">
                <div class="modal-dialog modal-primary" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <div v-if="flagEstudiante">
                                <h4 class="modal-title">Aceptar estudiante</h4>
                            </div>
                            <div v-else>
                                <h4 class="modal-title">Rechazar estudiante</h4>
                            </div>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 v-text="nombre_estudiante_msg"></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click ="aceptarRechazarEstudiante()">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin del modal-->
            <!--Inicio del modal informacion de proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal5}" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="modal_nombre">Aplicar a proyecto</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <th>Tipo</th>
                                    <th>Cupos</th>
                                    <th>Horario</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td v-text="modal_tipo_horas"></td>
                                        <td v-text="modal_cupos"></td>
                                        <td v-text="modal_horario"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <th>Encargado</th>
                                    <th>Descripción</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td v-text="modal_encargado"></td>
                                        <td v-text="modal_desc"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
import {API_HOST} from '../constants/endpoint.js';
    export default {
        data(){
            return{
                arrayProyectos : [],
                arrayCarreras : [''],
                arrayPerfiles : [''],
                arrayCarreraPerfil : [[]],
                arrayEstudiantes : [],
                nombre_estudiante_msg : '',
                add_edit_flag : 0,
                modal : 0,
                modal2 : 0,
                modal3 : 0,
                modal4 : 0,
                modal5 : 0,
                id_proyecto : 0,  
                id_estudiante : 0,              
                modal_encargado : '',
                modal_nombre : '',
                modal_desc : '',
                modal_tipo_horas : '',
                modal_cupos : '',
                modal_horario : '',
                modal_fecha_in : '',
                modal_fecha_fin : '',
                modal_contraparte : '',
                modal_carrera : 0,
                modal_perfil : 0,
                modal_createdAt : '',
                modal_estado: 0,
                errorProyecto : [''],
                errorDateMsg : '',
                errorPerfilMsg : '',
                flagError : false,
                flagEstudiante : false,
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
                //var url = '/public/proyecto?page=' + page;
                var url = `${API_HOST}/todos_proyectos?page=${page}`
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProyectos = respuesta.proyectos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.getCarrerasAndPerfils();
            },
            cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.bindData(page);
            },
            actualizarInsertarProyecto(){
                if(this.validarProyecto()){
                    return;
                }
                let me = this;
                if(!this.id_proyecto){
                    axios.post(`${API_HOST}/proyecto/insertar`, {
                        'idProyecto' : this.id_proyecto,
                        'estado' : 1,
                        'contraparte' : this.modal_contraparte,
                        'cupos' : this.modal_cupos,
                        'descripcion' : this.modal_desc,
                        'encargado' : this.modal_encargado,
                        'fecha_inicio' : this.modal_fecha_in,
                        'fecha_fin' : this.modal_fecha_fin,
                        'horario' : this.modal_horario,
                        'nombre' : this.modal_nombre,
                        'tipo_horas' : this.modal_tipo_horas,
                        'modificado_por' : 'Usuario',
                        'createdAt' : "this.modal_createdAt",
                        'carreraPerfil' : this.arrayCarreraPerfil
                    }).then(function (response) {
                        me.cerrarModal();
                        me.bindData();
                    }).catch(function (error) {
                        console.log(error);
                    }); 
                }
                else{
                    axios.put(`${API_HOST}/proyecto/actualizar`, {
                        'idProyecto' : this.id_proyecto,
                        'estado' : this.modal_estado,
                        'contraparte' : this.modal_contraparte,
                        'cupos' : this.modal_cupos,
                        'descripcion' : this.modal_desc,
                        'encargado' : this.modal_encargado,
                        'fecha_inicio' : this.modal_fecha_in,
                        'fecha_fin' : this.modal_fecha_fin,
                        'horario' : this.modal_horario,
                        'nombre' : this.modal_nombre,
                        'tipo_horas' : this.modal_tipo_horas,
                        'modificado_por' : 'Usuario',
                        'createdAt' : "this.modal_createdAt",
                        'carreraPerfil' : this.arrayCarreraPerfil
                    }).then(function (response) {
                        me.cerrarModal();
                        me.bindData();
                    }).catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            validarProyecto(){
                this.errorProyecto = [];
                this.flagError = false;
                this.errorPerfilMsg = "";

                if(!this.modal_nombre) this.errorProyecto.push(1);
                else this.errorProyecto.push(0);
                if(!this.modal_encargado) this.errorProyecto.push(1);
                else this.errorProyecto.push(0);
                if(!this.modal_cupos) this.errorProyecto.push(1);
                else this.errorProyecto.push(0);
                if(!this.modal_tipo_horas) this.errorProyecto.push(1);
                else this.errorProyecto.push(0)
                if(!this.modal_desc) this.errorProyecto.push(1);
                else this.errorProyecto.push(0)
                if(!this.modal_horario) this.errorProyecto.push(1);
                else this.errorProyecto.push(0);
                if(!this.modal_contraparte) this.errorProyecto.push(1);
                else this.errorProyecto.push(0);
                if(!this.modal_fecha_in) {
                    this.errorProyecto.push(1);
                    this.errorDateMsg = "Debe seleccionar una fecha";
                }
                else if(this.modal_fecha_in >= this.modal_fecha_fin) {
                    this.errorProyecto.push(2);
                    this.errorDateMsg = "La fecha seleccionada no concuerda con la otra fecha"
                }
                else this.errorProyecto.push(0);
                if(!this.modal_fecha_fin) this.errorProyecto.push(1);
                else if(this.modal_fecha_in >= this.modal_fecha_fin) this.errorProyecto.push(2);
                else this.errorProyecto.push(0);
                
                var flagCP1 = true, flagCP2 = true, flagCP3 = true;
                var msg1 = "", msg2 = "", msg3 = "";
                var i = 0, j = 0;

                this.arrayCarreraPerfil.forEach(document => {
                    if((!document[0] || !document[1] || !document[2]) && flagCP1){
                        msg1 = "Debe seleccionar todos los campos. ";
                        flagCP1 = false;
                        this.flagError = true;
                    }
                    if(document[1] > document[2] && flagCP2){
                        msg2 = "Rango invalido, seleccione rangos válidos. ";
                        flagCP2 = false;
                        this.flagError = true;
                    }
                    j = 0;
                    this.arrayCarreraPerfil.forEach(subDocument => {
                        if(subDocument[0] && (i != j && document[0] == subDocument[0]) && flagCP3){
                            msg3 = "No puede seleccionar la misma carrera más de una vez."
                            flagCP3 = false;
                            this.flagError = true;
                            console.log(i)
                            console.log(j)
                        }
                        j++
                    })
                    i++;
                })
                this.errorPerfilMsg += msg1 + msg2 + msg3;

                if(!this.errorProyecto.find(element => element > 0)) return false;
                return true;
            },
            estadoProyecto(){
                let me = this;
                var state;
                if(this.modal_estado == 1) state = 0;
                else state = 1;
                console.log(this.id_proyecto)
                axios.put(`${API_HOST}/proyecto/estado`, {
                    'idProyecto' : this.id_proyecto,
                    'estado' : state
                }).then(function (response) {
                    me.cerrarModal();
                    me.bindData();
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            cerrarModal(){
                if(this.modal == 1){
                    this.modal = 0;
                    this.arrayCarreraPerfil = [[]];
                    this.modal_nombre = '';
                    this.modal_encargado = '';
                    this.modal_cupos = ''
                    this.modal_desc = '';
                    this.modal_horario = '';
                    this.modal_contraparte = '';
                    this.modal_tipo_horas = '';
                    this.contraparte = '';
                    this.modal_fecha_in = '';
                    this.modal_fecha_fin = '';
                    this.errorProyecto = [];
                    this.errorDateMsg = '';
                }
                else if(this.modal4 == 1){
                    this.modal4 = 0;
                }
                else{
                    this.add_edit_flag = 0;
                    this.modal2 = 0;
                    this.modal3 = 0;
                    this.modal5 = 0;
                    this.id_proyecto = 0;
                }
            },
            abrirModal(modelo, data = [], flag){
                switch (modelo) {
                    case "insertar":
                        {
                            this.modal = 1;
                            this.add_edit_flag = 1;
                            this.flagError = false;
                            this.errorPerfilMsg = "";
                            break;
                        }
                    case "editar":
                        {
                            this.updateCarrerasAndPerfil();
                            this.modal = 1;
                            this.add_edit_flag = 2;
                            this.id_proyecto = data.idProyecto;
                            this.modal_encargado = data.encargado;
                            this.modal_nombre = data.nombre;
                            this.modal_desc = data.descripcion;
                            this.modal_tipo_horas = data.tipo_horas;
                            this.modal_cupos = data.cupos;
                            this.modal_horario = data.horario;
                            this.modal_fecha_in = data.fecha_inicio;
                            this.modal_fecha_fin = data.fecha_fin;
                            this.modal_contraparte = data.contraparte;
                            this.modal_createdAt = data.createdAt;
                            this.flagError = false;
                            this.errorPerfilMsg = "";
                            break;
                        }
                    case "estado":
                        {
                            this.modal2 = 1;
                            this.id_proyecto = data.idProyecto;
                            this.modal_estado = data.estado;
                            break;
                        }
                    case "estudiantes":
                        {
                            this.modal3 = 1;
                            this.id_proyecto = data.idProyecto;
                            this.modal_nombre = data.nombre;
                            this.modal_cupos = data.cupos;
                            this.getEstudiantes()
                            break;
                        }
                    case "confirmacion":
                        {
                            this.modal4 = 1;
                            if(flag) this.nombre_estudiante_msg = "¿Aceptar al estudiante " + data.nombres + " " + data.apellidos + "?";
                            else this.nombre_estudiante_msg = "¿Rechazar al estudiante " + data.nombres + " " + data.apellidos + "?";
                            this.flagEstudiante = flag;
                            this.id_estudiante = data.idUser;
                            break;
                        }
                    case "info":
                        {
                            this.modal5 = 1;
                            this.id_proyecto = data.idProyecto;
                            this.modal_encargado = data.encargado;
                            this.modal_nombre = data.nombre;
                            this.modal_desc = data.descripcion;
                            this.modal_tipo_horas = data.tipo_horas;
                            this.modal_cupos = data.cupos;
                            this.modal_horario = data.horario;
                            this.modal_fecha_in = data.fecha_inicio;
                            this.modal_fecha_fin = data.fecha_fin;
                            break;
                        }
                    default:
                        break;
                }
            },
            getCarrerasAndPerfils(){
                let me = this
                axios.get(`${API_HOST}/carrera`).then(function (response) {
                    me.arrayCarreras = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
                axios.get(`${API_HOST}/perfil`).then(function (response) {
                    me.arrayPerfiles = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            updateCarrerasAndPerfil(){
                let me = this
                axios.get(`${API_HOST}/proyectosxcarrera`).then(function(response){
                    var i = 0;
                    response.data.forEach(document =>{
                        if(document.idProyecto == me.id_proyecto){
                            me.arrayCarreraPerfil[i][0] = document.idCarrera;
                            me.arrayCarreraPerfil[i][1] = document.limite_inf;
                            me.arrayCarreraPerfil[i][2] = document.limite_sup;
                            me.arrayCarreraPerfil.push([]);
                            i++;
                        }
                    })
                    if(i != 0) me.arrayCarreraPerfil.pop() 
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            agregarACP(){
                this.arrayCarreraPerfil.push([])
            },
            eliminarACP(acp){
                let index = this.arrayCarreraPerfil.indexOf(acp);
                this.arrayCarreraPerfil.splice(index, 1)
            },
            getEstudiantes(){
                let me = this;
                axios.get(`${API_HOST}/estudiantesxproyecto`, {
                    params:{
                        idProyecto: me.id_proyecto
                    }
                }).then(function (response){
                    me.arrayEstudiantes = response.data;
                    console.log(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            aceptarRechazarEstudiante(){
                let me = this;
                var estadoEst = 2;
                if(this.flagEstudiante) estadoEst = 1;
                axios.put(`${API_HOST}/aplicarestudiante`, {
                    'idUser' : this.id_estudiante,
                    'idProyecto' : this.id_proyecto,
                    'estado' : estadoEst
                }).then(function (response) {
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                }); 
            }
        },
        mounted() {
            this.bindData();
        }
    }
</script>
<style>
    .button-container{
        margin: 0em 0.25em;
    }
    .modal-content{
        width : 100% !important;
        position : absolute !important;
    }
    .mostrar{
        display : list-item !important;
        opacity : 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .error{
        color: red;
        margin: 0.25em;
        margin-bottom: 0.5em;
    }
    .show{
        visibility: visible;
    }
    .hide{
        visibility: hidden;
    }
    .div-form{
        margin-bottom: 0em;
    }
    .modal-student{
        width: 65%;
        max-width: none;
    }
</style>