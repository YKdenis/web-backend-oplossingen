<?php

class TodoOrNotTodo
{
    
    protected $valueTodo;
    protected $statusTodo;
    
    public function __construct ($ValueTodo, $StatusTodo) {
        
        $this->valueTodo = $ValueTodo;
        $this->statusTodo = $StatusTodo;
        
    }
    
    public function GetValue() {
        
        return $this->valueTodo;
        
    }
    
    public function GetStatus() {
        
        return $this->statusTodo;
        
    }
    
    public function ChangeStatus() {
        
        if($this->statusTodo == 'done') {
            $this->statusTodo = 'not done';
        }
        else {
            $this->statusTodo = 'done';
        } 
        
        return $this->statusTodo;
    }
    
}