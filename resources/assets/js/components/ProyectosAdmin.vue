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
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <td>
                                        <button type="button" @click="abrirModal('editar', proyecto)" class="btn btn-warning btn-sm">
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="abrirModal('estado', proyecto)" class="btn btn-success btn-sm">
                                            <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="proyecto.nombre" id="name_p"></td>
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
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar proyecto</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_nombre" class="form-control" placeholder="Nombre del proyecto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Encargado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_encargado" class="form-control" placeholder="Nombre del encargado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cupos</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_cupos" class="form-control" placeholder="Cupos">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de horas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="modal_tipo_horas">
                                            <option value="Internas">Internas</option>
                                            <option value="Externas">Externas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_desc" class="form-control" placeholder="Descripción">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Horario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_horario" class="form-control" placeholder="Horario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de inicio</label>
                                    <div class="col-md-9">
                                        <datepicker v-model="modal_fecha_in"></datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de finalización</label>
                                    <div class="col-md-9">
                                        <datepicker v-model="modal_fecha_fin"></datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Contraparte</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modal_contraparte" class="form-control" placeholder="Contraparte">
                                    </div>
                                </div>
                                <div v-show="errorProyecto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorProyecto" :key="error" v-text="error">

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
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
            <!--Inicio del modal informacion de proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal4}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
    export default {
        data(){
            return{
                nombre : '',
                descripcion : '',
                arrayProyectos : [''],
                modal : 0,
                modal2 : 0,
                modal3 : 0,
                modal4: 0,
                id_proyecto : 0,                
                modal_encargado : '',
                modal_nombre : '',
                modal_desc : '',
                modal_tipo_horas : '',
                modal_cupos : 0,
                modal_horario : '',
                modal_fecha_in : '',
                modal_fecha_fin : '',
                modal_contraparte : '',
                modal_createdAt : '',
                modal_estado: 0,
                errorProyecto : [''],
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
                var url = '/public/proyecto?page=' + page;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProyectos = respuesta.proyectos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                    axios.post('/public/proyecto/insertar', {
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
                        'modifiedBy' : 'Usuario',
                        'createdAt' : "this.modal_createdAt"
                    }).then(function (response) {
                        me.cerrarModal();
                        me.bindData();
                    }).catch(function (error) {
                        console.log(error);
                    }); 
                }
                else{
                    axios.put('/public/proyecto/actualizar', {
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
                        'modifiedBy' : 'Usuario',
                        'createdAt' : "this.modal_createdAt"
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
                if(!this.modal_nombre) this.errorProyecto.push("El nombre del proyecto no puede ir vacio.");
                if(!this.modal_contraparte) this.errorProyecto.push("El campo contraparte no puede ir vacio.");
                if(!this.modal_cupos) this.errorProyecto.push("El campo cupos no puede ir vacio.");
                if(!this.modal_desc) this.errorProyecto.push("El campo descripcion no puede ir vacio.");
                if(!this.modal_encargado) this.errorProyecto.push("El campo encargados no puede ir vacio.");
                if(!this.modal_tipo_horas) this.errorProyecto.push("El campo tipo de horas no puede ir vacio.");

                if(this.errorProyecto.length >= 1) return true;
                else return false;
            },
            estadoProyecto(){
                let me = this;
                var state;
                if(this.modal_estado == 1) state = 0;
                else state = 1;
                console.log(this.id_proyecto)
                axios.put('/public/proyecto/estado', {
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
                this.modal = 0;
                this.modal2 = 0;
                this.modal3 = 0;
                this.modal4 = 0;
                this.id_proyecto = 0;
            },
            abrirModal(modelo, data = []){
                switch (modelo) {
                    case "insertar":
                        {
                            this.modal = 1;
                            break;
                        }
                    case "editar":
                        {
                            this.modal = 1;
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
                            break;
                        }
                    case "estado":
                        {
                            this.modal2 = 1;
                            this.id_proyecto = data.idProyecto;
                            this.modal_estado = data.estado;
                            break;
                        }
                    case "borrar":
                        {
                            this.modal3 = 1;
                            this.id_proyecto = data.idProyecto;
                            break;
                        }
                    case "info":
                        {
                            this.modal4 = 1;
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
            }
        },
        mounted() {
            this.bindData();
        }
    }
</script>
<style>
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
</style>