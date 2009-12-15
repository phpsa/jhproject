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

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the jhproject component
 */
class JhProjectViewProjects extends JView {
	function display($tpl,$data = array()) {
		extract($data);
		require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'tmpl'.DS.$tpl.'.tpl');
        
    }
	
	function renderWiki($event)
	{
		
		$params = (object) array();
		$processMarkup = true;
		$project = JRequest::getVar('project',0);

		
		JPluginHelper::importPlugin( 'jhprojectwiki' );
		$dispatcher =& JDispatcher::getInstance();
		$result = $dispatcher->trigger('onBeforeRenderWiki',array(&$event));
		$content = $event->content;
		
		$return = '';
		$markup = array(
			"???" => array (
				'processing' => false,
				'open' => '<pre>',
				'close' => '</pre>',
			),
			"===" => array (
				'processing' => false,
				'open' => '<h3>',
				'close' => '</h3>',
			),
			"'''" => array (
				'processing' => false,
				'open' => '<i>',
				'close' => '</i>',
			),
			"!!!" => array (
				'processing' => false,
				'open' => '<b>',
				'close' => '</b>',
			),
			"___" => array (
				'processing' => false,
				'open' => '<u>',
				'close' => '</u>',
			),
			"[[[" => array (
				'processing' => false,
				'open' => '',
				'close' => '',
			),
			"]]]" => array (
				'processing' => false,
				'open' => '',
				'close' => '',
			),
			"htt" => array (
				'processing' => false,
				'open' => '',
				'close' => '',
			),
			"---" => array (
				'processing' => false,
				'open' => '<hr />',
				'close' => '<hr />',
			),
			"*" => array (
				'processing' => false,
				'open' => '<ul>',
				'close' => '</ul>',
			),
			"#" => array (
				'processing' => false,
				'open' => '<ol>',
				'close' => '</ol>',
			),
		);
		$lines = explode("\n", $content);
		foreach ($lines as $line) {
			$line = trim($line);
			$key = substr($line, 0, 1);
			if ($key && array_key_exists($key, $markup) && $processMarkup) {
				if (!$markup[$key]['processing']) {
					$markup[$key]['processing'] = true;
					$line = $markup[$key]['open'] . '<li> ' . substr($line, 1) . ' </li>';
				} else {
					$line = '<li> ' . substr($line, 1) . ' </li>';
				}
			} else {
				if ($markup['*']['processing']) {
					$markup['*']['processing'] = false;
					$line = ' ' . $markup['*']['close'] . ' ' . $line;
				}
				if ($markup['#']['processing']) {
					$markup['#']['processing'] = false;
					$line = ' ' . $markup['#']['close'] . ' ' . $line;
				}
				$line .= " <br /> ";
			}
			$words = explode(" ", $line);
			foreach ($words as $word) {
				$word = trim($word);
				$key = substr($word, 0, 3);
				if ($key && array_key_exists($key, $markup)) {
					if ($key == '???') {
						if ($markup[$key]['processing']) {
							$markup[$key]['processing'] = false;
							$processMarkup = true;
							$word = $markup[$key]['close'] . substr($word,3);
						} else {
							$markup[$key]['processing'] = true;
							$processMarkup = false;
							$word = $markup[$key]['open'] . substr($word,3);
						}
					} else if ($processMarkup) {
						if ($markup[$key]['processing']) {
							$markup[$key]['processing'] = false;
							$word = $markup[$key]['close'] .  substr($word,3);
						} else {
							if ($key != '---' && $key != 'htt') {
								$markup[$key]['processing'] = true;
							}
							if ($key == 'htt') {
								if (substr($word, 0,7) == "http://") {
									$word = "<a href='" . $word . "'>".$word."</a>";
								}
							} else {
								if ($key == '[[[') {
									$markup["]]]"]['processing'] = substr($word,3);
								}
								$word = $markup[$key]['open'] . substr($word,3);
							}
						}
					}
				} else {
					if ($processMarkup) {
						if ($markup["]]]"]['processing'] && substr($word, -3, 3) != "]]]") {
							$markup["]]]"]['processing'] .= ' ' . $word;
							$word = '';
						}
					}
					
				}
				$key = substr($word, -3, 3);
				if ($key && array_key_exists($key, $markup)) {
					if ($key == '???' ) {
						if ($markup[$key]['processing']) {
							$markup[$key]['processing'] = false;
							$processMarkup = true;
							$word = substr($word,0,-3) . $markup[$key]['close'];
						} else {
							$markup[$key]['processing'] = true;
							$processMarkup = false;
							$word = substr($word,0,-3) . $markup[$key]['open'];
						}
					} else if ($processMarkup) {
						if ($markup[$key]['processing'] && $key != ']]]') {
							$markup[$key]['processing'] = false;
							$word = substr($word,0,-3)  . $markup[$key]['close'];
						} else {
							if ($key != '---' && $key != ']]]') {
								$markup[$key]['processing'] = true;
							} else if ($key != 'htt') {
								if ($key == '[[[') {
									$markup[$key]['processing'] = true;
									$markup[']]]']['processing'] = substr($word,0,-3);
									$word = substr($word,0,-3);
								} else if ($key == ']]]') {
									if ($markup[$key]['processing']) {
										if (!$markup["[[["]['processing']) {
											$markup[$key]['processing'] .= ' ' . substr($word,0,-3);
										} else {
											$markup[$key]['processing'] = substr($markup[$key]['processing'],0,-3);
										}
										if (strpos($markup[$key]['processing'], "|")) {
											list($alink, $atitle) = explode('|', $markup[$key]['processing']);
										} else {
											$alink = $markup[$key]['processing'];
											$atitle = false;
										}
										if (strpos($alink, "://")) {
											$word = "<a href='" . $alink . "'>";
										} else {
											$link = 'index.php?option=com_jhproject&view=wiki&project='.$project.'&page=' . preg_replace("/[^a-zA-Z0-9_]/", "", $alink);
											$word = "<a href='".JRoute::_($link)."'>";
										}
										if ($atitle) {
											$word .= $atitle;
										} else {
											$word .= $alink;
										}
										$word .= "</a>";
										$markup[$key]['processing'] = false;
										$markup['[[[']['processing'] = false;
									}
								} else {
									$word = substr($word,0,-3) . $markup[$key]['open'];
								}
							}
						}
					}
				} else {
					if ($processMarkup) {
						if ($processMarkup && $markup[']]]']['processing']) {
							$word = '';
						}
						$markup["[[["]['processing'] = false;
					}
				}
				$return .= $word . ' ';
			}
		}
		
		$event->content = $return;
		JPluginHelper::importPlugin( 'jhprojectwiki' );
		$dispatcher =& JDispatcher::getInstance();
		$result = $dispatcher->trigger('onAfterRenderWiki',array(&$event));
		return $event->content;
		
		
	}
	
	function renderWikiTitle($title)
	{
		$title = str_replace("_"," ", $title);
		
		$array = preg_split('/([A-Z]+[^A-Z]*)/', $title, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$title = implode(" ", $array);
		
		return $title;
		
		
	}
	
	function renderUsername($id, $return = null)
	{
		if(is_null($return))
		{
			$return = JText::_('Nobody');
		}
		if($id > 0)
		{
			$db	=& JFactory::getDBO();
			$q = "Select username from #__users where id=$id";
			$db->setQuery($q);
			$return = $db->loadResult();
		}
		return $return;
	}
	
	function renderBugListActions($bug)
	{
		$user = & JFactory::getUser();
		$gid = $user->get('aid',0);
		$return = '<a href="'.JRoute::_('index.php?option=com_jhproject&view=bugs&task=view&pid='.$bug->project_id.'&bid='.$bug->bug_id).'">'.JText::_('View').'</a> ';
		switch($gid)
		{
			case '2':
				$return .= '<a href="'.JRoute::_('index.php?option=com_jhproject&view=bugs&task=editbug&pid='.$bug->project_id.'&bid='.$bug->bug_id).'">'.JText::_('Edit').'</a> ';
				
			case '1':
				 
				break;
			case '0':
			default:
				 
				break;
		}
		return $return;
	}
}
?>