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

spl_autoload_register(function($class){
    $PATHS = [ BASE_PATH_DAO, BASE_PATH_MODEL, BASE_PATH_HELPER ];
    $parts = explode("\\", $class);
    $className = end($parts).".php";
    foreach ($PATHS as $path){
        $file = $path.$className;
//        echo $file."<br/>";
        if(file_exists($file)):
            require_once $file;
            break;
        endif;
    }
});