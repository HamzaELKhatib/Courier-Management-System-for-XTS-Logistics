<?php if (!isset($conn)) {
    include 'db_connect.php';
} ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="" id="manage-system_settings">

                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">System Name</label>
                            <input type="text" class="form-control form-control-sm" name="name"
                                   value="<?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Contact #</label>
                            <input type="text" class="form-control form-control-sm" name="contact"
                                   value="<?php echo isset($_SESSION['system']['contact']) ? $_SESSION['system']['contact'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email"
                                   value="<?php echo isset($_SESSION['system']['email']) ? $_SESSION['system']['email'] : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Address</label>
                            <textarea name="address" id="" cols="30" rows="3"
                                      class="form-control"><?php echo isset($_SESSION['system']['address']) ? $_SESSION['system']['address'] : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer border-top border-info">
            <div class="d-flex w-100 justify-content-center align-items-center">
                <button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-system_settings">Save</button>
                <button class="btn btn-flat bg-gradient-secondary mx-2" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#manage-system_settings').submit(function (e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_system_settings',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {
                if (resp == 1) {
                    alert_toast('Data successfully saved', "success");
                    setTimeout(function () {
                        location.reload()
                    }, 2000)
                }
            }
        })
    })

</script>