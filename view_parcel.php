<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
    $$k = $v;
}
if($to_branch_id > 0 || $from_branch_id > 0){
    $to_branch_id = $to_branch_id  > 0 ? $to_branch_id  : '-1';
    $from_branch_id = $from_branch_id  > 0 ? $from_branch_id  : '-1';
    $branch = array();
    $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while($row = $branches->fetch_assoc()):
        $branch[$row['id']] = $row['address'];
    endwhile;
}
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <dl>
                        <dt>Numéro de suivi:</dt>
                        <dd> <h4><b><?php echo $reference_number ?></b></h4></dd>
                    </dl>
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
                    </dl>
                </div>
            </div>
            <div class="col-md-6">
                <div class="callout callout-info">
                    <b class="border-bottom border-primary">Details de Colis</b>
                    <div class="row">
                        <div class="col-sm-6">
                            <dl>
                                <dt>Poids:</dt>
                                <dd><?php echo $weight ?></dd>
                                <dt>Hauteur:</dt>
                                <dd><?php echo $height ?></dd>
                                <dt>Prix:</dt>
                                <dd><?php echo number_format($price,2) ?></dd>
                            </dl>
                        </div>
                        <div class="col-sm-6">
                            <dl>
                                <dt>Largeur:</dt>
                                <dd><?php echo $width ?></dd>
                                <dt>Longueur:</dt>
                                <dd><?php echo $length ?></dd>
                                <dt>Type:</dt>
                                <dd><?php echo $type == 1 ? "<span class='badge badge-primary'>Livrer au destinataire</span>":"<span class='badge badge-info'>reprise</span>" ?></dd>
                            </dl>
                        </div>
                    </div>
                    <dl>
                        <dt>Branche qui a accepté le colis:</dt>
                        <dd><?php echo ucwords($branch[$from_branch_id]) ?></dd>
                        <?php if($type == 2): ?>
                            <dt>Branche la plus proche du destinataire pour le ramassage:</dt>
                            <dd><?php echo ucwords($branch[$to_branch_id]) ?></dd>
                        <?php endif; ?>
                        <dt>Status:</dt>
                        <dd>
                            <?php
                            switch ($status) {
                                case '1':
                                    echo "<span class='badge badge-pill badge-info'> Collecté</span>";
                                    break;
                                case '2':
                                    echo "<span class='badge badge-pill badge-info'> Expédié</span>";
                                    break;
                                case '3':
                                    echo "<span class='badge badge-pill badge-primary'> En Transit</span>";
                                    break;
                                case '4':
                                    echo "<span class='badge badge-pill badge-primary'> Arrivé à destination</span>";
                                    break;
                                case '5':
                                    echo "<span class='badge badge-pill badge-primary'> En cours de livraison</span>";
                                    break;
                                case '6':
                                    echo "<span class='badge badge-pill badge-primary'> Prêt à ramasser</span>";
                                    break;
                                case '7':
                                    echo "<span class='badge badge-pill badge-success'>Livré</span>";
                                    break;
                                case '8':
                                    echo "<span class='badge badge-pill badge-success'> Ramassé</span>";
                                    break;
                                case '9':
                                    echo "<span class='badge badge-pill badge-danger'> Tentative de livraison infructueuse</span>";
                                    break;

                                default:
                                    echo "<span class='badge badge-pill badge-info'> Article accepté par courrier</span>";

                                    break;
                            }

                            ?>
                            <span class="btn badge badge-primary bg-gradient-primary" id='update_status'><i class="fa fa-edit"></i> Mettre à jour le statut</span>
                        </dd>

                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
</div>

<script>
    $('#update_status').click(function(){
        uni_modal("Mettre à jour le statut de: <?php echo $reference_number ?>","manage_parcel_status.php?id=<?php echo $id ?>&cs=<?php echo $status ?>","")
    })
</script>