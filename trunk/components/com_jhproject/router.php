<?php
/**
 * Joomla! 1.5 component jhproject
 *
 * @version $Id: router.php 2009-12-06 11:08:51 svn $
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

/*
 * Function to convert a system URL to a SEF URL
 */

function JhprojectBuildRoute(&$query) {
   //print_r($query);
	$segments = array();
	
	//view
	//task
	
	//based on view
	//page (wiki)
	//project (projects)
	
	//url options:
	/*
	index.php?option=com_jhproject (::view:list, ::task::index):
	index.php?option=com_jhproject&view=wiki (::task::index, ::page:main_page, ::project:0):
	index.php?option=com_jhproject&view=projects&pid=1 (::task:index)
	
	common purposed links:::
		view has a default value!!!
		last should be task(for default)
		
	*/
	
	if(!isset($query['view']))
	{
		$query['view'] = 'list';
	}
	$v = $query['view'];
	$segments[] = $query['view'];
	unset($query['view']);
	
	if($v == 'list')
	{
		//Nothing here for us!
	}
	elseif($v == 'wiki')
	{
		//wiki has :page, project, task!
		if(!isset($query['project']))
			$query['project'] = 0;
		$segments[] = $query['project'];
		if(!isset($query['page']))
			$query['page'] = 'Main_Page';
		$segments[] = $query['page'];
		if(isset($query['task']))
			$segments[] = $query['task'];
		
		unset($query['project'],$query['page'],$query['task']);
	}
	elseif($v == 'projects')
	{
		if(!isset($query['pid']))
			$query['pid'] = 0;
		   if($query['pid'] > 0)
		   {
			$db		=& JFactory::getDBO();
			$db->setQuery("Select name from #__jhproject where id='".$query['pid']."'");
			$segments[] = $query['pid'] .'-' . preg_replace('/[^a-z0-9]/i', '', $db->loadResult());
		   }else{
			   $segments[] = $query['pid'];
		   }
		    unset($query['pid']);
			if(isset($query['task']))
			{
				$segments[] = $query['task'];
				unset($query['task']);
			}
	}
	elseif($v == 'bugs')
	{
		//if(!isset($query['pid'])) $query['pid'] = 0;
		if(isset($query['pid']) && $query['pid'] > 0)
		{
			$db		=& JFactory::getDBO();
			$db->setQuery("Select name from #__jhproject where id='".$query['pid']."'");
			$segments[] = $query['pid'] .'-' . preg_replace('/[^a-z0-9]/i', '', $db->loadResult());
		}else{
			return $segments;
		}
		unset($query['pid']);
		if(isset($query['task']))
		{
			$segments[] = $query['task'];
			unset($query['task']);
		}
		
	}
	
	return $segments;
}
/*
 * Function to convert a SEF URL back to a system URL
 */
function JhprojectParseRoute($segments) {

		$vars = array();
		$count = count($segments);
		$v = 'list';
		if(!empty($count))
		{
			$vars['view'] = $segments[0];
			$v = $segments[0];
			unset($segments[0]);
		}
		if($v == 'list')
		{
			//nothing to do here
		} elseif($v == 'wiki')
		{
			if(isset($segments[1]))
			{
				$vars['project'] = $segments[1];
				unset($segments[1]);
				if(isset($segments[2]))
				{
					$vars['page'] = $segments[2];
					unset($segments[2]);
					if(isset($segments[3]))
					{
						$vars['task'] = $segments[3];
						unset($segments[3]);
					}
				}
			}
				
			
			
		} elseif($v == 'projects')
		{
			if(isset($segments[1]))
			{
				$pid = explode("-",$segments[1]);
				$vars['pid'] = $pid[0];
				unset($segments[1]);
			}
			if(isset($segments[2]))
			{
				$vars['task'] = $segments[2];
				unset($segments[2]);
			}
				
			//default task = index
			//pid must be set
			//optional vid, task
			
		}elseif($v == 'bugs')
		{
			if(isset($segments[1]))
			{
				$pid = explode("-",$segments[1]);
				$vars['pid'] = $pid[0];
				unset($segments[1]);
			}
			if(isset($segments[2]))
			{
				$vars['task'] = $segments[2];
				unset($segments[2]);
			}
		}

	   return $vars;
}

?>