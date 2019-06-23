<?php

/* 
 * Copyright (C) 2019 Matheus Gaspar
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Helper;

class Session {

    private $cookieTime;

    public function __construct() {
//        session_start();
        session_cache_limiter(false);
        $this->cookieTime = strtotime('+30 days');
    }

    /**
     * @param $name
     * @param $value
     */
    public function start() {
        if(!isset($_SESSION)){ 
            session_start(); 
        } 
    }

    /**
     * @param $name
     * @param $value
     */
    public function setAll($name, $value) {
        $_SESSION[$name] = $value;
        setcookie($name, $value, $this->cookieTime, "/");
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * @param $base
     * @param $key
     * @param $value
     */
    public function setMulti($base, $key, $value) {
        $_SESSION[$base][$key] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getAll() {
        return $_SESSION;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return $_SESSION[$name];
    }

    /**
     * @param $base
     * @param $key
     * @return mixed
     */
    public function getMulti($base, $key) {
        if (isset($_SESSION[$base][$key])) {
            return $_SESSION[$base][$key];
        }
        return $_SESSION[$base][$key];
    }

    /**
     * @param $name
     */
    public function kill($name) {
        unset($_SESSION[$name]);
    }

    /**
     * Destroy session
     */
    public function killAll() {
        session_destroy();
    }

    /**
     * @param $name
     * @param $value
     */
    public function setCookie($name, $value) {
        setcookie($name, $value, $this->cookieTime, "/");
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getAllCookie() {
        return $_COOKIE;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getCookie($name) {
        return $_COOKIE[$name];
    }

    /**
     * @param $name
     */
    public function killCookie($name) {
        setcookie($name, null, time()-3600, "/");
    }

    /**
     * @param $name
     */
    public function destroy() {
        foreach ($this->getAllCookie() as $name => $v) {
            unset($_COOKIE[$name]);
            $this->killCookie($name);
        }
        foreach ($this->getAll() as $name => $v) {
            $this->kill($name);
        }
        return true;
    }
}