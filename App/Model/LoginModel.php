<?php

namespace App\Model;

use Core\Model;

class LoginModel extends Model
{
    public function usuariosCrm($email, $password)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = '".$email."'");
        $query->execute();
        return $query->fetch();
    }
}