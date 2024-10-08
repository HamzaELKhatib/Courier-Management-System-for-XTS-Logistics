<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <div class="dropdown">
        <a href="./" class="brand-link">
            <?php if ($_SESSION['login_type'] == 1): ?>
                <a href="index.php" class="brand-link">
                    <img src="assets/dist/img/pic1.png" alt="XTS Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">Menu Admin</span>
                </a>
            <?php else: ?>
                <a href="index.php" class="brand-link">
                    <img src="assets/dist/img/pic1.png" alt="XTS Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">Menu Employé</span>
                </a>
            <?php endif; ?>

        </a>

    </div>
    <div class="sidebar pb-4 mb-4">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item dropdown">
                    <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tableau de bord
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['login_type'] == 1): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-edit_branch">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Branches
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.php?page=new_branch" class="nav-link nav-new_branch tree-item">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Ajouter Nouvelle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index.php?page=branch_list" class="nav-link nav-branch_list tree-item">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Lister</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-edit_staff">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Employées
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.php?page=new_staff" class="nav-link nav-new_staff tree-item">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Ajouter Nouveau</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index.php?page=staff_list" class="nav-link nav-staff_list tree-item">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Lister</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-edit_parcel">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Colis
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.php?page=new_parcel" class="nav-link nav-new_parcel tree-item">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Ajouter Nouveau</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php?page=parcel_list&s=0&p=1" class="nav-link nav-parcel_list nav-all tree-item">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Lister</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=track" class="nav-link nav-track">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Suivre Colis
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['login_type'] == 1): ?>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=reports" class="nav-link nav-reports">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Rapports
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($_SESSION['login_type'] == 1): ?>
                    <li class="nav-item dropdown">
                        <a href="./index.php?page=feuille_de_chargement" class="nav-link nav-chargement">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Feuille de chargement
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>
<script>
    $(document).ready(function () {
        var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
        var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
        if (s != '')
            page = page + '_' + s;
        if ($('.nav-link.nav-' + page).length > 0) {
            $('.nav-link.nav-' + page).addClass('active')
            if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
                $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
                $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
            }
            if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
                $('.nav-link.nav-' + page).parent().addClass('menu-open')
            }

        }

    })
</script>