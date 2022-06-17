<?php
include 'db_connect.php';
if(isset($_POST['empty_parcels'])){

    $conn->query("TRUNCATE TABLE parcels");

    $conn->query("TRUNCATE TABLE feuille_chargement");

    $conn->query("TRUNCATE TABLE parcel_tracks");

    header( "Location: ./index.php?page=parcel_list&s=0&p=1" );
}