<?php
/**
* @version		$Id: article.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JElementProject extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Project';
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		global $mainframe;
		
		$db			=& JFactory::getDBO();
		$doc 		=& JFactory::getDocument();
		$template 	= $mainframe->getTemplate();
		$fieldName	= $control_name.'['.$name.']';
		require_once(JPATH_ADMINISTRATOR .DS . 'components'.DS.'com_jhproject'.DS.'models'.DS.'JhProject.php');
		$project_model = new JhProject();
		
		$projects = $project_model->fetchAll();
		$plist = array();
		$plist[0] = JText::_("Select");
		foreach($projects as $project)
		{
			$plist[$project->id] = $project->name;
		}
		
		$html = '<Select id="'.$name.'_id" name="'.$fieldName.'">';
		foreach($plist as $k=>$v)
		{
			$selected = ($value == $k)?'Selected':'';
			$html .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
		}
		$html .= '</select>';
		return $html;
   }
	}
	