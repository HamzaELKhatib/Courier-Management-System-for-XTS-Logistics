<?php include 'db_connect.php' ?>
<?php $status = isset($_GET['status']) ? $_GET['status'] : 'all' ?>
<?php if ($_SESSION['login_type'] == 1): ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <?php
                $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile","Retour"); ?>
                <label for="date_from" class="mx-1">Status</label>
                <select name="" id="status" class="custom-select custom-select-sm col-sm-3">
                    <option value="all" <?php echo $status == 'all' ? "selected" : '' ?>>Tout<br> </option>
                    <?php foreach ($status_arr as $k => $v): ?>
                        <option value="<?php echo $k ?>" <?php echo $status != 'all' && $status == $k ? "selected" : '' ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="date_from" class="mx-1">From</label>
                <input type="date" id="date_from" class="form-control form-control-sm col-sm-3"
                       value="<?php echo isset($_GET['date_from']) ? date("Y-m-d", strtotime($_GET['date_from'])) : '' ?>">
                <label for="date_to" class="mx-1">To</label>
                <input type="date" id="date_to" class="form-control form-control-sm col-sm-3"
                       value="<?php echo isset($_GET['date_to']) ? date("Y-m-d", strtotime($_GET['date_to'])) : '' ?>">
                <button class="btn btn-sm btn-primary mx-1 bg-gradient-primary" type="button" id='view_report'>Voir Rapport
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success float-right" style="display: none" id="print">
                                <i class="fa fa-print"></i> Imprimer
                            </button>
                            <br>
                        </div>
                    </div>


                    <table class="table table-bordered" align="left" cellspacing="0" border="1" id="report-list">

                        <thead>
                        <tr>
                            <th style="border-left: 1px solid #ffffff" height="25" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">N&deg; DEC/BR</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">DATE EXP.</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0"><b><font face="Arial" color="#FFFFFF">EXPEDITEUR</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0"><b><font face="Arial" color="#FFFFFF">CIN</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#0070C0"><b><font face="Arial" color="#FFFFFF">VILLE</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" color="#FFFFFF">DESTINAIRE</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" color="#FFFFFF">CIN D</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" color="#FFFFFF">DESTINATION</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#00B050"><b><font face="Arial" color="#FFFFFF">DATE LIV.</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">COLIS</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">POIDS</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">STATUS</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">P. PAY&Eacute;</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#002060"><b><font face="Arial" color="#FFFFFF">P. D&Ucirc;</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#385724"><b><font face="Arial" color="#FFFFFF">R. Fonds</font></b></th>
                            <th style="border-left: 1px solid #ffffff" align="center" valign=middle bgcolor="#BF9000"><b><font face="Arial" color="#FFFFFF">R. BL</font></b></th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <th colspan="8"></th>
                        <th class="text-right">Total :</th>
                        <th id="nColis" class="text-right"></th>
                        <th id="cWeight" class="text-right"></th>
                        <th></th>
                        <th id="tAmount" class="text-right"></th>
                        <th id="dAmount" class="text-right"></th>
                        <th id="Rfond" class="text-right"></th>
                        <th id="Rbl" class="text-right"></th>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!------------------------------->
<noscript>
    <style type="text/css">
        body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
        a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
        a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
        comment { display:none;  }
        .sorttable_sorted,.sorttable_sorted_reverse,table.sortable thead td:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort) { white-space: nowrap; cursor: pointer; }
        table.sortable thead td:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { content:" \25B4\25BE"; }
        table.table {
            width: 100%;
            border-collapse: collapse;
        }

        table.table tr, table.table th, table.table td {
            border: 1px solid;
        }

        .text-center {
            text-align: center;
        }
    </style>

    <table align="left" cellspacing="0" border="0">
        <colgroup width="62"></colgroup>
        <colgroup width="107"></colgroup>
        <colgroup width="189"></colgroup>
        <colgroup width="80"></colgroup>
        <colgroup width="88"></colgroup>
        <colgroup width="172"></colgroup>
        <colgroup width="88"></colgroup>
        <colgroup width="84"></colgroup>
        <colgroup width="86"></colgroup>
        <colgroup width="85"></colgroup>
        <colgroup width="83"></colgroup>
        <colgroup width="68"></colgroup>
        <colgroup width="71"></colgroup>
        <colgroup span="2" width="77"></colgroup>
        <colgroup width="97"></colgroup>
        <tr>
            <td colspan=3 rowspan=3 height="64" align="left" valign=bottom><font face="Arial" size=1
                                                                                 color="#000000"><br><img
                            src="Tables%20to%20print/result_htm_56a5069f99260b80.png" width=287 height=53 hspace=37 vspace=7>
                </font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
        <tr>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td colspan=6 align="center" valign=middle><b><u><font face="Arial" size=5 color="#203864">ETAT DE COMPTE
                            MENSUELLE</font></u></b></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="right" valign=bottom sdnum="1033;0;@"><b><u><font face="Arial" color="#002060"></font></u></b>
            </td>
            <td colspan=5 align="left" valign=bottom sdnum="1033;0;@"><font face="Arial" size=3 color="#000000">
                    </font></td>


        </tr>
        <tr>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
        <tr>
            <td height="21" align="left" valign=bottom><b><u><font face="Arial" color="#002060">AGENCE :</font></u></b></td>
            <td colspan=2 align="left" valign=bottom><font face="Arial" color="#000000">NEJME CHAMAL TETOUAN</font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td colspan=2 align="left" valign=bottom sdnum="1033;1033;M/D/YYYY"><font face="Arial"
                                                                                      color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td colspan=2 align="right" valign=bottom><b><u><font face="Arial" size=3 color="#002060">COMPTE
                            :</font></u></b></td>
            <td colspan=3 align="left" valign=bottom bgcolor="#0070C0"><b><font face="Arial" size=3 color="#FFFFFF">RECEPTION</font></b>
            </td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>

        <tr>
            <td height="7" align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
            <td align="left" valign=bottom><font color="#000000"><br></font></td>
        </tr>
    </table>











