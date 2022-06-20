<?php if (!isset($conn)) {
    include 'db_connect.php';
} ?>
<style>
    textarea {
        resize: none;
    }
</style>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="" id="manage-parcel">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div id="msg" class=""></div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="" class="control-label">N&deg; DEC/BR</label>
                    <input type="text" name="br_dec" id="" class="form-control form-control-sm"
                           value="<?php echo isset($br_dec) ? $br_dec : '' ?>" required>
                    </div>
                </div>
                <hr style="display: block; height: 1px;
    border: 0; border-top: 2px solid #0069D9;
    margin: 1em 0; padding: 0;">
                <div class="row">

                    <div class="col-md-6">
                        <b style="color: #0069D9">Informations sur l'expéditeur</b>
                        <hr style="display: block; height: 1px;
    border: 0; border-top: 1px solid #0069D9;
    margin: 1em 0; padding: 0;">
                        <div class="form-group">
                            <label for="" class="control-label">Nom</label>
                            <input type="text" name="sender_name" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($sender_name) ? $sender_name : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">N.CIN</label>
                            <input type="text" name="sender_id" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($sender_id) ? $sender_id : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Address</label>
                            <input type="text" name="sender_address" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($sender_address) ? $sender_address : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Ville</label>
                            <input type="text" name="sender_city" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($sender_city) ? $sender_city : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Contact #</label>
                            <input type="text" name="sender_contact" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" required>
                        </div>
                    </div>

                    <!--==========================Destinataire===========================-->


                    <div class="col-md-6">
                        <b style="color: #0069D9">Informations sur le destinataire</b>
                        <hr style="display: block; height: 1px;
    border: 0; border-top: 1px solid #0069D9;
    margin: 1em 0; padding: 0;">
                        <div class="form-group">
                            <label for="" class="control-label">Nom</label>
                            <input type="text" name="recipient_name" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">N.CIN</label>
                            <input type="text" name="recipient_cin" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($recipient_cin) ? $recipient_cin : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Address</label>
                            <input type="text" name="recipient_address" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Ville</label>
                            <input type="text" name="recipient_city" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($recipient_city) ? $recipient_city : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Contact #</label>
                            <input type="text" name="recipient_contact" id="" class="form-control form-control-sm"
                                   value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" required>
                        </div>
                    </div>
                </div>
                <hr style="display: block; height: 1px;
    border: 0; border-top: 2px solid #0069D9;
    margin: 1em 0; padding: 0;">
                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dtype">Type de Livraison &nbsp;: &nbsp;&nbsp;</label>
                            <input type="checkbox" name="type" id="dtype"
                                <?php echo isset($type) && $type == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Domicile" data-off="Agence"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="info" data-width="6.5rem" data-height="2rem" value="1">
                            <!--<small>Domicile = ............</small>
                            <small>, Agence = ............</small>-->
                        </div>

                        <div class="form-group">
                            <label for="">Type d'Expédition : &nbsp;&nbsp;</label>
                            <input type="checkbox" name="type_expedition" id=""
                                <?php echo isset($type_expedition) && $type_expedition == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Express" data-off="Simple"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="info" data-width="6.5rem" data-height="2rem" value="1">
                            <!--<small>Express = ............</small>
                            <small>, Simple = ............</small>-->
                        </div>

                        <div class="form-group">
                            <label for="">Type de paiment    : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="checkbox" name="payment_type" id=""
                                <?php echo isset($payment_type) && $payment_type == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Du" data-off="Payé"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="info" data-width="6.5rem" data-height="2rem" value="1">
                        </div>

                        <div class="form-group">
                            <label for="">Type de client    : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="checkbox" name="type_client" id=""
                                <?php echo isset($type_client) && $type_client == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Société" data-off="Particulier"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="info" data-width="6.5rem" data-height="2rem" value="1">
                        </div>
                    </div>

