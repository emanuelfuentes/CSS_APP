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
         <!--<img src="/public/img/recordatorio.ae2960e4.png" />-->
      </div>
    </div>
  </main>
</template>-->

<template>
    <main class="main">
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
                        <!--<div class="form-group row">
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
                        </div>-->
                        <table class="table table-bordered table-striped table-sm">
                            <tr>
                                <th>Correo Institucional</th>
                                <td>aqui se escribe el Correo</td>
                            </tr>
                            <tr>
                                <th>Carnet</th>
                                <td>aqui se escribe el Carnet</td>
                            </tr>
                            <tr>
                                <th>Nombres</th>
                                <td>aqui se escribe el Nombres</td>
                            </tr>
                            <tr>
                                <th>Apellidos</th>
                                <td>aqui se escribe el Apellidos</td>
                            </tr>
                            <tr>
                                <th>Facultad</th>
                                <td>aqui se escribe el Facultad</td>
                            </tr>
                            <tr>
                                <th>Carrera</th>
                                <td>aqui se escribe el Carrera</td>
                            </tr>
                            <tr>
                                <th>Perfil</th>
                                <td>aqui se escribe el Año</td>
                            </tr>
                        </table>
                        <!--<nav>
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
                        </nav>-->
                        <button class="button button1">Modificar Perfil</button>
                        <button class="button button2">Cambiar Contraseña</button>
                    </div>
                    
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            
        </main>
</template>

<script>
import {API_HOST} from '../constants/endpoint.js';
    export default {
        mounted() {
            console.log('Component mounted.')
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
</style>