<?php
/**
* Joomla! 1.5 component jhproject
*
* @version $Id: controller.php 2009-12-06 11:08:51 svn $
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

/**
* jhproject Controller_project
*
* @package Joomla
* @subpackage jhproject
*/
require_once( JPATH_COMPONENT.DS.'views'.DS.'project'.DS.'view.html.php' );
// require_once( JPATH_COMPONENT.DS.'tables'.DS.'project'.DS.'view.html.php' );
class Controller_Project extends JhprojectController 
{
	
	function index()
	{
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		$model = $this->loadModel('JhProject');
		$this->jhdata['list'] = $model->fetchAll(null,null,$limit,$limitStart);
		$this->jhdata['pagetitle'] = JText::_('Project List');
		Viewproject::display('projectlist',$this->jhdata);
	}
	
	function edit()
	{
		$id = $_REQUEST['cid'];
		if(is_array($id)) $id = $id[0];
		$model = $this->loadModel('JhProject');
		$model->load($id);
		$this->jhdata['pagetitle'] = JText::_('Edit Project');
		$this->jhdata['project'] = $model;
		Viewproject::display('projectform',$this->jhdata);
	}
	
	function add()
	{
		$model = $this->loadModel('JhProject');
		$this->jhdata['pagetitle'] = JText::_('Add Project');
		$this->jhdata['project'] = $model;
		Viewproject::display('projectform',$this->jhdata);
	}
	
	function remove()
	{
		$model = $this->loadModel('JhProject');
		$model->deleteList($_POST['cid']);
		$this->setRedirect('index.php?option=com_jhproject', JText::_('Projects Deleted'));
	}
	
	function publish()
	{
		$model = $this->loadModel('JhProject');
		$model->publish($_POST['cid']);
		$this->index();
	}
	
	function unpublish()
	{
		$model = $this->loadModel('JhProject');
		$model->publish($_POST['cid'],0);
		$this->index();
	}
	
	function save()
	{
		$model = $this->loadModel('JhProject');
		$model->save($_POST);
		$this->setRedirect('index.php?option=com_jhproject', JText::_('Projects Updated'));
	}
}
