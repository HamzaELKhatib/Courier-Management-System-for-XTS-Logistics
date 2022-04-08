<?php include 'db_connect.php'?>
<h1 class="align-content-center"></h1>
<div class="container">

    <div class="tab">
        <table class="table table-bordered table-striped" id="table1">

            <thead>
            <tr>

                <th class="text-center bg-primary" style="width: 60px;font-size: small">Réference</th>
                <th class="text-center bg-info" style="width: 150px;font-size: medium">Expéditeur</th>
                <th class="text-center bg-info" style="width: 70px;font-size: medium">CIN E</th>
                <th class="text-center bg-info" style="width: 90px;font-size: medium">Ville</th>
                <th class="text-center bg-success" style="width: 150px;font-size: medium">Destinataire</th>
                <th class="text-center bg-success" style="width: 70px;font-size: medium">CIN D</th>
                <th class="text-center bg-gradient-success" style="width: 90px;font-size: medium">Ville</th>
                <th class="text-center bg-primary" style="width: 80px;font-size: small">Select</th>
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

                    <td><b><?php echo($row['reference']) ?></b></td>
                    <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                    <td><b><?php echo ucwords($row['sender_id']) ?></b></td>
                    <td><b><?php echo ucwords($row['sender_city']) ?></b></td>
                    <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                    <td><b><?php echo ucwords($row['recipient_cin']) ?></b></td>
                    <td><b><?php echo ucwords($row['recipient_city']) ?></b></td>
                    <td><input type="checkbox" name="check-tab1"></td>
                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-success float-right" style="display: none" id="print">
        <i class="fa fa-print"></i> Imprimer
    </button>
    <br>


    <div class="tab tab-btn">
        <button class="btn btn-primary btn-flat" onclick="tab1_To_tab2();"><i class="fas fa-arrow-down"></i></button>
        <button class="btn btn-primary btn-flat" onclick="tab2_To_tab1();"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="btn btn-success float-right" id="print">
            <i class="fa fa-print"></i> Imprimer
        </button>
    </div>
    <br>

    <div class="tab">
        <table class="table table-bordered table-striped" id="table2">

            <thead>

            <tr>

                <th class="text-center bg-primary" style="width: 60px;font-size: small">Réference</th>

                <th class="text-center bg-info" style="width: 150px;font-size: medium">Expéditeur</th>
                <th class="text-center bg-info" style="width: 70px;font-size: medium">CIN E</th>
                <th class="text-center bg-info" style="width: 90px;font-size: medium">Ville</th>

                <th class="text-center bg-success" style="width: 150px;font-size: medium">Destinataire</th>
                <th class="text-center bg-success" style="width: 70px;font-size: medium">CIN D</th>
                <th class="text-center bg-gradient-success" style="width: 90px;font-size: medium">Ville</th>
                <th class="text-center bg-primary" style="width: 80px;font-size: small">Select</th>



            </tr>
            </thead>
            <tbody>




            </tbody>
        </table>
    </div>
</div>
<script>

    function tab1_To_tab2()
    {
        var table1 = document.getElementById("table1"),
            table2 = document.getElementById("table2"),
            checkboxes = document.getElementsByName("check-tab1");
        console.log("Val1 = " + checkboxes.length);
        for(var i = 0; i < checkboxes.length; i++)
            if(checkboxes[i].checked)
            {
                // create new row and cells
                var newRow = table2.insertRow(table2.length),
                    cell1 = newRow.insertCell(0),
                    cell2 = newRow.insertCell(1),
                    cell3 = newRow.insertCell(2),
                    cell4 = newRow.insertCell(3);
                cell5 = newRow.insertCell(4);
                cell6 = newRow.insertCell(5);
                cell7 = newRow.insertCell(6);
                cell8 = newRow.insertCell(7);

                // add values to the cells
                cell1.innerHTML = table1.rows[i+1].cells[0].innerHTML;
                cell2.innerHTML = table1.rows[i+1].cells[1].innerHTML;
                cell3.innerHTML = table1.rows[i+1].cells[2].innerHTML;
                cell4.innerHTML = table1.rows[i+1].cells[3].innerHTML;
                cell5.innerHTML = table1.rows[i+1].cells[4].innerHTML;
                cell6.innerHTML = table1.rows[i+1].cells[5].innerHTML;
                cell7.innerHTML = table1.rows[i+1].cells[6].innerHTML;
                cell8.innerHTML = "<input type='checkbox' name='check-tab2'>";

                // remove the transfered rows from the first table [table1]
                var index = table1.rows[i+1].rowIndex;
                table1.deleteRow(index);
                // we have deleted some rows so the checkboxes.length have changed
                // so we have to decrement the value of i
                i--;
                console.log(checkboxes.length);
            }
    }


    function tab2_To_tab1()
    {
        var table1 = document.getElementById("table1"),
            table2 = document.getElementById("table2"),
            checkboxes = document.getElementsByName("check-tab2");
        console.log("Val1 = " + checkboxes.length);
        for(var i = 0; i < checkboxes.length; i++)
            if(checkboxes[i].checked)
            {
                // create new row and cells
                var newRow = table1.insertRow(table1.length),
                    cell1 = newRow.insertCell(0),
                    cell2 = newRow.insertCell(1),
                    cell3 = newRow.insertCell(2),
                    cell4 = newRow.insertCell(3);
                cell5 = newRow.insertCell(4),
                    cell6 = newRow.insertCell(5),
                    cell7 = newRow.insertCell(6),
                    cell8 = newRow.insertCell(7);
                // add values to the cells
                cell1.innerHTML = table2.rows[i+1].cells[0].innerHTML;
                cell2.innerHTML = table2.rows[i+1].cells[1].innerHTML;
                cell3.innerHTML = table2.rows[i+1].cells[2].innerHTML;
                cell4.innerHTML = table2.rows[i+1].cells[3].innerHTML;
                cell5.innerHTML = table2.rows[i+1].cells[4].innerHTML;
                cell6.innerHTML = table2.rows[i+1].cells[5].innerHTML;
                cell7.innerHTML = table2.rows[i+1].cells[6].innerHTML;
                cell8.innerHTML = "<input type='checkbox' name='check-tab1'>";

                // remove the transfered rows from the second table [table2]
                var index = table2.rows[i+1].rowIndex;
                table2.deleteRow(index);
                // we have deleted some rows so the checkboxes.length have changed
                // so we have to decrement the value of i
                i--;
                console.log(checkboxes.length);
            }
    }

</script>