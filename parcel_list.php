<?php include 'db_connect.php';
$num_page = $_GET['p'];
$num_page = ($num_page - 1) * 10;

?>
<div class="col-xl-auto">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <br>
            <div class="btn-group dropright">
                <!--<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Status
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="./index.php?page=parcel_list">Tout</a>
                    <?php
                /*                    $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
                                    foreach ($status_arr as $k => $v):*/ ?>
                        <a class="dropdown-item"
                           href="./index.php?page=parcel_list<?php /*if ($k != '') echo "&s=" . $k */ ?>">
                            <p><?php /*echo $v */ ?></p>
                        </a>
                    <?php /*endforeach; */ ?>
                </div>-->
                <div id="myBtnContainer">


                    <?php if (isset($_GET['s'])): ?>

                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&p=1"> Tout</a>

                        <?php if ($_GET['s'] == 0): ?>
                            <a id="btnf" class="btn btnf active"
                               href="./index.php?page=parcel_list&s=0&p=<?php echo $_GET['p'] ?>"> Enregistré</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=0&p=1"> Enregistré</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 1): ?>
                            <a id="btnf" class="btn btnf active"
                               href="./index.php?page=parcel_list&s=1&p=<?php echo $_GET['p'] ?>"> Envoyé</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=1&p=1"> Envoyé</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 2): ?>
                            <a id="btnf" class="btn btnf active"
                               href="./index.php?page=parcel_list&s=2&p=<?php echo $_GET['p'] ?>"> Livré en
                                gars</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=2&p=1"> Livré en gars</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 3): ?>
                            <a id="btnf" class="btn btnf active"
                               href="./index.php?page=parcel_list&s=3&p=<?php echo $_GET['p'] ?>"> Livré à
                                domicile</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=3&p=1"> Livré à
                                domicile</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 4): ?>
                            <a id="btna" class="btn btna active"
                               href="./index.php?page=parcel_list&s=4&p=<?php echo $_GET['p'] ?>"> Retour</a>
                        <?php else: ?>
                            <a id="btna" class="btn btna" href="./index.php?page=parcel_list&s=4&p=1"> Retour</a>
                        <?php endif; ?>

                    <?php else: ?>

                        <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list&p=1"> Tout</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=0&p=1"> Enregistré</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=1&p=1"> Envoyé</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=2&p=1"> Livré en gars</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=3&p=1"> Livré à domicile</a>
                        <a id="btna" class="btn btna" href="./index.php?page=parcel_list&s=4&p=1"> Retour</a>

                    <?php endif; ?>
                </div>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                   href="./index.php?page=new_parcel"><i class="fa fa-plus"></i> Ajouter Nouveau</a>
            </div>
        </div>
        <!--        <input class="form-control me-2" type="text" id="search" placeholder="Trouver">
        -->
        <div class="card-body">
            <table class="table table-bordered table-striped" id="list">

                <thead>
                <tr>
                    <th class="text-center bg-primary" style="width: 130px;font-size: small">Modifier</th>
                    <th class="text-center bg-primary" style="width: 60px;font-size: small">Réference</th>

                    <th class="text-center bg-info" style="width: 150px;font-size: medium">Expéditeur</th>
                    <th class="text-center bg-info" style="width: 70px;font-size: medium">CIN E</th>
                    <th class="text-center bg-info" style="width: 90px;font-size: medium">Ville</th>

                    <th class="text-center bg-success" style="width: 150px;font-size: medium">Destinataire</th>
                    <th class="text-center bg-success" style="width: 70px;font-size: medium">CIN D</th>
                    <th class="text-center bg-gradient-success" style="width: 90px;font-size: medium">Ville</th>

                    <th class="text-center bg-primary" style="width: 90px;font-size: small">Status</th>
                    <th class="text-center bg-primary" style="width: 200px;font-size: small">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;

                $where = "";

                if (isset($_GET['s'])) {
                    $where = " where status = {$_GET['s']} ";
                }
                if ($_SESSION['login_type'] != 1) {

                    if (empty($where)) {
                        $where = " where ";
                    } else {
                        $where .= " and ";
                    }
                    $where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
                }


                $qry = $conn->query("SELECT * from parcels $where  order by unix_timestamp(date_created) desc LIMIT $num_page,10");
                while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>

                        <td class="text-center">
                            <div class="btn-group fixed">
                                <?php if ($row['status'] == 0): ?>
                                    <button type="button" class="btn btn-primary btn-flat send_parcel"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                <?php endif; ?>

                                <?php if ($row['status'] == 1): ?>
                                    <button type="button" class="btn btn-info btn-flat save_parcel_agence"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                <?php endif; ?>

                                <?php if ($row['status'] == 0 && $row['type'] == 1): ?>
                                    <button type="button" class="btn btn-success btn-flat arrived_parcel_domicile"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if ($row['status'] == 0 && $row['type'] == 2): ?>
                                    <button type="button" class="btn btn-success btn-flat arrived_parcel_agence"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>

                                <?php if ($row['status'] == 1 && $row['type'] == 1): ?>
                                    <button type="button" class="btn btn-success btn-flat arrived_parcel_domicile"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if ($row['status'] == 1 && $row['type'] == 2): ?>
                                    <button type="button" class="btn btn-success btn-flat arrived_parcel_agence"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>

                                <?php if ($row['status'] == 0): ?>
                                    <button type="button" class="btn btn-danger btn-flat return_parcel"
                                            data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </button>
                                <?php endif; ?>
                        </td>
                        <td><b><?php echo($row['reference']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_id']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_city']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_cin']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                        <td class="text-center">
                            <?php for ($i = 0; $i <= ($num_page * 10); $i++) ?>
                                <?php
                            $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile","Retour");
                            switch ($row['status']) {
                                case '1':
                                    echo "<span class='badge badge-pill badge-primary'> Envoyé</span>";
                                    break;
                                case '2':
                                    echo "<span class='badge badge-pill badge-success'> Livré en gars</span>";
                                    break;
                                case '3':
                                    echo "<span class='badge badge-pill badge-success'> Livré à domicile</span>";
                                    break;
                                case '4':
                                    echo "<span class='badge badge-pill badge-danger'> Retour</span>";
                                    break;
                                default:
                                    echo "<span class='badge badge-pill badge-info'> Enregistré</span>";

                                    break;
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="./index.php?page=track_br&br=<?php echo $row['reference'] ?>"
                               class="btn btn-primary btn-flat ">
                                <i class="fas fa-map-marked"></i>
                            </a>
                            <button type="button" class="btn btn-primary btn-flat view_parcel"
                                    data-id="<?php echo $row['id'] ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="index.php?page=edit_parcel&id=<?php echo $row['id'] ?>"
                               class="btn btn-primary btn-flat ">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-danger btn-flat delete_parcel"
                                    data-id="<?php echo $row['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>

            <?php if (isset($_GET['s'])): ?>


                <?php if ($_GET['s'] == 0): ?>
                    <nav aria-label="page-buttons">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=0&p=1"><<</a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=0&p=<?php if ($_GET['p'] > 1) {
                                                         echo $_GET['p'] - 1;
                                                     } else {
                                                         echo 1;
                                                     } ?>"><</a></li>
                            <li class="page-item active"><a class="page-link"
                                                            href="./index.php?page=parcel_list&s=0&p=<?php echo $_GET['p'] ?>"><?php echo $_GET['p'] ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=0&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=0&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=0&p=<?php echo $_GET['p'] + 1 ?>">> </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

                <?php if ($_GET['s'] == 1): ?>
                    <nav aria-label="page-buttons">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=1&p=1"><< </a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=1&p=<?php if ($_GET['p'] > 1) {
                                                         echo $_GET['p'] - 1;
                                                     } else {
                                                         echo 1;
                                                     } ?>"> <</a></li>
                            <li class="page-item active"><a class="page-link"
                                                            href="./index.php?page=parcel_list&s=1&p=<?php echo $_GET['p'] ?>"><?php echo $_GET['p'] ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=1&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=1&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=1&p=<?php echo $_GET['p'] + 1 ?>">> </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

                <?php if ($_GET['s'] == 2): ?>
                    <nav aria-label="page-buttons">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=2&p=1"><< </a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=2&p=<?php if ($_GET['p'] > 1) {
                                                         echo $_GET['p'] - 1;
                                                     } else {
                                                         echo 1;
                                                     } ?>"><</a></li>
                            <li class="page-item active"><a class="page-link"
                                                            href="./index.php?page=parcel_list&s=2&p=1"><?php echo $_GET['p'] ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=2&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=2&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=2&p=<?php echo $_GET['p'] + 1 ?>">> </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

                <?php if ($_GET['s'] == 3): ?>
                    <nav aria-label="page-buttons">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=3&p=1"><<</a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=3&p=<?php if ($_GET['p'] > 1) {
                                                         echo $_GET['p'] - 1;
                                                     } else {
                                                         echo 1;
                                                     } ?>"><</a></li>
                            <li class="page-item active"><a class="page-link"
                                                            href="./index.php?page=parcel_list&s=3&p=1"><?php echo $_GET['p'] ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=3&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=3&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=3&p=<?php echo $_GET['p'] + 1 ?>">></a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

                <?php if ($_GET['s'] == 4): ?>
                    <nav aria-label="page-buttons">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=4&p=1"><<</a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=4&p=<?php if ($_GET['p'] > 1) {
                                                         echo $_GET['p'] - 1;
                                                     } else {
                                                         echo 1;
                                                     } ?>"><</a></li>
                            <li class="page-item active"><a class="page-link"
                                                            href="./index.php?page=parcel_list&s=4&p=1"><?php echo $_GET['p'] ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=4&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=4&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="./index.php?page=parcel_list&s=4&p=<?php echo $_GET['p'] + 1 ?>">></a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>


            <?php else: ?>

                <nav aria-label="page-buttons">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="./index.php?page=parcel_list&p=1"><<</a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="./index.php?page=parcel_list&p=<?php if ($_GET['p'] > 1) {
                                                     echo $_GET['p'] - 1;
                                                 } else {
                                                     echo 1;
                                                 } ?>"><</a></li>
                        <li class="page-item active"><a class="page-link"
                                                        href="./index.php?page=parcel_list&p=<?php echo $_GET['p'] ?>"><?php echo $_GET['p'] ?></a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                                 href="./index.php?page=parcel_list&p=<?php echo $_GET['p'] + 1 ?>"><?php echo $_GET['p'] + 1 ?></a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                                 href="./index.php?page=parcel_list&p=<?php echo $_GET['p'] + 2 ?>"><?php echo $_GET['p'] + 2 ?></a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                                 href="./index.php?page=parcel_list&p=<?php echo $_GET['p'] + 1 ?>">></a>
                        </li>
                    </ul>
                </nav>

            <?php endif; ?>


        </div>
    </div>
