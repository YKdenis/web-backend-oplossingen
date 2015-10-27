<?php

class Percent 
{
    public $absolute;
    public $relative;
    public $hundred;
    public $nominal;
    
    public function __construct( $new, $unit ) {
        // echo 'blablabl';
        $this->absolute = $this->formatNumber($new / $unit);
        $this->relative = $this->formatNumber($this->absolute - 1);
        $this->hundred = $this->formatNumber($this->absolute * 100);
        $this->nominal = $this->absolute > 1 ? 'positive' : ($this->absolute == 1 ? 'status-quo' : 'negative') ;
        
    }
    
    public function formatNumber( $number ) {
        
        return number_format( $number, 2 );
        
    }
}