<?php
/*
* Project:		EQdkp-Plus
* License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
* Link:			http://creativecommons.org/licenses/by-nc-sa/3.0/
* -----------------------------------------------------------------------
* Began:		2010
* Date:			$Date: 2013-01-29 17:35:08 +0100 (Di, 29 Jan 2013) $
* -----------------------------------------------------------------------
* @author		$Author: wallenium $
* @copyright	2006-2014 EQdkp-Plus Developer Team
* @link			http://eqdkp-plus.eu
* @package		eqdkpplus
* @version		$Rev: 12937 $
*
* $Id: pdh_r_articles.class.php 12937 2013-01-29 16:35:08Z wallenium $
*/
if ( !defined('EQDKP_INC') ){
	die('Do not access this file directly.');
}
				
if ( !class_exists( "pdh_r_abbreviations_mappings" ) ) {
	class pdh_r_abbreviations_mappings extends pdh_r_generic{
		public static function __shortcuts() {
		$shortcuts = array();
		return array_merge(parent::$shortcuts, $shortcuts);
	}				
	
	public $default_lang = 'english';
	public $abbreviations_mappings = null;
	public $hooks = array(
		'abbreviations_mappings_update',
	);		
			
	public $presets = array(
		'abbreviations_mappings_id' => array('id', array('%abbreviationId%'), array()),
		'abbreviations_mappings_abbreviation' => array('abbreviation', array('%abbreviationId%'), array()),
		'abbreviations_mappings_full_text' => array('full_text', array('%abbreviationId%'), array()),
	);
				
	public function reset(){
			$this->pdc->del('pdh_abbreviations_mappings_table');
			
			$this->abbreviations_mappings = NULL;
	}
					
	public function init(){
			$this->abbreviations_mappings	= $this->pdc->get('pdh_abbreviations_mappings_table');				
					
			if($this->abbreviations_mappings !== NULL){
				return true;
			}		
			$objQuery = $this->db->query('SELECT * FROM __abbreviations_mappings');
			if($objQuery){
				while($drow = $objQuery->fetchAssoc()){
					//TODO: Check if id Column is available
					$this->abbreviations_mappings[(int)$drow['id']] = array(
						'id'			=> (int)$drow['id'],
						'abbreviation'			=> $drow['abbreviation'],
						'full_text'			=> $drow['full_text'],

					);
				}
				
				$this->pdc->put('pdh_abbreviations_mappings_table', $this->abbreviations_mappings, null);
			}
		}	//end init function
		/**
		 * @return multitype: List of all IDs
		 */				
		public function get_id_list(){
			if ($this->abbreviations_mappings === null) return array();
			return array_keys($this->abbreviations_mappings);
		}
		
		/**
		 * Get all data of Element with $strID
		 * @return multitype: Array with all data
		 */				
		public function get_data($abbreviationId){
			if (isset($this->abbreviations_mappings[$abbreviationId])){
				return $this->abbreviations_mappings[$abbreviationId];
			}
			return false;
		}
				
		/**
		 * Returns id for $abbreviationId				
		 * @param integer $abbreviationId
		 * @return multitype id
		 */
		 public function get_id($abbreviationId){
			if (isset($this->abbreviations_mappings[$abbreviationId])){
				return $this->abbreviations_mappings[$abbreviationId]['id'];
			}
			return false;
		}

		/**
		 * Returns abbreviation for $abbreviationId				
		 * @param integer $abbreviationId
		 * @return multitype abbreviation
		 */
		 public function get_abbreviation($abbreviationId){
			if (isset($this->abbreviations_mappings[$abbreviationId])){
				return $this->abbreviations_mappings[$abbreviationId]['abbreviation'];
			}
			return false;
		}

		/**
		 * Returns full_text for $abbreviationId				
		 * @param integer $abbreviationId
		 * @return multitype full_text
		 */
		 public function get_full_text($abbreviationId){
			if (isset($this->abbreviations_mappings[$abbreviationId])){
				return $this->abbreviations_mappings[$abbreviationId]['full_text'];
			}
			return false;
		}

	}//end class
}//end if
?>