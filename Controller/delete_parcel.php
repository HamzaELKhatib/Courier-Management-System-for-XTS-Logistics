<?php

include 'db_connect.php';
$qry = $conn->query("DELETE FROM parcels where id = " . $_GET['id']);

include 'parcel_list.php';
