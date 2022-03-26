<?php include 'db_connect.php' ;
$num = $_GET['br'];
?>
<div>

</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="timeline" id="parcel_history">

            </div>
        </div>
    </div>
</div>
<div id="clone_timeline-item" class="d-none">
    <div class="iitem">
        <i class="fas fa-box bg-blue"></i>
        <div class="timeline-item">

            <span class="time"><i class="fas fa-clock"></i> <span class="dtime"></span></span>


            <div class="timeline-body" style="font-weight: bold; color: #0069D9"></div>
            <span class="text">&nbsp;&nbsp;<i class="fas fa-male"></i> <span class="uname"></span></span>

            <span class="text float-right"><i class="fas fa-city"></i> <span class="city"></span></span>

        </div>
    </div>
</div>
<script>
   window.onload = function track_now() {
        start_load()

       var tracking_num = (("<?php echo ($num); ?>"))
        if (tracking_num === '') {
            $('#parcel_history').html('')
            end_load()
        } else {
            $.ajax({
                url: 'ajax.php?action=get_parcel_history',
                method: 'POST',
                data: {ref_no: tracking_num},
                error: err => {
                    console.log(err)
                    alert_toast("Une erreur s'est produite", 'error')
                    end_load()
                },
                success: function (resp) {
                    if (typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object') {
                        resp = JSON.parse(resp)
                        if (Object.keys(resp).length > 0) {
                            $('#parcel_history').html('')
                            Object.keys(resp).map(function (k) {
                                var tl = $('#clone_timeline-item .iitem').clone()
                                tl.find('.dtime').text(resp[k].date_created)
                                tl.find('.timeline-body').text(resp[k].status)
                                tl.find('.uname').text(resp[k].username)
                                tl.find('.city').text(resp[k].city)
                                $('#parcel_history').append(tl)
                            })
                        }
                    } else if (resp == 2) {
                        alert_toast('Numéro de suivi inconnu.', "error")
                    }
                }
                , complete: function () {
                    end_load()
                }
            })
        }
    }


</script>