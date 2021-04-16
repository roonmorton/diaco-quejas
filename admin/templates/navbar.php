<nav class="navbar is-danger " role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item">
                <h2 class="subtitle is-family-secondary ">
                    <strong style="color: #fff">
                        Diaco - Quejas
                    </strong>
                </h2>
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        <span class="icon ">
                            <i class="fas fa-user"></i>
                        </span>
                        <span> <?php echo $uNombres; ?></span>
                    </a>
                    <div class="navbar-dropdown">
                        <form id="salirForm" method="POST" action="" style="padding-right: .2em; margin-bottom: 0">
                            <input type="hidden" name="salir" value="1" />
                        </form>
                        <a class="navbar-item" id="btnSalir">
                            <span class="icon ">
                                <i class="fas fa-power-off"></i>
                            </span>
                            <span>Salir</span>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btnSalir = document.querySelector('#btnSalir');
    btnSalir.addEventListener('click', () => {
        document.querySelector('#salirForm').submit();
    });
});
</script>