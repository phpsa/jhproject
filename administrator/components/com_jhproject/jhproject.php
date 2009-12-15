<?php
/**
 * Joomla! 1.5 component jhproject
 *
 * @version $Id: jhproject.php 2009-12-06 11:08:51 svn $
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
 * Define constants for all pages
 */
define( 'COM_JHPROJECT_DIR', 'images'.DS.'jhproject'.DS );
define( 'COM_JHPROJECT_BASE', JPATH_ROOT.DS.COM_JHPROJECT_DIR );
define( 'COM_JHPROJECT_BASEURL', JURI::root().str_replace( DS, '/', COM_JHPROJECT_DIR ));

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

$ctr = JRequest::getCmd("controller","project");
$task = JRequest::getCmd('task','index');
if($task == '') $task = 'index';
//$action = JRequest::getCmd('action','index');

require_once(JPATH_COMPONENT.DS.'controllers'.DS.$ctr.'.php');
$controller_name = 'Controller_' . ucfirst($ctr);

// Initialize the controller
$controller = new $controller_name();

// Perform the Request task
$controller->execute( $task);
$controller->redirect();
?>