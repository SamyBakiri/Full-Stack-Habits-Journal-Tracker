<?php
namespace App\Middlewares;

use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Helper\Response;

class AuthMiddleware{
    
    public function getToken(){
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;
        if(!$authHeader){
        return null;
    }
        if(preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            return $token = $matches[1];
        }
        return null;
    }
    public function checkAuth($jwtService){
        $token = $this->getToken();
        
        if(!$token){
            $this->unauthorized("token missing");
        }
        try {
            $payLoad = $jwtService->verifyToken($token);
            return $payLoad;
        } catch (ExpiredException $e) {
            $this->unauthorized("token expired");
        }
        catch (SignatureInvalidException $e) {
            $this->unauthorized("token invalid");
        }
        catch (Exception $e) {
            $this->unauthorized("unauthorized");
        }
        
    }

    public function unauthorized($message){
        Response::jsonResponse(401, $message);
    }


}