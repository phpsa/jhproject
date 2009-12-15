<h2><?php echo JText::_('Edit Entry : ');?>   <?php echo JhProjectViewProjects::renderWikiTitle($entry->title);?></h2>
<form action="<?php echo JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$project.'&task=save');?>" method="post">
<div id="optional"> 
</div>
<div class="wiki_form_fields">
	<textarea id="wiki_Content_editor" name="content" class="wiki_editor" cols="50" rows="15"><?php echo $entry->content;?></textarea>
	<a href="javascript:jhpwiki_enlarge()" style="text-decoration:none">+</a> 
</div>
<?php
JPluginHelper::importPlugin( 'jhprojectwiki' );
$dispatcher =& JDispatcher::getInstance();
$result = $dispatcher->trigger('onEditFormWiki', array($entry));
foreach($result as $plugin)	
	echo $plugin;
?>
<input type="hidden" name="id" value="<?php echo $entry->id;?>" />
<input type="hidden" name="title" value="<?php echo $entry->title;?>" />
<div class="submit">
	<input type="Submit" value="<?php echo JText::_('Save');?>" id="wiki_save_button" class="button" />
	<input type="button" onclick="javascript:window.location('<?php echo JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$project.'&page=' . $entry->title); ?>')" value="<?php echo JText::_('Cancel');?>" class="button"/>
</div>
</form>
<script type="text/javascript">
<!--
function jhpwiki_enlarge() 
{
	var ta=document.getElementById("wiki_Content_editor");ta.style.width=((ta.cols*=1.1)*10).toString()+"px";ta.style.height=((ta.rows*=1.1)*30).toString()+"px";
}

//-->
</script>

 
