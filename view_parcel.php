<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = " . $_GET['id'])->fetch_array();
foreach ($qry as $k => $v) {
    $$k = $v;
}
if ($to_branch_id > 0 || $from_branch_id > 0) {
    $to_branch_id = $to_branch_id > 0 ? $to_branch_id : '-1';
    $from_branch_id = $from_branch_id > 0 ? $from_branch_id : '-1';
    $branch = array();
    $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while ($row = $branches->fetch_assoc()):
        $branch[$row['id']] = $row['address'];
    endwhile;
}
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <dl>
                                    <dt>N&deg; DEC/BR:</dt>
                                    <dd><h4><b><?php echo $br_dec ?></b></h4></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <dl>
                                    <dt>Référence:</dt>
                                    <dd><h4><b><?php echo $reference ?></b></h4></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="callout callout-info">
                            <b class="border-bottom border-primary">Informations sur l'expéditeur</b>
                            <dl>
                                <dt>Nom:</dt>
                                <dd><?php echo ucwords($sender_name) ?></dd>
                                <dt>Addresse:</dt>
                                <dd><?php echo ucwords($sender_address) ?></dd>
                                <dt>Contact:</dt>
                                <dd><?php echo ucwords($sender_contact) ?></dd>
                                <dt>Ville:</dt>
                                <dd><?php echo ucwords($sender_city) ?></dd>
                            </dl>
                        </div>
                        <div class="callout callout-info">
                            <b class="border-bottom border-primary">Informations sur le destinataire</b>
                            <dl>
                                <dt>Nom:</dt>
                                <dd><?php echo ucwords($recipient_name) ?></dd>
                                <dt>Addresse:</dt>
                                <dd><?php echo ucwords($recipient_address) ?></dd>
                                <dt>Contact:</dt>
                                <dd><?php echo ucwords($recipient_contact) ?></dd>
                                <dt>Ville:</dt>
                                <dd><?php echo ucwords($recipient_city) ?></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="callout callout-info">
                            <b class="border-bottom border-primary">Details de Colis</b>
                            <div class="row">
                                <div class="col-sm-6">
                                    <dl>
                                        <dt>Nombre:</dt>
                                        <dd><?php echo $number ?></dd>
                                        <dt>Poids:</dt>
                                        <dd><?php echo $weight . ' kg' ?></dd>
                                        <dt>Hauteur:</dt>
                                        <dd><?php echo $height . ' cm' ?></dd>
                                        <dt>Largeur:</dt>
                                        <dd><?php echo $width . ' cm' ?></dd>
                                        <dt>Longueur:</dt>
                                        <dd><?php echo $length . ' cm' ?></dd>
                                        <dt>Prix:</dt>
                                        <dd><?php echo number_format($price, 2) . ' dh' ?></dd>
                                    </dl>
                                </div>
                                <div class="col-sm-6">
                                    <dl>
                                        <dt>Type de livraison:</dt>
                                        <dd><?php echo $type == 1 ? "<span class='badge badge-warning'>Livraison à Domicile</span>" : "<span class='badge badge-success'>Livraison à l'Agence</span>" ?></dd>
                                    </dl>

                                    <dl>
                                        <dt>Type d'expédition:</dt>
                                        <dd><?php echo $type_expedition == 1 ? "<span class='badge badge-warning'>Express</span>" : "<span class='badge badge-success'>Simple</span>" ?></dd>
                                    </dl>

                                    <dl>
                                        <dt>Type de paiment:</dt>
                                        <dd><?php echo $payment_type == 1 ? "<span class='badge badge-warning'>Du</span>" : "<span class='badge badge-success'>Payé</span>" ?></dd>
                                    </dl>

                                    <dl>
                                        <dt>Retour de fond:</dt>
                                        <dd>
                                            <?php

                                            echo $type_retour_de_fond == 1 ? "<span class='badge badge-primary'>Espèce</span>&nbsp;<span class='badge badge-success'>Coût : $price_retour_de_fond dh</span>" : ($type_retour_de_fond == 2 ? "<span class='badge badge-primary'>Chèque</span>&nbsp;<span class='badge badge-success'>Coût : $price_retour_de_fond dh</span>" : ($type_retour_de_fond == 3 ? "<span class='badge badge-primary'>Traite</span>&nbsp;<span class='badge badge-success'>Coût : $price_retour_de_fond dh</span>" : "<span class='badge badge-primary'></span>"));

                                            ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <dl>
                        </div>
                        <div class="callout callout-info">
                            <dt>Branche qui a accepté le colis:</dt>
                            <dd><?php echo ucwords($branch[$from_branch_id]) ?></dd>
                            <!--                        --><?php /*if($type == 2): */ ?>
                            <dt>Branche la plus proche du destinataire pour le ramassage:</dt>
                            <dd><?php echo ucwords($branch[$to_branch_id]) ?></dd>
                            <!--                        --><?php /*endif; */ ?>
                            <dt>Status:</dt>
                            <dd>
                                <?php
                                switch ($status) {
                                    case '1':
                                        echo "<span class='badge badge-pill badge-info'> Envoyé</span>";
                                        break;
                                    case '2':
                                        echo "<span class='badge badge-pill badge-info'> Livré en gars</span>";
                                        break;
                                    case '3':
                                        echo "<span class='badge badge-pill badge-primary'> Livré à domicile</span>";
                                        break;
                                    default:
                                        echo "<span class='badge badge-pill badge-info'> Enregistré</span>";

                                        break;
                                }

                                ?>
                                <span class="btn badge badge-primary bg-gradient-primary" id='update_status'><i
                                            class="fa fa-edit"></i> Mettre à jour le statut</span>
                            </dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#update_status').click(function () {
            uni_modal("Mettre à jour le statut de: <?php echo $reference ?>", "manage_parcel_status.php?id=<?php echo $id ?>&cs=<?php echo $status ?>", "")
        })
    </script>