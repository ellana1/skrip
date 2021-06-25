<?php
Class RegresiLinier{
    
    public  $x, //inputted x param
            $y, //inputted y param
            $n, //count of data

            $x2,
            $y2,
            $xy,
            $a,
            $b,
    
            $all; //forecast y value based on linear regression
    
    
    public function __construct($x=null, $y=null){
        if(!is_null($x) && !is_null($y)){
            $this->x = $x;
            $this->y = $y;
            $this->compute();
        }
    }
    
    public function compute(){
        if(is_array($this->x) && is_array($this->y)){
            if(count($this->x) == count($this->y)){
                $this->n  = count($this->x);
                
                $this->prepare_calculation();
                $this->ab();
                $this->linear_regression();
            }
            else{
                throw new Exception('Jumlah data variabel X dan Y harus sama');
            }

        }
        else{
            throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }
    
    public function prepare_calculation(){
        //persiapan menghitung x2, y2, dan xy;
        $this->x2 = array_map(function($n){
            return $n * $n;
        }, $this->x);
        $this->y2 = array_map(function($n){
            return $n * $n;
        }, $this->y);
        
        
        for($i=0; $i<$this->n; $i++){
            $this->xy[$i] = $this->x[$i] * $this->y[$i];
        }
        
    }
    
    public function ab(){
        //mendapat nilai konstanta A dan B
        $a = ((array_sum($this->y) * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->xy))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->a = $a;
        
        $b = (($this->n * array_sum($this->xy)) - (array_sum($this->x) * array_sum($this->y))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->b = $b;
    }
    
    public function forecast($xfore){
        $y = $this->a + ($this->b * $xfore);
        return $y;
    }
    
    public function linear_regression(){
        $n = 0;
        foreach($this->x as $xnew){
            $this->all[$n] = $this->forecast($xnew);
            $n++;
        }
    }
    
    
    
}