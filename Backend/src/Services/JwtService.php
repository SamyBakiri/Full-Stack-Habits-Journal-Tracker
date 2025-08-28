<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService{
    private $secret;
    private $algo;
    private $expiry;

    public function __construct() {
        $Config = require __DIR__ . "/../Config/Jwt.php";
        $this->secret = $Config["secret"];
        $this->algo = $Config["algo"];
        $this->expiry = $Config["expiry"];
    }

    public function generateToken($userId){
        $issuedAt = time();
        $expire = $issuedAt + $this->expiry;
        $payLoad = [
            "iat" => $issuedAt,
            "exp" =>$expire,
            'sub' =>$userId
        ];
        return JWT::encode($payLoad, $this->secret, $this->algo);
    }


    public function verifyToken($token){
        
        return JWT::decode($token, new Key($this->secret, $this->algo));
    }
}