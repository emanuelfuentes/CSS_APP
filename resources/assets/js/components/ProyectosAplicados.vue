<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Proyectos Aplicados</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Proyectos aplicados
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
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
                                    <!--<th>Opciones</th> -->
                                    <th>Numero</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Información</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="proyecto in arrayProyectos" :key="proyecto.idProyecto">
                                   <!-- <td>
                                        <div v-if="proyecto.estado">
                                            <button type="button" @click="abrirModal('proyecto', proyecto)" class="btn btn-success btn-sm" data-target="#modalNuevo">
                                                <i class="icon-check"></i>
                                            </button> &nbsp;
                                        </div>
                                        <div v-else>
                                            <button disabled type="button" class="btn btn-success btn-sm" data-target="#modalNuevo">
                                            <i class="icon-check"></i>
                                            </button> &nbsp;
                                        </div>
                                        
                                    </td>-->
                                    <td v-text="proyecto.idProyecto"></td>
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
                                        </button>
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

            <!--Inicio del modal informacion de proyecto-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                id_proyecto : 0,                
                modal_encargado : '',
                modal_nombre : '',
                modal_desc : '',
                modal_tipo_horas : '',
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
            listarProyectos(page){
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
            cerrarModal(){
                this.modal = 0;
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
            this.listarProyectos();
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