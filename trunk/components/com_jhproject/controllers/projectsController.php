<?php

require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'view.html.php');
Class JhController_Projects extends JhprojectController
{
	function index()
	{
		$project_id =  JRequest::getVar('pid');
		$data['project_id'] = $project_id;
		$project = $this->loadModel('JhProject');
		$project->load($project_id);
		$data['project'] = $project;
		$versions = $this->loadModel('JhProjectVersion');
		$data['versions'] = $versions->fetchAll("project_id = '$project_id' and published = '1'","id desc");
		//print_r($data);
		JhProjectViewProjects::display('project',$data);
	}
	function view()
	{
		$this->index();
	}
	
	function feed()
	{
		JRequest::setVar('tmpl', 'component' );
		$project_id =  JRequest::getVar('pid',0);
		$project = $this->loadModel('JhProject');
		$versions = $this->loadModel('JhProjectVersion');
		if($project_id != 0)
		{
			$project->load($project_id);
			$projectset = array($project->id => $project);
			$versionArray = $versions->fetchAll("project_id = '$project_id' and published = '1'","release_date desc, id desc");
		}else{
			$projects = $project->fetchAll("published = '1'");
			$ids = array();
			$projectset = array();
			foreach($projects as $project)
			{
				$ids[] = $project->id;
				$projectset[$project->id] = $project;
			}
			$versionArray = $versions->fetchAll("project_id in (" . implode(",", $ids) . ") and published = '1'","release_date desc, id desc");
			
		}
		$c = new JConfig();
		$sitename = $c->sitename;
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
		<rss xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" version="2.0">
		<channel>
		<title>'.$sitename.'</title>
		<description />
		<link>'.JURI::base().'</link>
		<lastBuildDate>'.DATE("r").'</lastBuildDate>
		<generator>JHProject</generator>
		';
		$versionArray = array_slice($versionArray, 0, 10);
// 		print_r($versionArray);
	//	print_r($projectset);
	
		foreach($versionArray as $version)
		{
			$xml .= '
			<item>
				<title>' . $projectset[$version->project_id]->name . ': ' . $version->release_name . ' ' . $version->release_version . '</title>
				<link>' . JURI::base() . JRoute::_('index.php?option=com_jhproject&task=view&pid=' . $version->project_id) . '</link>
				<description>' . htmlentities($version->changelog) . '</description>
				<author>' . $projectset[$version->project_id]->developer_name . '</author>
				<pubDate>' . date("r", strtotime($version->release_date)) . '</pubDate>
				<guid isPermaLink="false">'.substr(JURI::base(),0,-1) . JRoute::_('index.php?option=com_jhproject&task=view&pid=' . $version->project_id) . '</guid>
				<feedburner:origLink>'.substr(JURI::base(),0,-1)  . JRoute::_('index.php?option=com_jhproject&task=view&pid=' . $version->project_id) .'</feedburner:origLink>
			</item>';
		}
		$xml .= '</channel>
		</rss>';
		$mainframe = & JFactory::getApplication();
		echo $xml;
		$mainframe->close();
// 		echo $xml;
			//print_r($project);
	}
	
	function changelog()
	{
		//print_r($_REQUEST);
		JRequest::setVar('tmpl', 'component' );
		$project_id =  JRequest::getVar('pid');
		$version_id =  JRequest::getVar('vid');
		$project = $this->loadModel('JhProject');
		$version = $this->loadModel('JhProjectVersion');
		$project->load($project_id);
		$version->load($version_id);
		$data = array('project'=>$project,'version'=>$version);
		JhProjectViewProjects::display('changelog',$data);
		//echo 'Changelog to go here';
	}
}
