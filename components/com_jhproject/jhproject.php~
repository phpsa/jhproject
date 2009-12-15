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


//we need our models::
define('JHPROJECT_MODEL_PATH', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jhproject'.DS.'models'.DS);
// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';
$task = JRequest::getCmd('task','index');
if($task == '') $task = 'index';
$view = JRequest::getCmd('view','list');
if($view == '') $view = 'index';

if( !JRequest::getVar( 'Itemid' )) {
$component	= &JComponentHelper::getComponent('com_jhproject');
$menu		= &JSite::getMenu();
$items		= $menu->getItems('componentid', $component->id);

// $vars['itemId'] = @$items[0]->id;

JRequest::setVar('Itemid',@$items[0]->id );
// print_r(JRequest::getVar('Itemid'));
}
$controller_name = 'JhController_'.ucfirst($view);
require_once(JPATH_COMPONENT.DS.'controllers'.DS.$view.'Controller.php');
// echo $task;
// die();
$controller = new $controller_name();
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();
?>