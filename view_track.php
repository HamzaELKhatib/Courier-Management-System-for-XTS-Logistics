<?php
include 'database/db_connect.php';
$ref = $_GET['reference'];

$parcel = $conn->query("SELECT * FROM parcels where reference = '$ref'");


if ($parcel->num_rows <= 0) :
    return 2;
else:
$parcel = $parcel->fetch_array();
$history = $conn->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");
?>
<h1 style="color: white; font-family: Jost, sans-serif; font-size: 48px;text-align: center;margin-top: 15%">Le trajet de votre colis</h1>
<ol class="progtrckr">
    <?php
    while ($row = $history->fetch_assoc()) :
        $username = $conn->query("SELECT concat(firstname,' ',lastname) as name FROM users where id = {$row['user_id']}");
        $username = mysqli_fetch_array($username);
        $branchid = $conn->query("SELECT branch_id FROM users where id = {$row['user_id']}");
        $branchid = mysqli_fetch_row($branchid);
        $city = $conn->query("SELECT city FROM branches where id = $branchid[0]");
        $city = mysqli_fetch_array($city);
        $row['date_created'] = date("d M, h:i A", strtotime($row['date_created']));
        $row['city'] = ($city[0]);
        if ($row['status'] == 0):
        ?>
        <li class="progtrckr-done">
            Arrivé au gare de: <?php echo $row['city'] ?>, le: <?php echo $row['date_created'] ?>
        </li>
    <?php
        elseif ($row['status'] == 2 ||$row['status'] == 3):
    ?>
            <li class="progtrckr-done">
                Collecté par le client à: <?php echo $row['city'] ?>, le: <?php echo $row['date_created'] ?>
            </li>
    <?php
        endif;
    endwhile;
    endif; ?>
</ol>

<style>
    *{
        background-color: #37517E;
        font-family: Jost, sans-serif;
    }
    ol.progtrckr {

        text-align: center;
        list-style-position: inside;
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
        color: white;
        border-bottom: 4px solid #47B2E4;
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
        background-color: #47B2E4;
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

