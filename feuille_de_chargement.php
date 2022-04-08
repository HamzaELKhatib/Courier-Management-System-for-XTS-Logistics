<?php include 'db_connect.php' ?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <h1 class="align-content-center">Feuille de chargement</h1>
                    </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <h2 class="align-content-center"> </h2>
            </div>
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">

                <div class="container">

                    <form method="post" action="">
                        <table align="left" cellspacing="0" border="1" class="table table-bordered table-striped"
                               id="table1" style="table-layout: fixed;">

                            <thead>
                            <tr>

                                <th class="text-center bg-primary" style="width: 60px;font-size: small">Réference</th>
                                <th class="text-center bg-info" style="width: 150px;font-size: medium">Expéditeur</th>
                                <th class="text-center bg-info" style="width: 70px;font-size: medium">CIN E</th>
                                <th class="text-center bg-info" style="width: 90px;font-size: medium">Ville</th>
                                <th class="text-center bg-success" style="width: 150px;font-size: medium">Destinataire
                                </th>
                                <th class="text-center bg-success" style="width: 70px;font-size: medium">CIN D</th>
                                <th class="text-center bg-gradient-success" style="width: 90px;font-size: medium">
                                    Ville
                                </th>
                                <th class="text-center bg-primary" style="width:40px;font-size: small">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;

                            $where = "";

                            if (isset($_GET['s'])) {
                                $where = " where status = {$_GET['s']} ";
                            }
                            if ($_SESSION['login_type'] != 1) {

                                if (empty($where)) {
                                    $where = " where ";
                                } else {
                                    $where .= " and ";
                                }
                                $where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
                            }


                            $qry = $conn->query("SELECT * from parcels where status=1 order by unix_timestamp(date_created) desc");
                            while ($row = $qry->fetch_assoc()):
                                ?>
                                <tr>

                                    <td><b><?php echo($row['reference']) ?></td>
                                    <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                                    <td><b><?php echo ucwords($row['sender_id']) ?></b></td>
                                    <td><b><?php echo ucwords($row['sender_city']) ?></b></td>
                                    <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                                    <td><b><?php echo ucwords($row['recipient_cin']) ?></b></td>
                                    <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                                    <td class="text-center"><input type="checkbox" value="<?php echo $row['id'] ?>"
                                                                   name="check[]"></td>
                                </tr>
                            <?php endwhile; ?>

                            </tbody>
                        </table>
                        <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                            <input class="btn btn-success btn-flat" id="submit" type="submit" value="Choisir"
                                   name="submit">
                        </div>

                    </form>

                    <br>
                    <?php
                    $checked_array = array();
                    if (isset($_POST['submit'])) {
                        if (!empty($_POST['check'])) {
                            foreach ($_POST['check'] as $value) {
                            }
                            $checked_array = $_POST['check'];
                        } else {
                            echo 'Sélectionner au moin un colis';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <h2 class="align-content-center">Colis choisis</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-warning float-right" id="print">
                        <i class="fa fa-print"></i> Imprimer
                    </button>
                    <br>
                </div>
            </div>
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">


                <h2 class="align-content-center"></h2>

                <table align="left" cellspacing="0" border="1" class="table table-bordered table-striped"
                       id="table2">

                    <thead>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="100"></colgroup>
                    <colgroup width="300"></colgroup>
                    <colgroup width="300"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <colgroup width="80"></colgroup>
                    <tr>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" size=2 color="#FFFFFF">N&deg; EXP.</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" size=2 color="#FFFFFF">N&deg; DEC/BR</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060" sdnum="1033;0;0.00"><b><font face="Arial" size=2 color="#FFFFFF">DESTINATION</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" size=2 color="#FFFFFF">EXPEDITEUR</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" size=2 color="#FFFFFF">DESTINAIRE</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">COLIS</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">POIDS</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">PORT PAY&Eacute;</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">PORT D&Ucirc;</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">R. Fonds</font></b></th>
                        <th style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" size=2 color="#FFFFFF">R. BL</font></b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($j = 0; $j < count($checked_array); $j++): ?>
                        <?php
                        $id = intval($checked_array[$j]);
                        $i = 1;

                        $where = "";

                        if (isset($_GET['s'])) {
                            $where = " where status = {$_GET['s']} ";
                        }
                        if ($_SESSION['login_type'] != 1) {

                            if (empty($where)) {
                                $where = " where ";
                            } else {
                                $where .= " and ";
                            }
                            $where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
                        }


                        $qry = $conn->query("SELECT * from parcels where status=1 and id=$id order by unix_timestamp(date_created) desc");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>

                                <td><b>inconnu</b></td>
                                <td><b>inconnu</b></td>
                                <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                                <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                                <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                                <td><b><?php echo ucwords($row['number']) ?></b></td>
                                <td><b><?php echo ucwords($row['weight']) ?></b></td>
                                <td><b><?php echo ucwords($row['price']) ?></b></td>
                                <td><b><?php echo ucwords($row['paid_price']) ?></b></td>
                                <td><b>inconnu</b></td>
                                <td><b>inconnu</b></td>
                            </tr>
                        <?php endwhile;
                        ?>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<noscript>


    <style type="text/css">
        body, div, table, thead, tbody, tfoot, tr, th, td, p {
            font-family: "Calibri";
            font-size: x-small
        }

        a.comment-indicator:hover + comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
            padding: 0.5em;
        }

        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.5em;
            height: 0.5em;
        }

        comment {
            display: none;
        }
    </style>

    <table cellspacing="0" border="0">
        <colgroup width="110"></colgroup>
        <colgroup width="121"></colgroup>
        <colgroup width="149"></colgroup>
        <colgroup width="277"></colgroup>
        <colgroup width="255"></colgroup>
        <colgroup width="66"></colgroup>
        <colgroup width="63"></colgroup>
        <colgroup span="4" width="106"></colgroup>
        <colgroup width="79"></colgroup>
        <tr>
            <td colspan=3 rowspan=2 height="65" align="left" valign=bottom><b><u><font face="Arial" size=5
                                                                                       color="#00B050"><br><img
                                    src="assets/dist/img/result_htm_56a5069f99260b80.png" width=289 height=53 hspace=47
                                    vspace=6>
                        </font></u></b></td>
            <td colspan=3 align="center" valign=bottom><b><u><font face="Arial" size=2 color="#002060">FEUILLE DE
                            CHARGEMENT N&deg; :</font></u></b></td>
            <td colspan=3 align="left" valign=bottom sdval="2021120388" sdnum="1033;0;0"><b><font face="Arial" size=2
                                                                                                  color="#203864">2021120388</font></b>
            </td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
        <tr>
            <td align="left" valign=bottom><b><font face="Arial" size=1>AGENCE DEPART : TETOUAN</font></b></td>
            <td align="left" valign=bottom><font face="Arial">CHAUFFEUR : </font></td>
            <td colspan=2 align="left" valign=bottom><font face="Arial">TOTAL COLIS :</font></td>
            <td align="left" valign=bottom sdval="1" sdnum="1033;"><font face="Arial">1</font></td>
            <td align="left" valign=bottom><br></td>
            <td align="left" valign=bottom><br></td>
            <td align="left" valign=bottom><br></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
        <tr>
            <td height="33" align="left" valign=bottom><b><font face="Arial" color="#000000">AGENCE TETOUAN TEL.: 06 39
                        49 39 00</font></b></td>
            <td align="left" valign=bottom><b><font face="Arial" color="#000000"><br></font></b></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><b><font face="Arial" size=1>AGENCE ARRIVEE : NADOR</font></b></td>
            <td align="left" valign=bottom><font face="Arial">HEURE VEHICULE : 20:00 H</font></td>
            <td colspan=2 align="left" valign=bottom><font face="Arial">TOTAL POIDS :</font></td>
            <td align="left" valign=bottom sdval="10" sdnum="1033;"><font face="Arial">10 Kg</font></td>
            <td align="left" valign=bottom><font face="Arial"></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="right" valign=bottom sdnum="1033;0;@"><font face="Arial">DATE :</font></td>
            <td align="right" valign=bottom sdval="44531" sdnum="1033;1033;M/D/YYYY"><font face="Arial">12/1/2021</font>
            </td>
        </tr>
        <tr>
            <td height="19" align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
    </table>
</noscript>
<script>
    var checked_array = <?php echo json_encode($checked_array) ?>;
    console.log(checked_array)
</script>
<script>
    $('#print').click(function () {
        start_load()
        var ns = $('noscript').clone()

        var content = $('#table2').clone()
        ns.append(content)

        var details = $('.details').clone()
        ns.append(details)




        var nw = window.open('', '', 'height=700,width=900')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(function () {
            nw.close()
            end_load()
        }, 750)

    })

    function load_report() {
        start_load()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        let sum = 0


        //-------------------------------------------
        //Sum of colomn numbers
        // sum = sum + parseFloat(resp[k].price.replace(/\,/g, ''), 10)
        //console.log(sum)
        //-------------------------------------------
        // $('#tAmount').append(sum + " dh")

    }

</script>