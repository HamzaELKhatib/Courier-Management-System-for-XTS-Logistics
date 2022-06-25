<?php include 'db_connect.php' ?>
<?php if ($_SESSION['login_type'] == 1): ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <h1 class="align-content-center">Feuille de chargement</h1>
            </div>
            <div class="col-lg-12">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="chauffeur" id="chauffeur"
                                               placeholder="Chauffeur">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="depart" id="depart"
                                               placeholder="Agence de départ">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="heure" id="heure"
                                               placeholder="Heure véhicule">
                                    </div>
                                </div>
                                <div class="col-md-6 float-md-right" id="">
                                    <div class="form-group" id="tbi-field">
                                        <label for="recipient_city" class="control-label">Ville de destination</label>
                                        <select name="recipient_city" id="recipient_city" class="form-control select2">
                                            <option value=""></option>
                                            <?php
                                            $cities = $conn->query("SELECT DISTINCT recipient_city FROM parcels");
                                            while ($row = $cities->fetch_assoc()):
                                                ?>
                                                <option value="<?php echo $row['recipient_city'] ?>" <?php echo isset($recipient_city) && $recipient_city == $row['recipient_city'] ? "selected" : '' ?>>
                                                    <?php echo(ucwords($row['recipient_city'])) ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                                <input class="btn btn-success btn-flat" id="submit" type="submit" value="Valider"
                                       name="submit">
                            </div>
                            <form></form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if (isset($_POST['submit'])): ?>
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                    <h2 class="align-content-center"></h2>
                </div>
                <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">

                    <div class="container">

                        <form method="post" action="index.php?page=feuille_chargement">

                            <input type="hidden" name="chauffeur"
                                   value="<?php echo $_POST['chauffeur'] ?>">
                            <input type="hidden" name="depart"
                                   value="<?php echo $_POST['depart'] ?>">
                            <input type="hidden" name="recipient_city"
                                   value="<?php echo $_POST['recipient_city'] ?>">
                            <input type="hidden" name="heure"
                                   value="<?php echo $_POST['heure'] ?>">
                            <table align="left" cellspacing="0" border="1" class="table table-bordered table-striped"
                                   id="table1" style="table-layout: fixed;">

                                <thead>


                                <h5 style="color: grey"><i>• Choisir les colis à envoyer: </i></h5>
                                <tr>
                                    <th class="text-center bg-primary" style="width: 60px;font-size: small">Réference
                                    </th>
                                    <th class="text-center bg-info" style="width: 150px;font-size: medium">Expéditeur
                                    </th>
                                    <th class="text-center bg-info" style="width: 70px;font-size: medium">CIN E</th>
                                    <th class="text-center bg-info" style="width: 90px;font-size: medium">Ville</th>
                                    <th class="text-center bg-success" style="width: 150px;font-size: medium">
                                        Destinataire
                                    </th>
                                    <th class="text-center bg-success" style="width: 70px;font-size: medium">CIN D</th>
                                    <th class="text-center bg-gradient-success" style="width: 90px;font-size: medium">
                                        Ville
                                    </th>
                                    <th class="text-center bg-primary" style="width:40px;font-size: small">Select <input
                                                type="checkbox" id="select-all"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $chauffeur = $_POST['chauffeur'];
                                $depart = $_POST['depart'];
                                $heure = $_POST['heure'];
                                $arrive = strtolower($_POST['recipient_city']);
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
                                $select_date = $conn->query("
SELECT parcel_id  
FROM parcel_tracks 
WHERE date_created >= CURDATE() && date_created < (CURDATE() + INTERVAL 1 DAY)
AND status=1 ");
                                while ($row1 = $select_date->fetch_assoc()):
                                    $parcel_id = $row1['parcel_id'];
                                    $qry = $conn->query("
SELECT * 
from parcels
where status=1 
and id = $parcel_id
and recipient_city LIKE '$arrive'
order by unix_timestamp(date_created) desc");
                                    while ($row = $qry->fetch_assoc()):
                                        ?>
                                        <tr>

                                            <td><b><?php echo($row['reference']) ?></td>
                                            <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                                            <td><b><?php echo ucwords($row['sender_id']) ?></b></td>
                                            <td><b><?php echo ucwords($row['sender_city']) ?></b></td>
                                            <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                                            <td><b><?php echo ucwords($row['recipient_cin']) ?></b></td>
                                            <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                                            <td class="text-center"><input type="checkbox"
                                                                           value="<?php echo $row['id'] ?>"
                                                                           name="check[]"></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php endwhile; ?>

                                </tbody>
                            </table>
                            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                                <input class="btn btn-success btn-flat" id="submit" type="submit" value="Choisir"
                                       name="submit">
                            </div>

                        </form>

                        <br>
                        <?php
                        $checked_array = array();
                        if (isset($_POST['submit'])) {
                            if (!empty($_POST['check'])) {
                                foreach ($_POST['check'] as $value) {
                                }
                                $checked_array = $_POST['check'];
                            }
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.getElementsByName('check[]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }

    </script>
<?php
endif;
?>