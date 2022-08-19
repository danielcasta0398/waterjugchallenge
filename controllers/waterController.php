<?php

class WaterController {

    private $step = array();
    private $index = 1;

    public function getCalculation($data){

    $info = json_decode($data, true);

    //If there is any empty data we return an error

    if (!empty($info['bucketx']) && !empty($info['buckety']) && !empty($info['amount_wanted_z'])) {

        $x = $info['bucketx'];
        $y = $info['buckety'];
        $z = $info['amount_wanted_z'];

    //It is confirmed if there is a solution with the different combinations of the data     
        if ($z > $y && $z > $x) {
            return json_encode(array("message" => "No Solution"));
        }elseif ((($x > $z) && ($y > $z) && ($y-$x != $z) )) {
            if (($x-$y != $z)) {
                return json_encode(array("message" => "No Solution"));
            }
            
        }
    
    
        //We check if all the numbers are equal

        if ($x == $y && $x == $z) {
            $this->step[$this->index.'step'] = "Fill bucket X";
            return json_encode($this->step);
        }elseif ($x == $z) {
            $this->step[$this->index.'step'] = "Fill bucket X";
            return json_encode($this->step);
        }


        if ($x < $y) {
            if ((($z % $x) != 0) && (($y - $z) % $x != 0)) {
                return json_encode(array("message" => "No Solution"));
            }

            $res = $this -> bigNumberY($x,$y,$z);
            return json_encode($res);
        
        }else {            
            $res = $this -> bigNumberX($x,$y,$z);
            return json_encode($res);       
        }
        
        }else {
        return json_encode(array("message" => "No puedes pasar valores vacios"));        
        }
    }

    //This function is executed when the largest number is Y

    private function bigNumberY($x,$y,$z){        

        if($y == $z){
           $this->step[$this->index.'step'] = "Fill bucket Y";
           return $this->step;
        }elseif($x == $z){  
            $this->step[$this->index.'step'] = "Fill bucket X";
            return $this->step;
         }

        $halfY = round($y/2);

        if ((($halfY < $z) && ($z % $x != 0)) || ((($y - $z) % $x == 0) && ($y > $z) && ($z % $x != 0)) || (($halfY < $z) && ($x == 1))) {

            $this->step[$this->index.'step'] = "Fill bucket Y";
            $this->index++;

            while($y > $z){
                $y -= $x;
                $this->step[$this->index.'step'] = "Transfer bucket Y to bucket X";
                $this->index++;
                $this->step[$this->index.'step'] = "Dump bucket X";
                $this->index++; 
            }

            $this->index--; 
            $this->step[$this->index.'step'] = "Dump bucket X. Solved";
            return $this->step;
        }else{
            $y = 0;

            while($y < $z){
                $this->step[$this->index.'step'] = "Fill bucket X";
                $this->index++; 
                $y += $x;
                $this->step[$this->index.'step'] = "Transfer bucket X to bucket Y";
                $this->index++; 
            }
            $this->index--; 
            $this->step[$this->index.'step'] = "Transfer bucket X to bucket Y. Solved";
            return $this->step;
        }
    }

    
    //This function is executed when the largest number is X

    private function bigNumberX($x,$y,$z){        

        if($x == $z){
           $this->step[$this->index.'step'] = "Fill bucket X";
           return $this->step;
        }elseif($y == $z){
           $this->step[$this->index.'step'] = "Fill bucket Y";
           return $this->step;
        }

        $halfX = round($x/2);

        if ((($halfX < $z) && ($z % $y != 0)) || ((($x - $z) % $y == 0) && ($x > $z )&& ($z % $y != 0)) || (($halfX < $z) && ($y == 1))) {

            $this->step[$this->index.'step'] = "Fill bucket X";
            $this->index++;

            while($x > $z){
                $x -= $y;
                $this->step[$this->index.'step'] = "Transfer bucket X to bucket Y";
                $this->index++;
                $this->step[$this->index.'step'] = "Dump bucket Y";
                $this->index++; 
            }

            $this->index--; 
            $this->step[$this->index.'step'] = "Dump bucket Y. Solved";
            return $this->step;
        }else{

            $x = 0;

            while($x < $z){
                $this->step[$this->index.'step'] = "Fill bucket Y";
                $this->index++; 
                $x += $y;
                $this->step[$this->index.'step'] = "Transfer bucket Y to bucket x";
                $this->index++; 
            }
            $this->index--; 
            $this->step[$this->index.'step'] = "Transfer bucket X to bucket. Solved";
            return $this->step;
        }
    }

}