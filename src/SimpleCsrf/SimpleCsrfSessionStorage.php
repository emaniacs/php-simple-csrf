<?php
namespace SimpleCsrf;

class SimpleCsrfSessionStorage implements SimpleCsrfStorageInterface {
    protected 
        $data =  array(),
        $name = null
    ;
    
    public function __construct ($name='csrf_session_name') {
        if (! session_id()) {
            @session_start();
        }
        
        $this->name = $name;
        $this->data = @$_SESSION[$this->name];
    }
    
    public function get($key) {
        $ret = null;
        
        if (isset ($this->data[$key])) {
            $ret = $this->data[$key];
        }
        return $ret;
    }
    
    public function set($key, $value) {
        $this->data[$key] = $value;
        $_SESSION[$this->name] = $this->data;
        
        return true;
    }
    
    public function del($key) {
        unset($this->data[$key]);
        $_SESSION[$this->name] = $this->data;
    }
}
