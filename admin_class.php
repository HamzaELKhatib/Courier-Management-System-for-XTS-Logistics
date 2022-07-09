<?php
session_start();
ini_set('display_errors', 1);

class Action
{
    private $db;

    public function __construct()
    {
        ob_start();
        include 'database/db_connect.php';

        $this->db = $conn;
    }

    function __destruct()
    {
        $this->db->close();
        ob_end_flush();
    }

    function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // password_verify($password, $hash)
        $qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '" . $email . "'  ");
        $hash = $this->db->query("SELECT password FROM users WHERE email = '" . $email . "'  ");
        $hash = mysqli_fetch_array($hash);

        if ($qry->num_rows > 0 && password_verify($password, $hash[0])) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            return 1;
        } else {
            return 2;
        }
    }

    function logout()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    function save_user()
    {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (!empty($password)) {
            $pw = password_hash($password, PASSWORD_BCRYPT);
            $data .= ", password=('$pw') ";

        }
        $check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
        if ($check > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set $data");
        } else {
            $save = $this->db->query("UPDATE users set $data where id = $id");
        }

        if ($save) {
            return 1;
        }
    }

    function signup()
    {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'cpass')) && !is_numeric($k)) {
                if ($k == 'password') {
                    if (empty($v))
                        continue;
                    $v = md5($v);

                }
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }

        $check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
        if ($check > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set $data");

        } else {
            $save = $this->db->query("UPDATE users set $data where id = $id");
        }

        if ($save) {
            if (empty($id))
                $id = $this->db->insert_id;
            foreach ($_POST as $key => $value) {
                if (!in_array($key, array('id', 'cpass', 'password')) && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            $_SESSION['login_id'] = $id;
            return 1;
        }
    }

    function update_user()
    {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'cpass', 'table')) && !is_numeric($k)) {
                if ($k == 'password')
                    $v = md5($v);
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }

        $check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
        if ($check > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set $data");
        } else {
            $save = $this->db->query("UPDATE users set $data where id = $id");
        }

        if ($save) {
            foreach ($_POST as $key => $value) {
                if ($key != 'password' && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            return 1;
        }
    }

    function delete_user()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users where id =" . $id);
        if ($delete)
            return 1;
    }


    function save_branch()
    {
        extract($_POST);
        $street = addslashes($_POST['street']);
        $_POST['street'] = $street;
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (empty($id)) {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $i = 0;
            while ($i == 0) {
                $bcode = substr(str_shuffle($chars), 0, 15);
                $chk = $this->db->query("SELECT * FROM branches where branch_code = '$bcode'")->num_rows;
                if ($chk <= 0) {
                    $i = 1;
                }
            }
            $data .= ", branch_code='$bcode' ";
            $save = $this->db->query("INSERT INTO branches set $data");
        } else {
            $save = $this->db->query("UPDATE branches set $data where id = $id");
        }
        if ($save) {
            return 1;
        }
    }

    function delete_branch()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM branches where id = $id");
        if ($delete) {
            return 1;
        }
    }

    function save_parcel()
    {
        extract($_POST);
        $_POST['recipient_city'] = strtolower($_POST['recipient_city']);
        $user_id = ($_SESSION['login_id']);
        foreach ($price as $k => $v) {
            $data = "";
            foreach ($_POST as $key => $val) {
                if (!in_array($key, array('id', 'weight', 'height','width','length', 'number', 'note', 'price', 'price_retour_bl', 'price_retour_de_fond', 'type_retour_de_fond1','type_retour_de_fond2', 'type_retour_de_fond3')) && !is_numeric($key)) {
                    if (empty($data)) {
                        $data .= " $key='$val' ";
                    } else {
                        $data .= ", $key='$val' ";
                    }
                }
            }
            if (!isset($type)) {
                $data .= ", type='2' ";
            }
            if (!isset($type_expedition)) {
                $data .= ", type_expedition='2' ";
            }
            if (!isset($type_client)) {
                $data .= ", type_client='2' ";
            }



            $price[$k] = str_replace(',', '', $price[$k]);
            if (!isset($payment_type)) {
                $data .= ", payment_type='2' ";
                $data .= ", price='{$price[$k]}' ";
            }else{
                $data .= ", due_price='{$price[$k]}' ";
            }
            if (isset($type_retour_de_fond1)) {
                $data .= ", type_retour_de_fond='1' ";
            }if (isset($type_retour_de_fond2)) {
                $data .= ", type_retour_de_fond='2' ";
            }if (isset($type_retour_de_fond3)) {
                $data .= ", type_retour_de_fond='3' ";
            }

            $data .= ", number='{$number[$k]}' ";
            $data .= ", height='{$height[$k]}' ";
            $data .= ", width='{$width[$k]}' ";
            $data .= ", length='{$length[$k]}' ";
            $data .= ", weight='{$weight[$k]}' ";
            $data .= ", note='{$note[$k]}' ";
            $data .= ", price_retour_bl='{$price_retour_bl[$k]}' ";
            $data .= ", price_retour_de_fond='{$price_retour_de_fond[$k]}' ";



            if (empty($id)) {
                $i = 0;
                while ($i == 0) {
                    $ref = sprintf("%'06d", mt_rand(0, 999999999999));
                    $chk = $this->db->query("SELECT * FROM parcels where reference = '$ref'")->num_rows;
                    if ($chk <= 0) {
                        $i = 1;
                    }
                }
                $data .= ", reference='$ref' ";
                if ($save[] = $this->db->query("INSERT INTO parcels set $data"))
                    $ids[] = $this->db->insert_id;
            } else {
                if ($save[] = $this->db->query("UPDATE parcels set $data where id = $id"))
                    $ids[] = $id;
            }
        }
        if (isset($save) && isset($ids)) {
            // return json_encode(array('ids'=>$ids,'status'=>1));
            $saveu = $this->db->query("INSERT INTO parcel_tracks set status= 0 , parcel_id = last_insert_id() , user_id = $user_id ");
            if ($saveu) {
                return 1;
            }
        }
    }

    function delete_parcel()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM parcels where id = $id");
        if ($delete) {
            return 1;
        }
    }

    function update_parcel()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status= $status where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status= $status , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function update_parcel_send()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status=1 where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status=1 , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function arrived_parcel_domicile()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status=3 where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status=3 , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function arrived_parcel_agence()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status=2 where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status=2 , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function return_parcel()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status=4 where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status=4 , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function save_parcel_agence()
    {
        extract($_POST);
        $user_id = ($_SESSION['login_id']);
        $update = $this->db->query("UPDATE parcels set status=0 where id = $id");
        $save = $this->db->query("INSERT INTO parcel_tracks set status=0 , parcel_id = $id , user_id = $user_id ");
        if ($update && $save)
            return 1;
    }

    function get_parcel_history()
    {
        extract($_POST);
        $data = array();
        $parcel = $this->db->query("SELECT * FROM parcels where reference = '$ref_no'");


        if ($parcel->num_rows <= 0) {
            return 2;
        } else {
            $parcel = $parcel->fetch_array();

            $history = $this->db->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");

            $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
            while ($row = $history->fetch_assoc()) {

                $username = $this->db->query("SELECT concat(firstname,' ',lastname) as name FROM users where id = {$row['user_id']}");
                $username = mysqli_fetch_all($username);

                $branchid = $this->db->query("SELECT branch_id FROM users where id = {$row['user_id']}");
                $branchid = mysqli_fetch_row($branchid);

                $city = $this->db->query("SELECT city FROM branches where id = $branchid[0]");
                $city = mysqli_fetch_all($city);

                $row['date_created'] = date("M d, Y h:i A", strtotime($row['date_created']));
                $row['status'] = $status_arr[$row['status']];
                $row['username'] = ($username);
                $row['city'] = ($city);

                $data[] = $row;

            }
            return json_encode($data);
        }
    }

    function get_report()
    {
        extract($_POST);
        $data = array();

        $get = $this->db->query("
SELECT * 
FROM parcels 
where date(date_created) BETWEEN '$date_from' and '$date_to' " . ($status != 'all' ? " and status = $status " : "") . " 
order by unix_timestamp(date_created) asc");


        $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
        while ($row = $get->fetch_assoc()) {
            $sender_name = ucwords($row['sender_name']);
            $recipient_name = ucwords($row['recipient_name']);
            $row['exp_date'] = '';
            $row['liv_date'] = '';
           /* $date_created = date("M d, Y", strtotime($row['date_created']));*/
            $price = number_format($row['price'], 2);

            $exp_query = $this->db->query("
SELECT parcel_tracks.date_created 
FROM parcel_tracks,parcels 
WHERE parcel_tracks.parcel_id = {$row['id']} 
  and parcels.id={$row['id']} 
  and parcels.status!=0 
  and parcel_tracks.status=1
ORDER BY parcel_tracks.id DESC LIMIT 1");
            while( $exp_query1 = $exp_query->fetch_assoc()){
                $exp_date =date("d/m/Y", strtotime($exp_query1['date_created']));
                $row['exp_date'] = $exp_date;
            }

            $liv_query = $this->db->query("
SELECT parcel_tracks.date_created 
FROM parcel_tracks,parcels 
WHERE parcel_tracks.parcel_id = {$row['id']} 
  and parcels.id={$row['id']} 
  and parcels.status IN (2,3) 
  and parcel_tracks.status IN (2,3)
ORDER BY parcel_tracks.id DESC LIMIT 1");
            while( $liv_query1 = $liv_query->fetch_assoc()){
                $liv_date =date("d/m/Y", strtotime($liv_query1['date_created']));
                $row['liv_date'] = $liv_date;
            }


            $row['sender_name'] = $sender_name;
            $row['recipient_name'] = $recipient_name;
            $row['price'] = $price;

            $data[] = $row;
        }
        return json_encode($data);
    }
}