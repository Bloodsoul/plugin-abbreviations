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

define('EQDKP_INC', true);
define('IN_ADMIN', true);
$eqdkp_root_path = './../../../';
include_once($eqdkp_root_path . 'common.php');

class Manage_Abbreviations extends page_generic {
        public function __construct(){
                // plugin installed?
                if (!$this->pm->check('abbreviations', PLUGIN_INSTALLED))
                        message_die($this->user->lang('abbreviations_plugin_not_installed'));

                $this->user->check_auth('a_abbreviations_manage');

                $handler = array(
                        'save'          => array('process' => 'save', 'csrf' => true),
                        'update'        => array('process' => 'update', 'csrf' => true),
                        'cid'           => array('process' => 'edit'),

                );
                parent::__construct(false, $handler, array('abbreviations', 'name'), null, 'selected_ids[]');
                $this->process();
        }

        /**
          * Display
          * display abbreviations
          */
        public function display() {
                $this->tpl->add_js("
                        $(\"#article_categories-table tbody\").sortable({
                                cancel: '.not-sortable, input, tr th.footer, th',
                                cursor: 'pointer',
                        });
                ", "docready");

                $view_list = $this->pdh->get('abbreviations_mappings', 'id_list', array());
                $hptt_page_settings = array(
                        'name'                          => 'hptt_abbreviations_admin_manage_abbreviations',
                        'table_main_sub'                => '%abbreviationId%',
                        'table_subs'                    => array('%abbreviationId%', '%link_url%', '%link_url_suffix%'),
                        'page_ref'                      => 'manage_abbreviations.php',
                        'show_numbers'                  => false,
                        'show_select_boxes'             => true,
                        'selectboxes_checkall'  => true,
                        'show_detail_twink'             => false,
                        'table_sort_dir'                => 'asc',
                        'table_sort_col'                => 0,
                        'table_presets'                 => array(
                                array('name' => 'abbreviations_sort_id', 'sort' => true, 'th_add' => 'width="20"', 'td_add' => ''),
                                array('name' => 'abbreviations_abbreviation', 'sort' => true, 'th_add' => '', 'td_add' => ''),
                                array('name' => 'abbreviations_full_text',  'sort' => true, 'th_add' => 'width="20"', 'td_add' => 'style="text-align:right"'),
                        ),
                );
                $hptt = $this->get_hptt($hptt_page_settings, $view_list, $view_list, array('%link_url%' => $this->root_path.'plugins/abbreviations/admin/manage_abbreviations.php', '%link_url_suffix%' => ''));
                $page_suffix = '&amp;start='.$this->in->get('start', 0);
                $sort_suffix = '?sort='.$this->in->get('sort');

                $item_count = count($view_list);

                $this->tpl->assign_vars(array(
                        'HPTT_COLUMN_COUNT'     => $hptt->get_column_count()
                ));

                // -- EQDKP ---------------------------------------------------------------
                $this->core->set_vars(array(
                        'page_title'            => $this->user->lang('abbreviations_manage_abbreviations'),
                        'template_path'         => $this->pm->get_data('abbreviations', 'template_path'),
                        'template_file'         => 'admin/manage_abbreviations.html',
                        'display'                       => true
                ));
        }

}

registry::register('Manage_Abbreviations');

?>
