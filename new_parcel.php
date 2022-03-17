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
                <div class="row">
                    <div class="col-md-6">
                        <b>Informations sur l'expéditeur</b>
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
                    <div class="col-md-6">
                        <b>Informations sur le destinataire</b>
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
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dtype">Type de Livraison &nbsp;: &nbsp;&nbsp;</label>
                            <input type="checkbox" name="type" id="dtype"
                                <?php echo isset($type) && $type == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Domicile" data-off="Agence"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="success" data-width="5rem" value="1">
                            <!--<small>Domicile = ............</small>
                            <small>, Agence = ............</small>-->
                        </div>
                        <div class="form-group">
                            <label for="">Type d'Expédition : &nbsp;&nbsp;</label>
                            <input type="checkbox" name="type_expedition" id=""
                                <?php echo isset($type_expedition) && $type_expedition == 1 ? 'checked' : '' ?>
                                   data-bootstrap-switch data-toggle="toggle" data-on="Express" data-off="Simple"
                                   class="switch-toggle status_chk"
                                   data-size="xs" data-offstyle="success" data-width="5rem" value="1">
                            <!--<small>Express = ............</small>
                            <small>, Simple = ............</small>-->
                        </div>
                    </div>
                    <div class="col-md-6" id="" <?php echo isset($type) && $type == 1 ? 'style="display: none"' : '' ?>>
                        <?php if ($_SESSION['login_branch_id'] <= 0): ?>
                            <div class="form-group" id="fbi-field">
                                <label for="" class="control-label">Branche qui a traité</label>
                                <select name="from_branch_id" id="from_branch_id" class="form-control select2"
                                        required="">
                                    <option value=""></option>
                                    <?php
                                    $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                    while ($row = $branches->fetch_assoc()):
                                        ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected" : '' ?>>
                                            <?php echo (ucwords($row['address'])) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="from_branch_id"
                                   value="<?php echo $_SESSION['login_branch_id'] ?>">
                        <?php endif; ?>
                        <div class="form-group" id="tbi-field">
                            <label for="" class="control-label">Branche de ramassage</label>
                            <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                                <option value=""></option>
                                <?php
                                $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                                while ($row = $branches->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected" : '' ?>>
                                        <?php echo  (ucwords($row['address'])) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <b>Informations sur Colis</b>
                <table class="table table-bordered" id="parcel-items">
                    <thead>
                    <tr>
                        <th>Poids</th>
                        <th>Numero</th>

                        <th>Prix</th>
                        <?php if (!isset($id)): ?>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="number" name='weight[]' value="<?php echo isset($weight) ? $weight : '' ?>"
                                   required></td>
                        <td><input type="number" name='number[]' value="<?php echo isset($number) ? $number : '' ?>"
                                   required></td>

                        <td><input type="number" class="text-right" name='price[]' step="any"
                                   value="<?php echo isset($price) ? $price : '' ?>" required></td>
                        <?php if (!isset($id)): ?>
                            <td>
                                <button class="btn btn-sm btn-danger" type="button"
                                        onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i>
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                    </tbody>
                    <?php if (!isset($id)): ?>
                        <tfoot>
                        <th colspan="2" class="text-right">Total</th>
                        <th class="text-right" id="tAmount">0.00</th>
                        <th></th>
                        </tfoot>
                    <?php endif; ?>
                </table>
                <?php if (!isset($id)): ?>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="new_parcel"><i
                                        class="fa fa-item"></i> Ajouter un article
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="card-footer border-top border-info">
            <div class="d-flex w-100 justify-content-center align-items-center">
                <button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-parcel">Sauvegarder</button>
                <a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list">Annuler</a>
            </div>
        </div>
    </div>
</div>
<div id="ptr_clone" class="d-none">
    <table>
        <tr>
            <td><input type="number" name='weight[]' required></td>
            <td><input type="number" name='number[]' required></td>

            <td><input type="number" class="text-right" name='price[]' step="any" required></td>
            <td>
                <button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()">
                    <i class="fa fa-times"></i></button>
            </td>
        </tr>
    </table>
</div>
<script>
    $('#dtype').change(function () {
        if ($(this).prop('checked') == true) {
            $('#tbi-field').hide()
        } else {
            $('#tbi-field').show()
        }
    })
    $('[name="price[]"]').keyup(function () {
        calc()
    })
    $('#new_parcel').click(function () {
        var tr = $('#ptr_clone tr').clone()
        $('#parcel-items tbody').append(tr)
        $('[name="price[]"]').keyup(function () {
            calc()
        })
        $('.number').on('input keyup keypress', function () {
            var val = $(this).val()
            val = val.replace(/[^0-9]/, '');
            val = val.replace(/,/g, '');
            val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
            $(this).val(val)
        })

    })
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
                        location.href = 'index.php?page=parcel_list';
                    }, 2000)

                }
            }
        })
    })


    function calc() {

        var total = 0;
        $('#parcel-items [name="price[]"]').each(function () {
            var p = $(this).val();
            p = p.replace(/,/g, '')
            p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
        })
        if ($('#tAmount').length > 0)
            $('#tAmount').text(parseFloat(total).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            }))
    }
</script>