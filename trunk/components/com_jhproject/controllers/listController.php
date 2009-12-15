<?php
require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'view.html.php');
Class JhController_List extends JhprojectController
{
	function index()
	{
		$project = $this->loadModel('JhProject');
		$versions = $this->loadModel('JhProjectVersion');
		//TODO ADD PAGINATION!!!
		$projects = $project->fetchAll("published = '1'","name asc");
		$ids = array();
		$projectset = array();
		foreach($projects as $project)
		{
			$ids[] = $project->id;
			$projectset[$project->id] = $project;
		}
		$versionArray = $versions->fetchAll("project_id in (" . implode(",", $ids) . ") and published = '1' group by project_id","release_date desc, id desc ");
		
		$data = array();
		foreach($versionArray as $version)
		{
			$data['projects'][$version->id] = array(
					'id' => $version->project_id,
					'name' => $projectset[$version->project_id]->name,
					'newsletter_link' => $projectset[$version->project_id]->newsletter_link,
					'forum_link' => $projectset[$version->project_id]->forum_link,
					'versionName' => $version->release_name,
					'versionNumber' => $version->release_version,
					'versionDate' => $version->release_date,
					'download_link' => $version->download_link
				);
		}
		JhProjectViewProjects::display('projectlist',$data);
	}
}
