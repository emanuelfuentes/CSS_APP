<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Proyectos Disponibles</li>
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
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>Proyecto</td>
                                    <td>Descripción del proyecto</td>
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>Proyecto</td>
                                    <td>Descripción del proyecto</td>
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>Proyecto</td>
                                    <td>Descripción del proyecto</td>
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>Proyecto</td>
                                    <td>Descripción del proyecto</td>
                                    <td>
                                        <span class="badge badge-secondary">Inactivo</span>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-info btn-sm">
                                          <i class="icon-info"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-check"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>Proyecto</td>
                                    <td>Descripción del proyecto</td>
                                    <td>
                                        <span class="badge badge-secondary">Inactivo</span>
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
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2>¿Desea aplicar a este proyecto?</h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Aceptar</button>
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
        name: "student-dashboard",
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>