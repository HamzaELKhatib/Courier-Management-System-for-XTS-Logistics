<?php
include 'db_connect.php';
$num = $_GET['br'];

$parcel = $conn->query("SELECT * FROM parcels where br_dec = '$num'");


if ($parcel->num_rows <= 0) :
    return 2;
else:
$parcel = $parcel->fetch_array();
$history = $conn->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");

$status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile"); ?>
<ol class="progtrckr" data-progtrckr-steps="5">
    <?php
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
        ?>
        <li class="progtrckr">
            <div class="widget-user-header bg-dark">
                <h3 class="widget-user-username"><?php echo $row['username'] ?></h3>
                <h5 class="widget-user-desc"><?php echo $row['city'] ?></h5>
            </div>
            <div class="card-footer">
                <div class="container-fluid">
                    <dl>
                        <dt>Date</dt>
                        <dd><?php echo $row['date_created'] ?></dd>
                    </dl>
                    <dl>
                        <dt>Status</dt>
                        <dd><?php echo $row['status'] ?></dd>
                    </dl>
                </div>
            </div>
        </li>
    <?php
    endwhile;
    endif; ?>
</ol>

<style>
    ol.progtrckr {
        margin: 0;
        padding: 0;
        list-style-type none;
    }

    ol.progtrckr li {
        display: inline-block;
        text-align: center;
        line-height: 3.5em;
    }

    ol.progtrckr[data-progtrckr-steps="2"] li {
        width: 49%;
    }

    ol.progtrckr[data-progtrckr-steps="3"] li {
        width: 33%;
    }

    ol.progtrckr[data-progtrckr-steps="4"] li {
        width: 24%;
    }

    ol.progtrckr[data-progtrckr-steps="5"] li {
        width: 19%;
    }

    ol.progtrckr[data-progtrckr-steps="6"] li {
        width: 16%;
    }

    ol.progtrckr[data-progtrckr-steps="7"] li {
        width: 14%;
    }

    ol.progtrckr[data-progtrckr-steps="8"] li {
        width: 12%;
    }

    ol.progtrckr[data-progtrckr-steps="9"] li {
        width: 11%;
    }

    ol.progtrckr li.progtrckr-done {
        color: black;
        border-bottom: 4px solid yellowgreen;
    }

    ol.progtrckr li.progtrckr-todo {
        color: silver;
        border-bottom: 4px solid silver;
    }

    ol.progtrckr li:after {
        content: "\00a0\00a0";
    }

    ol.progtrckr li:before {
        position: relative;
        bottom: -2.5em;
        float: left;
        left: 50%;
        line-height: 1em;
    }

    ol.progtrckr li.progtrckr-done:before {
        content: "\2713";
        color: white;
        background-color: yellowgreen;
        height: 2.2em;
        width: 2.2em;
        line-height: 2.2em;
        border: none;
        border-radius: 2.2em;
    }

    ol.progtrckr li.progtrckr-todo:before {
        content: "\039F";
        color: silver;
        background-color: white;
        font-size: 2.2em;
        bottom: -1.2em;
    }


</style>