<!--              ===========================================================================================================                  -->

                    <div class="col-md-6" id="">
                        <!--                        <?php /*if ($_SESSION['login_branch_id'] <= 0): */ ?>
                            <div class="form-group" id="fbi-field">
                                <label for="" class="control-label">Branche qui a traité</label>
                                <select name="from_branch_id" id="from_branch_id" class="form-control select2"
                                        required="">
                                    <option value=""></option>
                                    <?php
                        /*                                    $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                                            while ($row = $branches->fetch_assoc()):
                                                                */ ?>
                                        <option value="<?php /*echo $row['id'] */ ?>" <?php /*echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected" : '' */ ?>>
                                            <?php /*echo(ucwords($row['address'])) */ ?></option>
                                    <?php /*endwhile; */ ?>
                                </select>
                            </div>
                        --><?php /*else: */ ?>
                        <input type="hidden" name="from_branch_id"
                               value="<?php echo $_SESSION['login_branch_id'] ?>">
                        <!--                        --><?php //endif; ?>

                        <div class="form-group" id="tbi-field">
                            <label for="" class="control-label">Branche de destination</label>
                            <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                                <option value=""></option>
                                <?php
                                $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                while ($row = $branches->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected" : '' ?>>
                                        <?php echo(ucwords($row['address'])) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <b>Retour de fond</b>
                        <div class="form-group">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_retour_de_fond1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Espèce</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_retour_de_fond2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Chèque</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_retour_de_fond3" value="3">
                                <label class="form-check-label" for="inlineRadio3">Traite</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="display: block; height: 1px;
    border: 0; border-top: 2px solid #0069D9;
    margin: 1em 0; padding: 0;">
                <b>Informations sur Colis</b>
                <table class="table table-bordered" id="parcel-items">

                    <tbody>

                    <tr>


                        <td><label>Numero</label><input type="number" name='number[]' value="<?php echo isset($number) ? $number : '' ?>" style='width:100%'>
                        </td>


                        <td><label>Poids</label><input type="number" name='weight[]' value="<?php echo isset($weight) ? $weight : '' ?>" style='width:100%'>
                        </td>

                    </tr>

                    <tr>

                        <td><label>Longueur</label><input type="number" name='length[]' value="<?php echo isset($length) ? $length : '' ?>" style='width:100%'></td>


                        <td><label>Largeur</label><input type="number" name='width[]' value="<?php echo isset($width) ? $width : '' ?>" style='width:100%'></td>
                    </tr>

                    <tr>

                        <td><label>Hauteur</label><input type="number" name='height[]' value="<?php echo isset($height) ? $height : '' ?>" style='width:100%'></td>

                        <td><label>Prix</label><input type="number" name='price[]' step="any"
                                   value="<?php echo isset($price) ? $price : '' ?>" style='width:100%'></td>
                    </tr>


                    <tr>

                        <td> <label>R. BL</label><input type="number" name='price_retour_bl[]' value="<?php echo isset($price_retour_bl) ? $price_retour_bl : '' ?>" style='width:100%'> </td>

                        <td> <label>R. Fonds</label><input type="number" name='price_retour_de_fond[]' value="<?php echo isset($price_retour_de_fond) ? $price_retour_de_fond : '' ?>" style='width:100%'> </td>
                    </tr>

                    <tr>
                        <td colspan="4"><label>Note : &nbsp; </label><input type="text" name="note[]" value="<?php echo isset($note) ? $note : '' ?>"
                                              style='width:100%'></td>
                    </tr>

                    </tbody>
                </table>
                <?php /*if (!isset($id)): */?><!--
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="new_parcel"><i
                                        class="fa fa-item"></i> Ajouter un article
                            </button>
                        </div>
                    </div>
                --><?php /*endif; */?>
            </form>
        </div>
        <div class="card-footer border-top border-info">
            <div class="d-flex w-100 justify-content-center align-items-center">
                <button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-parcel">Sauvegarder</button>
                <a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list&p=1">Annuler</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('#manage-parcel').submit(function (e) {
        e.preventDefault()
        start_load()
        if ($('#parcel-items tbody tr').length <= 0) {
            alert_toast("Please add atleast 1 parcel information.", "error")
            end_load()
            return false;
        }
        $.ajax({
            url: 'ajax.php?action=save_parcel',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {

                if (resp == 1) {
                    alert_toast('info sauvegardé par succés', "success");
                    setTimeout(function () {
                        location.href = 'index.php?page=parcel_list&s=0&p=1';
                    }, 2000)

                }
            }
        })
    })
</script>