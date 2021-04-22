<div style="margin: 1em">
    <aside class="menu">
        <p class="menu-label">
            Inicio
        </p>
        <ul class="menu-list">
            <li>
                <a class="<?php if ($path == 'adminIndex') echo  'is-active has-background-danger'; ?> " href="/admin/">
                    <span class="icon ">
                        <i class="fas fa-home"></i>
                    </span>
                    <span>Inicio</span>
                </a>
            </li>
            <li><a href="/admin/sucursales" class="<?php if ($path == 'sucursalReporte') echo  'is-active has-background-danger'; ?> ">
                    <span class="icon ">
                        <i class="fas fa-gem"></i>
                    </span>
                    <span>Sucursales</span>
                </a></li>
            <li><a href="/admin/quejas" class="<?php if ($path == 'quejaReporte') echo  'is-active has-background-danger'; ?> ">
                    <span class="icon ">
                        <i class="fas fa-heart-broken"></i>
                    </span>
                    <span>Quejas</span>
                </a></li>
        </ul>
        <p class="menu-label">
            Mantenimientos
        </p>
        <ul class="menu-list">
            <li><a href="/admin/regiones" class="<?php if ($path == 'regionIndex') echo  'is-active has-background-danger'; ?> ">

                    <span class="icon ">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span>Regiones</span>
                </a></li>
            <li><a href="/admin/paises" class="<?php if ($path == 'paisIndex') echo  'is-active has-background-danger'; ?> ">
                    <span class="icon ">
                        <i class="fas fa-globe-americas"></i>
                    </span>
                    <span>Paises</span>

                </a></li>

            <li><a href="/admin/comercios" class="<?php if ($path == 'comercioIndex') echo  'is-active has-background-danger'; ?> ">
                    <span class="icon ">
                        <i class="fas fa-gem"></i>
                    </span>
                    <span>Comercios</span>
                </a></li>
        </ul>
    </aside>
</div>