</div>
<style>
    td {
        font-size: 15px;
    }

    table {
        table-layout: fixed;
    }

    ::-webkit-input-placeholder {
        text-align: center;
    }

    table td {
        vertical-align: middle !important;
    }

    #btnf {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
    }

    #btnf:hover {
        background-color: #ddd;
    }

    #btnf.active {
        background-color: #0069D9;
        color: white;
    }
    #btna.active {
        background-color: #C82333;
        color: white;
    }
</style>
<script>
    $(document).ready(function () {
        $('#list').DataTable({
            "paging": false,
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
            "ordering": false,
        })
        $('.view_parcel').click(function () {
            uni_modal("Détails du colis", "view_parcel.php?id=" + $(this).attr('data-id'), "large")
            console.log($(this).attr('data-id'))
        })
        $('.delete_parcel').click(function () {
            _conf("Êtes-vous sûr de supprimer ce colis?", "delete_parcel", [$(this).attr('data-id')])
        })
        $('.send_parcel').click(function () {
            _conf("Voulez-vous envoyer ce colis?", "send_parcel", [$(this).attr('data-id')])
        })
        $('.arrived_parcel_domicile').click(function () {
            _conf("Le colis est-il arrivé à destination?", "arrived_parcel_domicile", [$(this).attr('data-id')])
        })
        $('.arrived_parcel_agence').click(function () {
            _conf("Le colis est-il arrivé à destination?", "arrived_parcel_agence", [$(this).attr('data-id')])
        })
        $('.save_parcel_agence').click(function () {
            _conf("Le colis est-il arrivé à l'agence?", "save_parcel_agence", [$(this).attr('data-id')])
        })
        $('.return_parcel').click(function () {
            _conf("Etes-vous sure de retourner le colis ?", "return_parcel", [$(this).attr('data-id')])
        })
    })

    function delete_parcel($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_parcel',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis supprimer", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    function send_parcel($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=update_parcel_send',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis mis-à envoyer", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    function arrived_parcel_domicile($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=arrived_parcel_domicile',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis arrivé", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    function arrived_parcel_agence($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=arrived_parcel_agence',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis arrivé", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    function save_parcel_agence($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_parcel_agence',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis enregistré", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    function return_parcel($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=return_parcel',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Colis mis-à retourner", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }

    $('#update_status').submit(function (e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=update_parcel',
            method: 'POST',
            data: $(this).serialize(),
            error: (err) => {
                console.log(err)
                alert_toast('Erreur.', "error")
                end_load()
            },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Status du Colis est mis-à-jour.", 'succés');
                    setTimeout(function () {
                        location.reload()
                    }, 750)
                }
            }
        })
    })
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btnf");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }

    var $rows = $('#list tbody tr');
    $('#search').keyup(function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>