<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Escritorio</li>
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
                                    <button type="button" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aplicar a proyecto</h4>
                            <button type="button" class="close" @click="cerrarModal() " aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2>¿Desea aplicar a este proyecto?</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click ="aplicarProyecto()">Confirmar</button>
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
                id_proyecto : 0
            }
        },
        methods:{
            listarProyectos(){
                let me = this
                axios.get('/public/mis_proyectos').then(function (response) {
                    me.arrayProyectos = response.data;
                    console.log(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                    console.log('kaudhgbvkahwd')
                });
            },
            cerrarModal(){
                this.modal = 0;
            },
            abrirModal(modelo, data = []){
                switch (modelo) {
                    case "proyecto":
                        {
                            this.modal = 1;
                            this.id_proyecto = data.idProyecto
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