<div class="sidebar" style="height: 100%;">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        <span style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <img src="../../../public/img/UCA.6b065e25.png" alt="uca" style="width: 41px; height: 55px;">
                            <p style="font-family: 'Abel'; font-size: 10px; color: white">Centro de Servicio Social</p>
                        </span>
                    </li>
                    <li @click='menu=0' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="../../../public/icons/assignment_white_24dp.svg" alt="proyectos"></i> Proyectos </a>
                    </li>
                    <li @click='menu=1' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="../../../public/icons/search_white_24dp.svg" alt="buscar"></i> Buscar estudiantes </a>
                    </li>
                    <li @click='menu=2' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="../../../public/icons/history_white_24dp.svg" alt="historial"></i> Historial de proyectos </a>
                    </li>
                    <li @click='menu=3' class="nav-item">
                        <a style="font-family: 'Abel';" class="nav-link active" href="#"><i><img src="../../../public/icons/lightbulb_white_24dp.svg" alt="recordatorio"></i> Recordatorio </a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer mobile-sidebar-toggler brand-minimizer" type="button"></button>
        </div>