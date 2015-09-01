<?php
/*      Project:        EQdkp-Plus
 *      Package:        Abbreviations Plugin
 *      Link:           http://eqdkp-plus.eu
 *
 *      Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *      This program is free software: you can redistribute it and/or modify
 *      it under the terms of the GNU Affero General Public License as published
 *      by the Free Software Foundation, either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU Affero General Public License for more details.
 *
 *      You should have received a copy of the GNU Affero General Public License
 *      along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('EQDKP_INC')){
        header('HTTP/1.0 404 Not Found');exit;
}

/*+----------------------------------------------------------------------------
  | abbreviations
  +--------------------------------------------------------------------------*/
class abbreviations extends plugin_generic
{
        public $version    = '0.1.0';
        public $build      = '';
        public $copyright  = 'Bloodsoul';
        public $vstatus    = 'Beta';
        protected static $apiLevel = 20;

        /**
          * Constructor
          * Initialize all informations for installing/uninstalling plugin
          */
        public function __construct(){
                parent::__construct();
                $this->add_data(array (
                        'name'              => 'Abbreviations',
                        'code'              => 'abbreviations',
                        'path'              => 'abbreviations',
                        'template_path'     => 'plugins/abbreviations/templates/',
                        'icon'              => 'fa fa-list-alt',
                        'version'           => $this->version,
                        'author'            => $this->copyright,
                        'description'       => 'Replace me!',
                        'long_description'  => 'Should be replaced by variables',
                        'homepage'          => 'https://eqdkp-plus.eu/',
                        'plus_version'      => '2.0',
                        'build'             => $this->build,
                ));
                $this->add_dependency(array(
                        'plus_version'      => '2.0'
                ));
        }
}

?>
