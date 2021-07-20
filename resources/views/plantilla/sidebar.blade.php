<?php
    $ruta = App\Http\Controllers\UserController::ruta();
?>
<div class="sidebar" style="height: 100%; top: 0;" id="sidebarMenu">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        <span style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <img src="<?php echo $ruta; ?>/img/UCA.6b065e25.png" alt="uca" style="width: 41px; height: 55px;">
                            <p style="font-family: 'Abel'; font-size: 10px; color: white">Centro de Servicio Social</p>
                        </span>
                    </li>
                    <li @click='menu=0' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="<?php echo $ruta; ?>/img/icons/calendar-week.svg" alt="proyectos"></i> Proyectos Disponibles</a>
                    </li>
                    <li @click='menu=1' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="<?php echo $ruta; ?>/img/icons/calendar-check.svg" alt="buscar"></i> Proyectos Aplicados </a>
                    </li>
                    <li @click='menu=2' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="<?php echo $ruta; ?>/img/icons/lightbulb_white_24dp.svg" alt="historial"></i> Recordatorio </a>
                    </li>
                    <li @click='menu=3' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="<?php echo $ruta; ?>/img/icons/person.svg" alt="recordatorio"></i> Perfil </a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>