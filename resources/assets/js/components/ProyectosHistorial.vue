<template>
  <main class="main">
    <!-- Breadcrumb -->
    
    <ol class="breadcrumb" style="padding-left: 30px;">
      <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item active">Historial</li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Historial de proyectos
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-sm">
            <thead>
              <tr>
                <!--<th>Opciones</th> -->
                <th>Numero</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(proyecto, index) in arrayProyectos" :key="proyecto.idProyecto">
                <td>{{ index + 1 }}</td>
                <td v-text="proyecto.nombre" @click="abrirModal('info', proyecto)"></td>
                        <span class="badge badge-danger" style="border-radius: 5px"><img src="icons/x.svg"></span>
                  <div v-else @click="abrirModal('info', proyecto)">
                  </div>
                    <span class="badge badge-success" style="border-radius: 5px"><img src="icons/check2.svg"></span>
                  <div v-if="proyecto.estado" @click="abrirModal('info', proyecto)">
                <td style="text-align: center;">
                <td v-text="proyecto.descripcion" @click="abrirModal('info', proyecto)"></td>
                  </div>
                </td>
                </td>
                <td style="text-align: center;">
                  <button type="button" @click="abrirModal('info', proyecto)" class="btn btn-info btn-sm">
                    <i class="icon-info"></i>
                    <span>Información</span>
                  </button>
                  <div class="button-container">
                      <button type="button" @click="abrirModal('estado', proyecto)" data-toggle="modal" data-target="#statusModal" class="btn btn-success btn-sm" style="margin: 8px 0; width: 100%;">
                          <i class="icon-lock"></i>
                          <span class="btn-label">Activar</span>
                      </button>
                  </div>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page" ></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)" >Sig</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>

    <!--Inicio del modal informacion de proyecto-->
    <div class="modal fade" tabindex="-1" :class="{ mostrar: modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none" aria-hidden="true" id="modal-info">
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="modal_nombre">
              Aplicar a proyecto
            </h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered table-sm" style="font-size: 1.35em; margin-top: 10px">
              <tbody>                
                <tr>
                  <th style="background-color: #dedede;">Descripción</th>
                  <td v-text="modal_desc" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Tipo</th>
                  <td v-text="modal_tipo_horas" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Cupos</th>
                  <td v-text="modal_cupos" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Horario</th>
                  <td v-text="modal_horario" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Encargado</th>
                  <td v-text="modal_encargado" style="padding-left: 16px;"></td>
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
    <!--Inicio del modal estado del proyecto-->
    <div class="modal fade" tabindex="-1" role="dialog" id="statusModal" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Estado del proyecto</h4>
                    <button type="button" data-dismiss="modal" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>¿Activar este proyecto?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click ="estadoProyecto()">Confirmar</button>
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
import { API_HOST } from "../constants/endpoint.js";

export default {
  data() {
    return {
      user_email: '',
      nombre: "",
      descripcion: "",
      arrayProyectos: [""],
      modal: 0,
      id_proyecto: 0,
      modal_encargado: "",
      modal_nombre: "",
      modal_desc: "",
      modal_tipo_horas: "",
      modal_cupos: 0,
      modal_horario: "",
      modal_fecha_in: "",
      modal_fecha_fin: "",
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
    };
  },
  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    bindData(page){
      let me = this;
      //var url2 = '/public/proyecto?page=' + page;
      var url = `${API_HOST}/historial_proyectos?page=${page}`;
      axios.get(url).then(function (response) {
          var respuesta = response.data;
          var proyectos = respuesta.proyectos.data;
          me.arrayProyectos = proyectos;
          me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
          console.log(error);
        });
        axios.get(`${API_HOST}/get_user`).then(function (response) {
            me.user_email = response.data.correo;
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    estadoProyecto(){
      let me = this;
      axios.put(`${API_HOST}/proyecto/estado`, {
          'idProyecto' : this.id_proyecto,
          'estado' : 1
      }).then(function (response) {
          me.cerrarModal();
          me.bindData();
      }).catch(function (error) {
          console.log(error);
      }); 
  },
    cambiarPagina(page){
      let me = this;
      me.pagination.current_page = page;
      me.bindData(page);
    },

    cerrarModal() {
      this.modal = 0;
      this.moda2 = 0;
    },
    abrirModal(modelo, data = []) {
      switch (modelo) {
        case "info": {
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
        case "estado": {
          this.modal2 = 1;
          this.id_proyecto = data.idProyecto;
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
  },
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
</style>
