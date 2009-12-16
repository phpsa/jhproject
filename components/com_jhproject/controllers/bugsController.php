<?php

require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'view.html.php');
Class JhController_Bugs extends JhprojectController
{
	function index()
	{
		//echo 'Bug Controller to be here soon';
		$data = array();
		
		$bugs = $this->loadModel('JhProjectBugtrack');
		$fields = $this->loadModel('JhProjectBugtrackOptions');
		$project_id = (int)JRequest::getVar('pid',0);
		$where = "project_id = $project_id";
		
		
		$bug_cat_id = JRequest::getVar('bug_cat_id','0');
		$data['bug_cat_id'] = $bug_cat_id;
		if($bug_cat_id > 0)
			$where .= " AND bug_cat_id = '".(int)$bug_cat_id . "'";
		
		$bug_priority_id = JRequest::getVar('bug_priority_id','0');
		$data['bug_priority_id'] = $bug_priority_id;
		if($bug_priority_id > 0)
			$where .= " AND bug_priority_id = '$bug_priority_id'";
		
		$bug_status_id = JRequest::getVar('bug_status_id','0');
		$data['bug_status_id'] = $bug_status_id;
		if($bug_status_id > 0)
			$where .= " AND bug_status_id = '$bug_status_id'";
		
		$bug_version_id = JRequest::getVar('bug_version_id','0');
		$data['bug_version_id'] = $bug_version_id;
		if($bug_version_id > 0)
			$where .= " AND bug_version_id = '$bug_version_id'";
		
		
		if($project_id == 0)
		{
			$mainframe = & JFactory::getApplication();
			$mainframe->redirect(JRoute::_("index.php?option=com_jhproject"));
		}
		$data['options'] = $fields->getLists($project_id);
		//$data['options']['status'][0] = JText::_('Unconfirmed');
		
		
		//print_r($options);
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		$ordering = str_replace(":", " ", JRequest::getVar('ordering', 'bug_id:desc'));
		$data['buglist'] = $bugs->fetchAll($where,$ordering,$limit,$limitStart);
		$project = $this->loadModel('JhProject');
		$project->load($project_id);
		$data['project'] = $project;
		$versions = $this->loadModel('JhProjectVersion');
		$vlist = $versions->fetchAll("published = 1 and project_id = $project_id");
		
		//print_r($vlist);
		$data['versions'] = array();
		if(is_array($vlist))
		{
			foreach($vlist as $ver)
			{
				$data['versions'][$ver->id] = $ver->release_version;
			}
		}
		//print_r($data);
		JhProjectViewProjects::display('buglist',$data);
	}
	
	function addbug()
	{
		$project_id = (int)JRequest::getVar('pid',0);
		$bug_id = (int)JRequest::getVar('bid',0);
		$user = & JFactory::getUser();
		if($user->id < 1)
		{
			$mainframe = & JFactory::getApplication();
			$mainframe->redirect(JRoute::_('index.php?option=com_jhproject&view=bugs&pid='.$project_id),JText::_('Please login to post a bug / feature request'));
		}
		
		$data = array();
		$bugs = $this->loadModel('JhProjectBugtrack');
		$bugs->load($bug_id);
		$data['bug'] = $bugs;
		$fields = $this->loadModel('JhProjectBugtrackOptions');
		
		$project = $this->loadModel('JhProject');
		$project->load($project_id);
		$data['project'] = $project;
		
		$versions = $this->loadModel('JhProjectVersion');
		$vlist = $versions->fetchAll("published = 1 and project_id = $project_id");
		$data['options'] = $fields->getLists($project_id);
		//print_r($vlist);
		$data['versions'] = array();
		if(is_array($vlist))
		{
			foreach($vlist as $ver)
			{
				$data['versions'][$ver->id] = $ver->release_version;
			}
		}
		
// 		echo '<pre>';
// 		print_r($data);
// 		echo '</pre>';
		//die();
		//Need options etc to generate the form
		JhProjectViewProjects::display('bugform',$data);
	}
	
	function savebug()
	{
		$bugs = $this->loadModel('JhProjectBugtrack');
		$bugs->bind($_POST);
		$bugs->project_id = (int)JRequest::getVar('pid');
		if(!$_POST['reported_by'] && $bugs->bug_id < 1)
		{
			$user = & JFactory::getUser();
			$bugs->reported_by = $user->id;
			$bugs->date_added = DATE("Y-m-d H:i:s");
		}else{
			$bugs->date_closed = DATE("Y-m-d H:i:s");
		}
		$bugs->store();
		
		$this->setRedirect(JRoute::_('index.php?option=com_jhproject&view=bugs&pid='.$bugs->project_id),JText::_('Submission Successful'));
	}
	
	function view()
	{
		$bugs = $this->loadModel('JhProjectBugtrack');
		$project_id = (int)JRequest::getVar('pid');
		$bid = JRequest::getVar('bid');
		$bugs->load($bid);
		$project = $this->loadModel('JhProject');
		$project->load($project_id);
		$data = array();
		$data['bugs'] = $bugs;
		$data['project'] = $project;
		$fields = $this->loadModel('JhProjectBugtrackOptions');
		$versions = $this->loadModel('JhProjectVersion');
		$vlist = $versions->fetchAll("published = 1 and project_id = $project_id");
		$data['options'] = $fields->getLists($project_id);
		//print_r($vlist);
		$data['versions'] = array();
		if(is_array($vlist))
		{
			foreach($vlist as $ver)
			{
				$data['versions'][$ver->id] = $ver->release_version;
			}
		}
		
		JhProjectViewProjects::display('bugview',$data);
	}
	
	function editbug()
	{
		$project_id = (int)JRequest::getVar('pid',0);
		$bug_id = (int)JRequest::getVar('bid',0);
		$user = & JFactory::getUser();
		//also now need to make sure is a Joomla admin/special user for this version!!!
		$gid = $user->get('aid',0);
		if($user->id < 1 || $gid < 2)
		{
			$mainframe = & JFactory::getApplication();
			$mainframe->redirect(JRoute::_('index.php?option=com_jhproject&view=bugs&pid='.$project_id),JText::_('Insufficient premissions to edit a bug / feature request'));
		}
		
		$data = array();
		$bugs = $this->loadModel('JhProjectBugtrack');
		$bugs->load($bug_id);
		$data['bug'] = $bugs;
		$fields = $this->loadModel('JhProjectBugtrackOptions');
		
		$project = $this->loadModel('JhProject');
		$project->load($project_id);
		$data['project'] = $project;
		
		$versions = $this->loadModel('JhProjectVersion');
		$vlist = $versions->fetchAll("published = 1 and project_id = $project_id");
		$data['options'] = $fields->getLists($project_id);
		//print_r($vlist);
		$data['versions'] = array();
		if(is_array($vlist))
		{
			foreach($vlist as $ver)
			{
				$data['versions'][$ver->id] = $ver->release_version;
			}
		}
		
		
		//need a users list::
		$usertable = $user->getTable();
		$usertbl = $usertable->getTableName();
		//echo $usertbl;
		$db =& $usertable->getDBO();
		$db->setQuery("select `id`,`username` from `{$usertbl}` where block = '0' order by `username` asc");
		$result = $db->loadAssocList();
		$users = array();
		foreach($result as $res)
		$users[$res['id']] = $res['username'];
		
		$data['users'] = $users;
// 		print_r($usertable);
		
		// 		echo '<pre>';
		// 		print_r($data);
		// 		echo '</pre>';
		//die();
		//Need options etc to generate the form
		JhProjectViewProjects::display('bugformedit',$data);
	}
	
}
