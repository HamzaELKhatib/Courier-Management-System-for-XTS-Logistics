<?php include 'db_connect.php' ?>
<div class="col-lg-12">
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

                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list"> Tout</a>

                        <?php if ($_GET['s'] == 0): ?>
                            <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list&s=0"> Enregistré</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=0"> Enregistré</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 1): ?>
                            <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list&s=1"> Envoyé</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=1"> Envoyé</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 2): ?>
                            <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list&s=2"> Livré en
                                gars</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=2"> Livré en gars</a>
                        <?php endif; ?>

                        <?php if ($_GET['s'] == 3): ?>
                            <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list&s=3"> Livré à
                                domicile</a>
                        <?php else: ?>
                            <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=3"> Livré à domicile</a>
                        <?php endif; ?>

                    <?php else: ?>

                        <a id="btnf" class="btn btnf active" href="./index.php?page=parcel_list"> Tout</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=0"> Enregistré</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=1"> Envoyé</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=2"> Livré en gars</a>
                        <a id="btnf" class="btn btnf" href="./index.php?page=parcel_list&s=3"> Livré à domicile</a>

                    <?php endif; ?>
                </div>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                   href="./index.php?page=new_parcel"><i class="fa fa-plus"></i> Ajouter Nouveau</a>
            </div>
        </div>
        <input class="form-control me-2" type="text" id="search" placeholder="Trouver">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="list">

                <thead>
                <tr>
                    <th style="color:white ;width: 100px;border-bottom: 1px solid #000000;
                    border-left: 1px solid #ffffff;
                    border-right: 1px solid #ffffff" height="25" align="center" valign=middle bgcolor="#002060">Nouveau Status</th>
                    <th style="color:white ; border-bottom: 1px solid #000000;
                    border-left: 1px solid #ffffff;
                    border-right: 1px solid #ffffff" height="25" align="center" valign=middle bgcolor="#002060">N° DEC/BR</th>

                    <th style="border-bottom: 1px solid #000000;
                    border-left: 1px solid #ffffff;
                    border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0">Nom de l'expéditeur</th>
                    <th style="border-bottom: 1px solid #000000; border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0">CIN E</th>
                    <th style="border-bottom: 1px solid #000000; border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0">Ville</th>
                    <th style="border-bottom: 1px solid #000000; border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050">Nom du destinataire</th>
                    <th style="border-bottom: 1px solid #000000; border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050">CIN D</th>
                    <th style="border-bottom: 1px solid #000000; border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050">Ville</th>
                    <th style="color:white ;width: 10px;border-bottom: 1px solid #000000;
                    border-left: 1px solid #ffffff;
                    border-right: 1px solid #ffffff" height="25" align="center" valign=middle bgcolor="#002060">Status</th>
                    <th style="color:white ;width: 250px;border-bottom: 1px solid #000000;
                    border-left: 1px solid #ffffff;
                    border-right: 1px solid #ffffff" height="25" align="center" valign=middle bgcolor="#002060">Action</th>

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


                $qry = $conn->query("SELECT * from parcels $where order by  unix_timestamp(date_created) desc ");
                while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>

                        <td class="text-center">
                            <div class="btn-group">
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
                        </td>
                        <td><b><?php echo($row['br_dec']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_id']) ?></b></td>
                        <td><b><?php echo ucwords($row['sender_city']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_cin']) ?></b></td>
                        <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                        <td class="text-center">
                            <?php
                            $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
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
                                default:
                                    echo "<span class='badge badge-pill badge-info'> Enregistré</span>";

                                    break;
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="./index.php?page=track_br&br=<?php echo $row['br_dec'] ?>"
                               class="btn btn-primary btn-flat ">
                                <i class="fas fa-map-marked"></i>
                            </a>
                            <button type="button" class="btn btn-primary btn-flat view_parcel"
                                    data-bs-dismiss="<?php echo $row['id'] ?>">
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
        </div>
    </div>
</div>
<style>
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
</style>
<script>
    $(document).ready(function () {
        $('#list').DataTable({
            "paging": false,
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
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