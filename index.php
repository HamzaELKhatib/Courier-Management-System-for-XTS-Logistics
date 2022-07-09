<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php
if (!isset($_SESSION['login_id']))
    header('location:login.php');
include 'database/db_connect.php';

include 'header.php'
?>
<body class="hold-transition sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include 'topbar.php' ?>
    <?php include 'sidebar.php' ?>
    
    <div class="content-wrapper">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white">
            </div>
        </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>

                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                if (!file_exists($page . ".php")) {
                    include 'exception/404.html';
                } else {
                    include $page . '.php';

                }
                ?>
            </div>
        </section>

        <div class="modal fade" id="confirm_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <div id="delete_content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continuer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="uni_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='submit'
                                onclick="$('#uni_modal form').submit()">Enregistrer
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tracking_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 50px">X</button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="uni_modal_right" role='dialog'>
            <div class="modal-dialog modal-full-height  modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="fa fa-arrow-right"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewer_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span>
                    </button>
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

    <footer class="main-footer">
        <strong>Copyright &copy; <a>XTS Logistics</a>.</strong>
        All rights reserved.

    </footer>
</div>


<?php include 'footer.php' ?>
</body>
</html>
