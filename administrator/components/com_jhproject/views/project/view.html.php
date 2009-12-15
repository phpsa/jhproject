<?php
/**
 * Joomla! 1.5 component jhproject
 *
 * @version $Id: view.html.php 2009-12-06 11:08:51 svn $
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

// Import Joomla! libraries
jimport( 'joomla.application.component.view');


class Viewproject extends JView {
	
    function display($tpl = 'default', $jhdata) {
		extract($jhdata);
		require_once('tmpl/'.$tpl.'.php');
    }
}

?>