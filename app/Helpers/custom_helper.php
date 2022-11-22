<?php
function userLogin()
{
    $db = \Config\Database::connect();
    return $db->table('tbl_user')->where('id_user', session('id_user'))->get()->getRow();
}
