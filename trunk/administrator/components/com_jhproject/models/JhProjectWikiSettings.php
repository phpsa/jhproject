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

class JhProjectWikiSettings extends Jhtable
{
	/** set our table name and defaults **/
	var $_tbl = '#__jhproject_wiki_settings';
	var $_tbl_key = 'id';
	
	/** set our table columns **/
	
	var $id;
	var $name;
	var $value;
	var $default;
	var $description;

	
		
}
?>