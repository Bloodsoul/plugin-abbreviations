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

if (!defined('EQDKP_INC'))
{
        header('HTTP/1.0 404 Not Found');exit;
}

$abbreviationsSQL = array(
        'uninstall' => array(
                1 => 'DROP TABLE IF EXISTS `__abbreviations_mappings`',
        ),
        'install'   => array(
                1 => "CREATE TABLE `__abbreviations_mappings` (
                        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                        `abbreviation` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_bin',
                        `full_text` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_bin',
                        PRIMARY KEY (`id`)
                ) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
                ",
        )
);

?>
