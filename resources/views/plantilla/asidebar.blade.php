<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click='amenu=0' class="nav-item">
                        <a class="nav-link active" href="main.html"><i class="icon-home"></i> Inicio </a>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>
                    <li @click='amenu=1' class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-folder"></i> Proyectos Disponibles </a>
                    </li>
                    <li @click='amenu=2' class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-check"></i> Proyectos Aplicados </a>
                    </li>
                    <li @click='amenu=3' class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-calendar"></i> Historial de proyectos </a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>