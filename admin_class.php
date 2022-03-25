<?php
session_start();
ini_set('display_errors', 1);

class Action
{
    private $db;

    public function __construct()
    {
        ob_start();
        include 'db_connect.php';

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
        $user_id = ($_SESSION['login_id']);
        foreach ($price as $k => $v) {
            $data = "";
            foreach ($_POST as $key => $val) {
                if (!in_array($key, array('id', 'weight', 'number', 'price')) && !is_numeric($key)) {
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

            $data .= ", number='{$number[$k]}' ";

            $data .= ", weight='{$weight[$k]}' ";
            $price[$k] = str_replace(',', '', $price[$k]);
            $data .= ", price='{$price[$k]}' ";
            if (empty($id)) {
                $i = 0;
                while ($i == 0) {
                    $ref = sprintf("%'06d", mt_rand(0, 999999));
                    $chk = $this->db->query("SELECT * FROM parcels where br_dec = '$ref'")->num_rows;
                    if ($chk <= 0) {
                        $i = 1;
                    }
                }
                $data .= ", br_dec='$ref' ";
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
        $parcel = $this->db->query("SELECT * FROM parcels where br_dec = '$ref_no'");


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
        $get = $this->db->query("SELECT * FROM parcels where date(date_created) BETWEEN '$date_from' and '$date_to' " . ($status != 'all' ? " and status = $status " : "") . " order by unix_timestamp(date_created) asc");
        $status_arr = array("Enregistré", "Envoyé", "Livré en gars", "Livré à domicile");
        while ($row = $get->fetch_assoc()) {
            $row['sender_name'] = ucwords($row['sender_name']);
            $row['recipient_name'] = ucwords($row['recipient_name']);
            $row['date_created'] = date("M d, Y", strtotime($row['date_created']));
            $row['status'] = $status_arr[$row['status']];
            $row['price'] = number_format($row['price'], 2);
            $data[] = $row;
        }
        return json_encode($data);
    }
}