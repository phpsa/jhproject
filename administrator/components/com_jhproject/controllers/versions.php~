<?php

require_once( JPATH_COMPONENT.DS.'views'.DS.'project'.DS.'view.html.php' );
class Controller_Versions extends JhprojectController
{
	function index()
	{
		
		$this->generateProjectArray();
		$version_model = $this->loadModel('JhProjectVersion');
		$this->jhdata['selectedproject'] = JRequest::getCmd('selectedproject',0);
		$where = '';
		if((int)$this->jhdata['selectedproject'] > 0)
		{
			$where = "project_id = '".(int)$this->jhdata['selectedproject']."' ";
		}
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		$this->jhdata['vlist'] = $version_model->fetchAll($where,null,$limit,$limitStart);
		
		$this->jhdata['pagetitle'] = JText::_('Versions List');
		
		Viewproject::display('versionlist',$this->jhdata);
	}
	
	function add()
	{
		$this->generateProjectArray();
		$model = $this->loadModel('JhProjectVersion');
		$this->jhdata['pagetitle'] = JText::_('Add Project Version');
		$this->jhdata['version'] = $model;
		Viewproject::display('versionform',$this->jhdata);
	}
	
	function edit()
	{
		$id = $_REQUEST['cid'];
		if(is_array($id)) $id = $id[0];
		$this->generateProjectArray();
		$model = $this->loadModel('JhProjectVersion');
		$this->jhdata['pagetitle'] = JText::_('Edit Project Version');
		$data = $model->load($id);
		$this->jhdata['version'] = $model;
		Viewproject::display('versionform',$this->jhdata);
	}
	
	function save()
	{
		$model = $this->loadModel('JhProjectVersion');
		$model->save($_POST);
		$this->setRedirect('index.php?option=com_jhproject&controller=versions', JText::_('Versions Updated'));
	}
	
	function publish()
	{
		$model = $this->loadModel('JhProjectVersion');
		$model->publish($_POST['cid']);
		$this->index();
	}
	
	function unpublish()
	{
		$model = $this->loadModel('JhProjectVersion');
		$model->publish($_POST['cid'],0);
		$this->index();
	}
	
	function remove()
	{
		$model = $this->loadModel('JhProjectVersion');
		$model->deleteList($_POST['cid']);
		$this->setRedirect('index.php?option=com_jhproject&controller=versions', JText::_('Projects Deleted'));
	}
	
	function generateProjectArray()
	{
		$project_model = $this->loadModel('JhProject');
		$projects = $project_model->fetchAll();
		$plist = array();
		$plist[0] = JText::_("Select");
		foreach($projects as $project)
		{
			$plist[$project->id] = $project->name;
		}
		$this->jhdata['plist'] = $plist;
	}
}

?>