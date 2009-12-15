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

class JhProjectWikiEntries extends Jhtable
{
	/** set our table name and defaults **/
	var $_tbl = '#__jhproject_wiki_entries';
	var $_tbl_key = 'id';
	
	/** set our table columns **/
	
	var $id;
	var $project_id = 0;
	var $title;
	var $content;
	var $access;
	var $modified;
	var $user_id;
	var $ip;
	var $revision = 0;
	var $accessed;
	
	function findByTitle($page = '',$project_id = 0)
	{
		if($project_id > 0) $this->project_id = $project_id;
		
		if($page == '') return false;
		
		$db =& $this->getDBO();
		$db->setQuery("Select * from {$this->_tbl} where title like'{$page}' and project_id = '{$this->project_id}'");
		$result = $db->loadObject();
		if($result)
			$this->bind($result);
		
	}
}
?>