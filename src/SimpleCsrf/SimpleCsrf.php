<?php
namespace SimpleCsrf;

class SimpleCsrf {
    private
        $_storage = null
    ;
    
    public
        $keyName = 'csrf_key',
        $tokenName = 'csrf_token'
    ;
    
    public function __construct ($storage) {
        $this->_storage = $storage;
    }
    
    public function validate($data) {
        $key = $data[$this->keyName];
        $token = $data[$this->tokenName];
        
        $saved = $this->_storage->get($key);
        $this->_storage->del($key);
        
        return $token == $saved;
    }
    
    public function getCSRF($html=true) {
        $key = md5(uniqid());
        $token = base64_encode('detikcsrf'.$key);
        $this->_storage->set($key, $token, 86400);
        
        $data = array (
            'keyName'   => $this->keyName,
            'key'       => $key,
            'tokenName' => $this->tokenName,
            'token'     => $token
        );
        
        if ($html) {
            $ret = vsprintf('<input type="hidden" name="%s" value="%s"/>
                        <input type="hidden" name="%s" value="%s"/>',
                        $data);
        }
        else {
            $ret = $data;
        }
        
        return $ret;
    }
}
