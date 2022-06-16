<?php
include 'db_connect.php';
$num = $_GET['br'];

$parcel = $conn->query("SELECT * FROM parcels where br_dec = '$num'");


if ($parcel->num_rows <= 0) :
    return 2;
else:
    $parcel = $parcel->fetch_array();
echo $parcel['id'];
    $history = $conn->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");

    $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
    while ($row = $history->fetch_assoc()) :

        $username = $conn->query("SELECT concat(firstname,' ',lastname) as name FROM users where id = {$row['user_id']}");
        $username = mysqli_fetch_array($username);

        $branchid = $conn->query("SELECT branch_id FROM users where id = {$row['user_id']}");
        $branchid = mysqli_fetch_row($branchid);

        $city = $conn->query("SELECT city FROM branches where id = $branchid[0]");
        $city = mysqli_fetch_array($city);

        $row['date_created'] = date("M d, Y h:i A", strtotime($row['date_created']));
        $row['status'] = $status_arr[$row['status']];
        $row['username'] = ($username[0]);
        $row['city'] = ($city[0]);
        echo $row['date_created'];
        echo $row['status'];
        echo $row['username'];
        echo $row['city'];
    endwhile;
    endif;


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
