<div class="entry">
<h2><?php if($projecturl) echo $projecturl .' - '; ?><?php echo JhProjectViewProjects::renderWikiTitle($entry->title);?></h2>
<p>Modified on <?php echo $entry->modified;?> 
by 
<?php 

if (isset($username) && $username != '') {
   echo $username;
   } else {
	   echo JText::_('Anonymous: ') .$entry->ip;
   }
   ?>
   [ 
   <?php 
   if($revision)
   {
	   echo '<a href="'.JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$entry->project_id.'&task=editRevision&page=' . $entry->title.'&id='.$entry->id).'" class="wikiLink">' . JText::_('Set Active') . '</a>';
   }else{
		echo '<a href="'.JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$entry->project_id.'&task=edit&page=' . $entry->title).'" class="wikiLink">' . JText::_('Edit Entry') . '</a>';
   }
   if ($entry->revision > 0) {
   echo ' | <a href="'.JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$entry->project_id.'&task=revisions&page=' . $entry->title).'" class="wikiLink">' . JText::_('Revision #') . $entry->revision . '</a>';
   }
   ?>
   ]
   </p>
   <?php echo JhProjectViewProjects::renderWiki($entry)?>
</div>
   