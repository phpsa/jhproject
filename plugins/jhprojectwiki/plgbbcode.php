<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//plgsubscript
class plgjhprojectwikiPlgbbcode extends JPlugin
{
	
	var $repcode = array();
	
	function onBeforeRenderWiki(& $event)
	{
			$search = array(
                '/\[b\](.*?)\[\/b\]/is',
                '/\[i\](.*?)\[\/i\]/is',
                '/\[u\](.*?)\[\/u\]/is',
                '/\[img\](.*?)\[\/img\]/is',
                '/\[url\](.*?)\[\/url\]/is',
                '/\[url\=(.*?)\](.*?)\[\/url\]/is',
				'/\[sub\](.*?)\[\/sub\]/is',
				'/\[sup\](.*?)\[\/sup\]/is',
				'/\[h1\](.*?)\[\/h1\]/is',
				'/\[h1\=(.*?)\](.*?)\[\/h1\]/is',
				'/\[h2\](.*?)\[\/h2\]/is',
				'/\[h2\=(.*?)\](.*?)\[\/h2\]/is',
				'/\[h3\](.*?)\[\/h3\]/is',
				'/\[h3\=(.*?)\](.*?)\[\/h3\]/is',
				'/\[h4\](.*?)\[\/h4\]/is',
				'/\[h4\=(.*?)\](.*?)\[\/h4\]/is',
				'/\[h5\](.*?)\[\/h5\]/is',
				'/\[h5\=(.*?)\](.*?)\[\/h5\]/is',
				'/\[code\=(.*?)\](.*?)\[\/code\]/is',
				'/\[code\](.*?)\[\/code\]/is',
				'/\[quote\](.*?)\[\/quote\]/is',
                );

        $replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<img src="$1" />',
                '<a href="$1">$1</a>',
                '<a href="$1">$2</a>',
				'<sub>$1</sub>',
				'<sup>$1</sup>',
				'<h1>$1</h1>',
				'<h1 class="$1">$2</h1>',
				'<h2>$1</h2>',
				'<h2 class="$1">$2</h2>',
				'<h3>$1</h3>',
				'<h3 class="$1">$2</h3>',
				'<h4>$1</h4>',
				'<h4 class="$1">$2</h4>',
				'<h5>$1</h5>',
				'<h5 class="$1">$2</h5>',
				'<pre xml: lang="$1">$2</pre>',
				'???$1???',
				'<blockquote>$1</blockquote>',
                );

        $event->content = preg_replace ($search, $replace, $event->content);
		
		$regex = "#<pre xml:\s*(.*?)>(.*?)</pre>#s";
		$event->content = preg_replace_callback( $regex, 'JHP_Geshi_replacer',  $event->content );

		
		
		
        return true;	
	}
	
	function onAfterRenderWiki(&$event)
	{
		$regex = '#<pre><pre class="(.*?)">(.*?)</pre></pre>#s';
		$rexrep = '<pre class="$1" style=" width:90%;overflow:auto">$2</pre>';
		$event->content = preg_replace($regex,$rexrep,$event->content);
		
	}
	
	function onEditFormWiki(&$entry)
	{
		//print_r($entry);
		$text = '
		<script type="text/javascript" src="'.JURI::base().'plugins/jhprojectwiki/bbeditor/ed.js"></script>
		<script>edToolbar("wiki_Content_editor","' . JURI::base() .'"); </script>';
		
		/**
		 * Testing option to test acl level
		 */
		$user = $user	= & JFactory::getUser();
		$gid = $user->get('gid', 0);
		$authed =  $this->params->get('filter_groups') ;
		if(!in_array($gid, $authed))
		{
			
			$mainframe = & JFactory::getApplication();
			if($entry->id)
			{
				$urlparams = '&view=wiki&page=' . $entry->title . '&project=' . $entry->project_id;
			}else{
				$urlparams = '';
			}
			$url = JRoute::_('index.php?option=com_jhproject' . $urlparams);
			$msg = JText::_('Not Authorized to edit this page');
			$mainframe->redirect( $url, $msg );
		//	$app  = &JApplication::getInstance();
		//	JApplication::redirect('index.php?option=com_jhproject', 'NOT AUTH');
		}
		//print_r($pluginParams);
		//print_r($plugin);
		
		return $text;
	}
	
}

function JHP_Geshi_replacer( &$matches )
{
//	print_r($matches);
//// 	die();
	jimport('geshi.geshi');
	jimport('domit.xml_saxy_shared');
	
	$args = SAXY_Parser_Base::parseAttributes( $matches[1] );
// 	print_r($args);
	$text = $matches[2];
	
	$lang	= JArrayHelper::getValue( $args, 'lang', 'phpz' );
	$lines	= JArrayHelper::getValue( $args, 'lines', 'true' );
	

	$html_entities_match = array( "|\<br \/\>|", "#<#", "#>#", "|&#39;|", '#&quot;#', '#&nbsp;#' );
	$html_entities_replace = array( "\n", '&lt;', '&gt;', "'", '"', ' ' );
	
	$text = preg_replace( $html_entities_match, $html_entities_replace, $text );
	
	$text = str_replace('&lt;', '<', $text);
	$text = str_replace('&gt;', '>', $text);
	
	$text = str_replace( "\t", '  ', $text );
	
	$geshi = new GeSHi( $text, $lang );
	if ($lines == 'true') {
		$geshi->enable_line_numbers( GESHI_FANCY_LINE_NUMBERS );
	}
	$text = $geshi->parse_code();
	$text = '???' . $text . '???';
	return $text;
}