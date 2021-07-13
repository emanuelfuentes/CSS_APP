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
                                <th>Correo Institucional</th>
                                <td v-text="correo" ></td>
                            </tr>
                            <tr>
                                <th>Carnet</th>
                                <td v-text="carnet"></td>
                            </tr>
                            <tr>
                                <th>Nombres</th>
                                <td v-text="nombres"></td>
                            </tr>
                            <tr>
                                <th>Apellidos</th>
                                <td v-text="apellidos"></td>
                            </tr>
                            <tr>
                                <th>Facultad</th>
                                <td v-text="facultad"></td>
                            </tr>
                            <tr>
                                <th>Carrera</th>
                                <td v-text="carrera"></td>
                            </tr>
                            <tr>
                                <th>Perfil</th>
                                <td v-text="perfil"></td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            
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
                    console.log(response.data[0]);
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
            console.log('Component mounted.');
            this.bindData();
        }
    }
</script>

<style>
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
@media screen and (max-width: 991px) {
    #logout {
        margin-right: 30px;
    }
}
</style>