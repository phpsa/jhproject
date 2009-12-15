<?php

require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'view.html.php');
Class JhController_Wiki extends JhprojectController
{
	function index()
	{
		$data = array();
		
		$wiki = $this->loadModel('JhProjectWikiEntries');	
		
		$page = JRequest::getVar('page');
		if($page == '') $page = 'Main_Page';
		$data['page'] = $page;
		
		$project = JRequest::getVar('project',0);
		$data['project'] = $project;
		$projecturl = false;
		if($project > 0)
		{
			$pj = $this->loadModel('JhProject');
			$pj->load($project);
			$projecturl = '<a href="'.JRoute::_('index.php?option=com_jhproject&view=projects&pid='.$project) . '">'.$pj->name.'</a>';
			
		}
		$data['projecturl'] = $projecturl;
			
		
		$user = & JFactory::getUser();
		$data['user'] = $user;
		
		
		$wiki->findByTitle($page,$project);
		$data['entry'] = $wiki;
		$wiki->content = stripslashes($wiki->content);
		$username = false;
		if($wiki->user_id > 0)
		{
			$db =& $wiki->getDBO();
			$db->setQuery("Select username from #__users where id = {$wiki->user_id}");
			$username = $db->loadResult();
		}
		$data['username'] = $username;
		$data['revision'] = false;
		if($data['entry']->id > 0)
		{
			JhProjectViewProjects::display('wikientry',$data);
			
		}else{
			$data['entry']->title = $page;
			JhProjectViewProjects::display('wikieditentry',$data);
			//echo 'Not Found lets create the page';
		}
		
	}
	
	
	function edit()
	{
		$data = array();
		
		$wiki = $this->loadModel('JhProjectWikiEntries');	
		
		$page = JRequest::getVar('page');
		if($page == '') $page = 'Main_Page';
		$data['page'] = $page;
		
		$project = JRequest::getVar('project',0);
		$data['project'] = $project;
		
		$user = & JFactory::getUser();
		$data['user'] = $user;
		
		
		$wiki->findByTitle($page,$project);
		$wiki->content = stripslashes($wiki->content);
		$data['entry'] = $wiki;
		
		$username = false;
		if($wiki->user_id > 0)
		{
			$db =& $wiki->getDBO();
			$db->setQuery("Select username from #__users where id = {$wiki->user_id}");
			$username = $db->loadResult();
		}
		$data['username'] = $username;
		
			$data['entry']->title = $page;
			JhProjectViewProjects::display('wikieditentry',$data);
			//echo 'Not Found lets create the page';
		
	}
	
	function revisions()
	{
			$project = JRequest::getVar("project",'0');
			$data['project'] = $project;
			$page = JRequest::getVar("page");
			$revisions = $this->loadModel('JhProjectWikiEntryRevisions');
			//print_r($revisions);
			$rev = $revisions->fetchAll("project_id = $project AND title='$page'",'revision desc');
			//print_r($rev);
			if(!count($rev) || !is_array($rev))
			{
				$this->setRedirect("index.php?option=com_jhwiki&task=wiki&project=$project&page=$page",JText::_("No Revisions Found"));
			}else{
				$data['rows'] = $rev;
				JhProjectViewProjects::display('wikirevisions',$data);
			}
	}
	
	function viewRevisions()
	{
		$data = array();
		
		$wiki = $this->loadModel('JhProjectWikiEntryRevisions');	
		$id = JRequest::getVar('id');
		$wiki->load($id);
		$page = $wiki->title;
		$data['page'] = $page;
		$data['project'] = $wiki->project_id;
		$project = $wiki->project_id;
		$projecturl = false;
		if($data['project'] > 0)
		{
			$pj = $this->loadModel('JhProject');
			$pj->load($project);
			$projecturl = '<a href="'.JRoute::_('index.php?option=com_jhproject&view=projects&pid='.$data['project']) . '">'.$pj->name.'</a>';
			
		}
		$data['projecturl'] = $projecturl;
		
		$user = & JFactory::getUser();
		$data['user'] = $user;
		$data['entry'] = $wiki;
		$wiki->content = stripslashes($wiki->content);
		$username = false;
		if($wiki->user_id > 0)
		{
			$db =& $this->getDBO();
			$db->setQuery("Select username from #__users where id = {$wiki->user_id}");
			$username = $db->loadResult();
		}
		$data['username'] = $username;
		$data['revision'] = true;
		
		if($data['entry']->id > 0)
		{
			JhProjectViewProjects::display('wikientry',$data);
			
		}else{
			$data['entry']->title = $page;
			JhProjectViewProjects::display('wikieditentry',$data);
			//echo 'Not Found lets create the page';
		}
		
	}
	
	function editRevision()
	{
		$data = array();
		
		$wiki = $this->loadModel('JhProjectWikiEntries');	
		$revs = $this->loadModel('JhProjectWikiEntryRevisions');
		
		$id = JRequest::getVar('id');
		$revs->load($id);
		$data['page'] = $revs->title;
		
		$project = $revs->project_id;
		$data['project'] = $project;
		
		$user = & JFactory::getUser();
		$data['user'] = $user;
		
		
		$wiki->findByTitle($revs->title,$project);
		$wiki->content = stripslashes($revs->content);
		$data['entry'] = $wiki;
		
		$username = false;
		if($wiki->user_id > 0)
		{
			$db =& $wiki->getDBO();
			$db->setQuery("Select username from #__users where id = {$wiki->user_id}");
			$username = $db->loadResult();
		}
		$data['username'] = $username;
		
		$data['entry']->title = $revs->title;
		JhProjectViewProjects::display('wikieditentry',$data);
	}
	
	function save()
	{
		$project = JRequest::getVar("project",0);
		$content = htmlentities(stripslashes($_POST["content"]));
		$id = JRequest::getVar("id");
		$title = JRequest::getVar("title");
		$user = & JFactory::getUser();
		
		$wiki = $this->loadModel('JhProjectWikiEntries');	
		$wiki->load($id);	
		$revisions = $this->loadModel('JhProjectWikiEntryRevisions');
		if($wiki->id > 0)
		{
			$revisions->bind($wiki);
			$revisions->id = 0;
			$revisions->store();
			
		}
		
		$wiki->revision++;
		$wiki->content = addslashes($content);
		$wiki->project_id = $project;
		$wiki->title = $title;
		$wiki->user_id = $user->id;
		$wiki->ip = $_SERVER['REMOTE_ADDR'];
		
		$id = $wiki->store($wiki);
		
		$this->setRedirect('index.php?option=com_jhproject&view=wiki&project='.$wiki->project_id.'&page='.$title, JText::_('Page Updated'));
	}
	
}
