<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BD {
    //put your code here
    
    private static $conn;
    public function __construct(){}
        
    public function conn(){
             
        if(is_null(self::$conn)){
            self::$conn = new PDO('mysql:host=localhost;dbname=chat1', ''.USER.'', ''.PASS.'');
            if(self::$conn == TRUE){
                //echo "sucesso";                
            }else{
                //echo "erro";
            }
        }
        return self::$conn;
    }
      
}

