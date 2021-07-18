<template>
  <main class="main">
    <!-- Breadcrumb -->
    
    <ol class="breadcrumb" style="padding-left: 30px;">
      <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item active">Historial de Proyectos</li>
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
                <!--<th>Opciones</th> -->
                <!--<th>Numero</th>-->
                <th style="text-align: center;">Nombre</th>
                <th id="disappear" style="text-align: center;">Descripción</th>
                <th style="width: 10px; text-align: center;">Estado</th>
                <th style="width: 10px; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="proyecto in arrayProyectos" :key="proyecto.idProyecto">
                <!--<td>{{ index + 1 }}</td>-->
                <td v-text="proyecto.nombre" @click="abrirModal('info', proyecto)"></td>
                <td id="disappear" v-text="proyecto.descripcion" @click="abrirModal('info', proyecto)"></td>
                <td @click="abrirModal('info', proyecto)" style="text-align: center;">
                  <div style="display: flex; flex-direction: row; justify-content: center; border: none;">
                    <span class="badge badge-danger" style="border-radius: 5px"><img src="/img/icons/x.svg"></span>
                  </div>
                </td>
                <td >
                  <div style="margin: 8px -7px 8px -7px;">
                    <div style="display: flex; flex-direction: row; justify-content: center; margin: 0px 10px;">
                      <button type="button" @click="abrirModal('estado', proyecto)" data-toggle="modal" data-target="#statusModal" class="btn btn-success btn-sm" style="margin: 8px 0;">
                          <i class="icon-lock"></i>
                          <span class="btn-label">Activar</span>
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination" style="float: right;">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)" style="display: flex; justify-content: center; align-items: center; width: 32px; height: 35px;"><img src="/img/icons/chevron_left_black_24dp.svg" alt="chevron-left"></a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page" ></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)" style="display: flex; justify-content: center; align-items: center; width: 32px; height: 35px;"><img src="/img/icons/chevron_right_black_24dp.svg" alt="chevron-right"></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>

    <!--Inicio del modal informacion de proyecto-->
    <div class="modal fade" tabindex="-1" :class="{ mostrar: modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none" aria-hidden="true" id="#modal-info">
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="modal_nombre">
              Aplicar a proyecto
            </h4>
            <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
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
                  <td v-text="`${modal_cupos_act}${'/'}${modal_cupos}`" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Horario</th>
                  <td v-text="modal_horario" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Encargado</th>
                  <td v-text="modal_encargado" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Fecha inicial</th>
                  <td v-text="modal_fecha_in" style="padding-left: 16px;"></td>
                </tr>
                <tr>
                  <th style="background-color: #dedede;">Fecha final</th>
                  <td v-text="modal_fecha_fin" style="padding-left: 16px;"></td>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click ="estadoProyecto()">Confirmar</button>
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
import { API_HOST } from "../constants/endpoint.js";

export default {
  data() {
    return {
      loadTable : false,
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
      modal_cupos_act : 0,
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
      me.loadTable = true;
      //var url2 = '/public/proyecto?page=' + page;
      var url = `${API_HOST}/historial_proyectos?page=${page}`;
      axios.get(url).then(function (response) {
          var respuesta = response.data;
          var proyectos = respuesta.proyectos.data;
          me.arrayProyectos = proyectos;
          me.pagination = respuesta.pagination;
          me.loadTable = false;
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
          this.modal_cupos_act = data.cupos_act;
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
  background-color: #3c29297a !important;
}

@media screen and (max-width: 500px) {
#disappear{
    display: none;
    }
    
@import '/css/Font.css';
}
</style>
