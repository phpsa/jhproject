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

jimport('joomla.application.component.controller');

/**
 * jhproject Component Controller
 */
class JhprojectController extends JController {
	function display() {
        // Make sure we have a default view
        if( !JRequest::getVar( 'view' )) {
		    JRequest::setVar('view', 'projects' );
        }
		parent::display();
	}
	
	
	function loadModel($model)
	{
		if(file_exists(JPATH_COMPONENT.DS.'models'.DS.$model.'.php' ))
			require_once(JPATH_COMPONENT.DS.'models'.DS.$model.'.php');
		else
			require_once(JHPROJECT_MODEL_PATH . $model . '.php');
		
		return new $model();
	}
}


//we need a view for feed! per project & all projects
//we need a view for project list
//we need a view for project information
//One view with multiple options, ie task=list,task=feed,task=details