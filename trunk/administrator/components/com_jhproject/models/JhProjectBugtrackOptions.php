<?php
/**
 * Joomla! 1.5 component jhproject
 *
 * @version $Id: jhproject.php 2009-12-06 11:08:51 svn $
 * @author JHSA
 * @package Joomla
 * @subpackage jhproject
 * @license GNU/GPL
 *
 * Project Management system for Joomla
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once('JhTable.php');

class JhProjectBugtrackOptions extends Jhtable
{
	/** set our table name and defaults **/
	var $_tbl = '#__jhproject_bugtrack_options';
	var $_tbl_key = 'id';
	
	/** set our table columns **/
	
	var $id;
	var $project_id;
	var $bugcat;
	var $type;
	var $ordering;
	
		
	function getLists($id = 0)
	{
		$id = (int)$id;
		$where = null;
		if($id > 0)
			$where = "(project_id = $id or project_id = 0)";
		$options = $this->fetchAll($where,'`ordering` asc, bugcat asc');
		$return = array();
		foreach($options as $option)
		{
			$return[$option->type][$option->id] = $option->bugcat;
		}
		
		return $return;
	}
	
	function getTypes()
	{
		$q = "select distinct type from `{$this->_tbl}`";
		$this->_db->setQuery($q);
		$data = $this->_db->loadAssocList('type');
		return array_keys($data);
	}
}
?>