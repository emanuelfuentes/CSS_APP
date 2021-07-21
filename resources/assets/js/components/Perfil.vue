<!--<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        
        <table>
          <tr>
            <th>Correo</th>
            <td>aqui se escribe el Correo</td>
          </tr>
        </table>
         <!--<img src="/public/img/recordatorio.ae2960e4.png" />
      </div>
    </div>
  </main>
</template>-->

<template>
    <main class="main" style="background-color: white;">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Perfil</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Perfil
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <tr>
                                <th style="background-color: #dedede; width: 10%;">Correo Institucional</th>
                                <td v-text="correo" ></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Carnet</th>
                                <td v-text="carnet"></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Nombres</th>
                                <td v-text="nombres"></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Apellidos</th>
                                <td v-text="apellidos"></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Facultad</th>
                                <td v-text="facultad"></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Carrera</th>
                                <td v-text="carrera"></td>
                            </tr>
                            <tr>
                                <th style="background-color: #dedede">Perfil</th>
                                <td v-text="perfil"></td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
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
                user_id : 0,
                user_email: '',
                correo : '',
                carnet : 0,
                nombres : '',
                apellidos : '',
                carrera : '',                
                facultad : '',
                perfil: ''
            }
        },
        methods:{
            bindData(){
                let me = this
                axios.get(`${API_HOST}/get_user`).then(function (response) {
                    me.user_id = response.data.idUser;
                    me.correo = response.data.correo;
                    var splitString = me.correo.split(/@/);
                    me.carnet = splitString[0];
                    me.nombres = response.data.nombres;
                    me.apellidos = response.data.apellidos;
                })
                .catch(function (error) {
                    console.log(error);
                });

                axios.get(`${API_HOST}/mi_carrera`).then(function (response) {
                    var res = response.data[0];
                    me.carrera = res.nombre_c;
                    me.facultad = res.nombre_f;
                    me.perfil = res.anio_carrera;
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

.button {
  border: none;
  color: white;
  padding: 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {background-color: #008CBA;}
.button2 {background-color: #008CBA;}



@media screen and (min-width: 991px) {
    #logout {
        margin-right: 30px;
    }
}

.sidebar-fixed .sidebar {
    height: 100%;
}

@media screen and (max-width: 991px) {
    .breadcrumb {
        margin-top: 55px;
    }

    #sidebarMenu {
        margin-top: 55px;
    }
    
    #logout {
        margin-right: 30px;
    }

    .main{
        overflow: scroll;
    }
    
}
</style>