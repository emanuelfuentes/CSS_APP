<template>
  <main class="main" style="background-color: white;">
    <div class="container-fluid">
      <div class="card recordatorio-container">
        <img src="/css-proyecto/public/img/recordatorio.ae2960e4.png" />
      </div>
    </div>
    <footer class="app-footer" id="footer" style="display: flex; flex-direction: column; justify-content: center; font-size: 15px; padding: 10px 0px">
        <span><a target="_blank" href="http://www.uca.edu.sv/servicio-social/">Centro de Servicio Social | UCA</a> &copy; 2021</span>
        <span>Desarrollado por <a href="#"></a>Grupo de Horas Sociales</span>
    </footer>
  </main>
</template>
<style>
.recordatorio-container {
    padding-bottom: 37.88%;
    padding-top: 60px;
    position: relative;
}

.recordatorio-container img {
    bottom: 0;
    height: 100%;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
}

@media screen and (max-width: 991px) {
    .container-fluid {
        margin-top: 55px;
    }
}
</style>