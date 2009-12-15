<?php

require_once( JPATH_COMPONENT.DS.'views'.DS.'project'.DS.'view.html.php' );
class Controller_Settings extends JhprojectController
{
	function index()
	{ 
		
		$model = $this->loadModel('JhProjectBugtrackSettings');
		$rows = $model->fetchAll();
		$data = array();
		foreach($rows as $row)
		{
			$data['settings'][$row->setting_name] = $row->setting_value;
		}
		$data['pagetitle'] = 'Edit Settings';
		Viewproject::display('settingsform',$data);
	}
	
	function save()
	{
		$data = $_POST['setting_name'];
		$model = $this->loadModel('JhProjectBugtrackSettings');
		foreach($data as $skey=>$svalue)
		{
			$model->updatebyname($skey,$svalue);
		}
		$this->setRedirect('index.php?option=com_jhproject&controller=settings', JText::_('Settings Updated'));
		
		
	}
	
	function listoptions()
	{
		$this->generateProjectArray();
		$model = $this->loadModel('JhProjectBugtrackOptions');
		$where = null;
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		
		$options = $model->fetchAll($where, 'bugcat asc, `ordering` asc',$limit,$limitStart);
		$data = array();
		$data['options'] = $options;
		$data['pagetitle'] = 'Options List';
		$data['types'] = $model->getTypes();
		print_r($data['types']);
		Viewproject::display('optionslist',$data);
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