</noscript>
<div class="details d-none">
    <p><b><u><font face="Arial" color="#002060">Période :</font></u></b> <span class="drange" style="font-size: 10px"></span></p>
</div>
<script>
    function load_report() {
        start_load()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        let total_number = 0
        let total_weight = 0
        let sum_price = 0
        let sum_due_price = 0
        let sum_fond = 0
        let sum_bl = 0
        $.ajax({
            url: 'ajax.php?action=get_report',
            method: 'POST',
            data: {status: status, date_from: date_from, date_to: date_to},
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error')
                end_load()
            },
            success: function (resp) {
                if (typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object') {
                    resp = JSON.parse(resp)
                    if (Object.keys(resp).length > 0) {
                        $('#report-list tbody').html('')
                        var i = 1;
                        Object.keys(resp).map(function (k) {
                            var tr = $('<tr></tr>')
                            tr.append('<td>' + (resp[k].br_dec) + '</td>')
                            tr.append('<td>' + (resp[k].exp_date) + '</td>')
                            tr.append('<td>' + (resp[k].sender_name) + '</td>')
                            tr.append('<td>' + (resp[k].sender_id) + '</td>')
                            tr.append('<td>' + (resp[k].sender_city) + '</td>')
                            tr.append('<td>' + (resp[k].recipient_name) + '</td>')
                            tr.append('<td>' + (resp[k].recipient_cin) + '</td>')
                            tr.append('<td>' + (resp[k].recipient_city) + '</td>')
                            tr.append('<td>' + (resp[k].liv_date) + '</td>')
                            tr.append('<td>' + (resp[k].number) + '</td>')
                            tr.append('<td>' + (resp[k].weight) + '</td>')

                            if ((resp[k].status) == 0){
                                tr.append('<td>' + 'Enregistré' + '</td>')
                            }if ((resp[k].status) == 1){
                                tr.append('<td>' + 'Envoyé' + '</td>')
                            }if ((resp[k].status) == 2){
                                tr.append('<td>' + 'Livré en gars' + '</td>')
                            }if ((resp[k].status) == 3){
                                tr.append('<td>' + 'Livré à domicile' + '</td>')
                            }if ((resp[k].status) == 4){
                                tr.append('<td>' + 'Retour' + '</td>')
                            }

                            tr.append('<td>' + (resp[k].price) + '</td>')
                            tr.append('<td>' + (resp[k].due_price) + '</td>')
                            tr.append('<td>' + (resp[k].price_retour_de_fond) + '</td>')
                            tr.append('<td>' + (resp[k].price_retour_bl) + '</td>')
                            $('#report-list tbody').append(tr)
                            //-------------------------------------------
                            //Sum of colomn numbers
                            total_number = total_number + parseFloat(resp[k].number.replace(/\,/g, ''), 10)
                            total_weight = total_weight + parseFloat(resp[k].weight.replace(/\,/g, ''), 10)
                            sum_price = sum_price + parseFloat(resp[k].price.replace(/\,/g, ''), 10)
                            sum_due_price = sum_due_price + parseFloat(resp[k].due_price.replace(/\,/g, ''), 10)
                            sum_fond = sum_fond + parseFloat(resp[k].price_retour_de_fond.replace(/\,/g, ''), 10)
                            sum_bl = sum_bl + parseFloat(resp[k].price_retour_bl.replace(/\,/g, ''), 10)
                            //console.log(sum)
                            //-------------------------------------------
                        })

                        $('#nColis').append(total_number)
                        $('#cWeight').append(total_weight + " kg")
                        $('#tAmount').append(sum_price + " dh")
                        $('#dAmount').append(sum_due_price + " dh")
                        $('#Rfond').append(sum_fond + " dh")
                        $('#Rbl').append(sum_bl + " dh")

                        $('#print').show()
                    } else {
                        $('#report-list tbody').html('')
                        var tr = $('<tr></tr>')
                        tr.append('<th class="text-center" colspan="6">Pas de résultat.</th>')
                        $('#report-list tbody').append(tr)
                        $('#print').hide()
                    }
                }
            }
            , complete: function () {
                end_load()
            }
        })
    }

    $('#view_report').click(function () {
        $('#tAmount').empty()
        if ($('#date_from').val() == '' || $('#date_to').val() == '') {
            alert_toast("Veuillez d'abord sélectionner les dates.", "error")
            return false;
        }

        load_report()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        var target = './index.php?page=reports&filtered&date_from=' + date_from + '&date_to=' + date_to + '&status=' + status
        window.history.pushState({}, null, target);
    })

    $(document).ready(function () {
        if ('<?php echo isset($_GET['filtered']) ?>' == 1)
            load_report()
    })
    $('#print').click(function () {
        start_load()
        var ns = $('noscript').clone()
        var details = $('.details').clone()
        var content = $('#report-list').clone()
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val()
        var status = $('#status').val()
        var stat_arr = '<?php echo json_encode($status_arr) ?>';
        stat_arr = JSON.parse(stat_arr);
        details.find('.drange').text(date_from + " au " + date_to)
        if (status > -1)
            details.find('.status-field').text(stat_arr[status])
        ns.append(details)

        ns.append(content)
        var nw = window.open('', '', 'height=700,width=900')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(function () {
            nw.close()
            end_load()
        }, 750)

    })

</script>

<?php
endif;
?>
