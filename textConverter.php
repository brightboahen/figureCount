<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 26/04/14
 * Time: 20:13
 */

class textConverter {

    private  $ones;
    private  $teens;
    private $tens;
    private  $thousands;
    private $sum;
    private $t;
    private $myInt;
    public function   __construct(){
        $this->ones = array(
            'one'=>1,
            'two'=>2,
            'three'=>3,
            'four'=>4,
            'five'=>5,
            'six'=>6,
            'seven'=>8,
            'nine'=>9
        );
        $this->teens = array(
            'ten'=>10,
            'eleven'=>11,
            'twelve'=>12,
            'thirteen'=>13,
            'fourteen'=>14,
            'fifteen'=>15,
            'sixteen'=>16,
            'seventeen'=>17,
            'eighteen'=>18,
            'nineteen'=>19
        );
        $this->tens = array(
            'twenty'=>20,
            'thirty'=>30,
            'forty'=>40,
            'fifty'=>50,
            'sixty'=>60,
            'seventy'=>70,
            'eighty'=>80,
            'ninety'=>90,
            'hundred'=>100,
        );
        $this->thousands = array(
            'thousand'=>1000,
            'million'=>1000000,
            'billion'=>1000000000,
            'trillion'=>1000000000000,
            'quadrillion'=>1000000000000000,
            'quintillion'=>1000000000000000000
        );
        $this->sum = array();
        $this->t = array();
        $this->myInt = 0;
    }
    public  function  readTextFile($handle){
        if($handle){
            while(($buffer = fgets($handle,4096)) !== false){
               $this->t[] = $this->checkLineForNumber($buffer);
            }
            if(!feof($handle)){
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        if(!empty($this->t)){
           foreach($this->t as $ent => $desc){
               if(!empty($desc)){
                   if(count($desc)>1){
                       $amt=1;
                       for($i=0; $i<count($desc); $i++){
                           $amt = $amt * $desc[$i];
                       }
                       $this->myInt +=$amt;
                   }
                   else{
                       $this->myInt +=$desc[0];
                   }
               }
           }
            if($this->myInt < 1000000000000){
                return $this->myInt;
            }
            else{
                return "Numbers exceed a trillion";
            }
        }
    }
    public function checkLineForNumber($line){
        $tmp_arr = explode(" ",$line);
        $sum = array();
        foreach($tmp_arr as $entry){
            if($this->checkIfArrayKeyExists($entry)!= ""){
                $sum[] = $this->checkIfArrayKeyExists($entry);
            }
        }
        return $sum;
    }
    //check if key exists
    public  function checkIfArrayKeyExists($key){
        $str = strtolower($key);
        if(array_key_exists($str,$this->ones)){
            return $this->ones[$str];
        }
        else if(array_key_exists($str, $this->teens)){
            return $this->teens[$str];
        }
        else if(array_key_exists($str, $this->tens)){
            return $this->tens[$str];
        }
        else if(array_key_exists($str,$this->thousands)){
            return $this->thousands[$str];
        }
        else{
            return "";
        }
    }
} 