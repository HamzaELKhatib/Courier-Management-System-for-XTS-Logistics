<?php
include 'db_connect.php';
if(isset($_POST['export']))
{
    session_start();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=data.csv');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $output = fopen("php://output", "w");
    fputcsv($output, array('ID', 'BR/ DEC', 'Reference', 'Numero_expedition', 'Nom_expediteur',
        'CIN_expediteur', 'Ville_expediteur', 'Adresse_expediteur', 'Contact_expediteur',
        'Nom_destinataire', 'CIN_destinataire', 'Ville_destinataire', 'Adresse_destinataire',
        'Contact_destinataire', 'type', 'type_expedition', 'type_client', 'Gare_expedition',
        'Gare_destination', 'Poids', 'Longueur', 'Largeur', 'Hauteur', 'Nombre', 'Note', 'Type_RF',
        'Prix_RF', 'Prix_RB', 'Prix', 'Prix_due', 'Type_payment', 'Status', 'Date_creation'));
    $query = "SELECT * from parcels ORDER BY id";
    $result = $conn->query($query);
    while($row = mysqli_fetch_assoc($result))
    {
        $row['date_created'] = date("M d, Y h:i A", strtotime($row['date_created']));
        fputcsv($output, $row);
    }
    fclose($output);
}
?>