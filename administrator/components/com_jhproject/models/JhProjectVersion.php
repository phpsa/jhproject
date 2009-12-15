<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once('JhTable.php');

class JhProjectVersion extends Jhtable
{
	/** set our table name and defaults **/
	var $_tbl = '#__jhproject_versions';
	var $_tbl_key = 'id';
	
	/** set our table columns **/
	
	var $id;
	var $project_id;
	var $release_name;
	var $release_version;
	var $release_date;
	var $changelog;
	var $published;
	var $download_link;
	

}
?>