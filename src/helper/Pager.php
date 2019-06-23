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

/**
 * Description of Pager
 *
 * @author Matheus Gaspar
 */
class pager{

        /**
        *
        * Constructor, duh!
        *
        * @access       public
        * @param        $num_pages
        * @param        $limit
        * @param        $page
        *
        */
        public function __construct( $num_results=null, $limit=null, $page=null )
        {
                if( !is_null( $num_results ) && !is_null( $limit ) && !is_null( $page ) )
                {
                        $this->num_results = $num_results;
                        $this->limit = $limit;
                        $this->page = $page;
                        $this->run();
                }
        }

        /**
        *
        * Settor
        *
        * @param        string  $name
        * @param        mixed   $value
        *
        */
        public function __set( $name, $value )
        {
                switch( $name )
                {
                        case 'menu_link_suffix':
                        case 'num_results':
                        case 'menu_link':
                        case 'css_class':
                        case 'num_pages':
                        case 'offset':
                        case 'limit':
                        case 'page':
                        $this->$name = $value;
                        break;

                        default: throw new \Exception( "Unable to set $name" );
                }
        }

        /**
        *
        * Gettor
        *
        * @param        string  $name
        *
        */
        public function __get( $name )
        {
                switch( $name )
                {
                        case 'menu_link_suffix':
                        case 'num_results':
                        case 'menu_link':
                        case 'css_class':
                        case 'num_pages':
                        case 'offset':
                        case 'limit':
                        case 'page':
                        return $this->$name;
                        break;

                        default: throw new \Exception( "Unable to get $name" );
                }
        }

        /**
         * @calculate paging inforomation
         *
         * @access public
         * @param int $num_pages
         * @param int $limit
         * @param $page
         * @return object
         *
         **/
        public function run()
        {
                /*** the number of pages ***/
                $this->num_pages = ceil( $this->num_results / $this->limit );
                $this->page = max( $this->page, 1 );
                $this->page = min( $this->page, $this->num_pages );
                /*** calculate the offset ***/
                $this->offset = ( $this->page - 1 ) * $this->limit;
        }

        /**
        *
        * return a HTML string representation of the pager links
        * The links are in an <ul> with a CSS class name
        *
        * @access       public
        * @retun        string
        *
        */
        public function __toString()
        {
                $menu = '<ul';
                $menu .= isset( $this->css_class ) ? ' class="'.$this->css_class.'"' : '';
                $menu .= '>';

                /*** if this is page 1 there is no previous link ***/
                if($this->page != 1)
                {
                        $menu .= '<li><a href="'.$this->menu_link.'/'.( $this->page - 1 );
                        $menu .= isset( $this->menu_link_suffix ) ? $this->menu_link_suffix : '';
                        $menu .= '">PREV</a></li>';
                }

                /*** loop over the pages ***/
                for( $i = 1; $i <= $this->num_pages; $i++ )
                {
                        if( $i == $this->page )
                        {
                                $menu .= '<li class="active"><a href="'.$this->menu_link.'/'.$i;
                                $menu .= isset( $this->menu_link_suffix ) ? $this->menu_link_suffix : '';
                                $menu .= '">'.$i.'</a></li>';
                        }
                        else
                        {
                                $menu .= '<li><a href="'.$this->menu_link.'/'.$i;
                                $menu .= isset( $this->menu_link_suffix ) ? $this->menu_link_suffix : '';
                                $menu .= '">'.$i.'</a></li>';
                        }
                }

                /*** if we are on the last page, we do not need the NEXT link ***/
                if( $this->page < $this->num_pages )
                {
                        $menu .= '<li><a href="'.$this->menu_link.'/'.( $this->page + 1 );
                        $menu .= isset( $this->menu_link_suffix ) ? $this->menu_link_suffix : '';
                        $menu .= '">Next</a></li>';
                }
                return $menu;
        }

} /*** end of class ***/
