<?php
namespace SimpleCsrf;

interface SimpleCsrfStorageInterface {
    public function get($key);
    public function set($key, $value);
    public function del($key);
}
