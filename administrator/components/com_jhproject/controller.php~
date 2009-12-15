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

jimport( 'joomla.application.component.controller' );


/**
 * jhproject Controller
 *
 * @package Joomla
 * @subpackage jhproject
 */
class JhprojectController extends JController {
    /**
     * Constructor
     * @access private
     * @subpackage jhproject
     */
	
	var $jhdata;
	
    function __construct() {
//     print_r($_POST);
//     die();
        parent::__construct();
    }
	
	function loadModel($model)
	{
		if(!file_exists(JPATH_COMPONENT.DS.'models'.DS.$model.'.php' ))
			return false;
		require_once(JPATH_COMPONENT.DS.'models'.DS.$model.'.php');
		return new $model();
	}
	
	
}
?>