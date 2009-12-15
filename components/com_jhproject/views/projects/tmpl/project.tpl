<?php
$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base() . "components/com_jhproject/greybox/gb_styles.css");
$document->addCustomTag('
<script type="text/javascript">
var GB_ROOT_DIR = "'.JURI::base().'components/com_jhproject/greybox/";
</script>
<script type="text/javascript" src="'.JURI::base() .'components/com_jhproject/greybox/AJS.js"></script>
<script type="text/javascript" src="'.JURI::base() .'components/com_jhproject/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="'.JURI::base() .'components/com_jhproject/greybox/gb_scripts.js"></script>');

?>
<h2 class="contentheading"> <?php echo $project->name;?></h2>
<div class="article-tools">
	<div class="article-meta">
	<?php echo JText::_('Version: ');?><?php echo $versions[0]->release_version;?> : <?php echo $versions[0]->release_name;?> : <span class="createdate"><?php echo DATE("Y-m-d", strtotime($versions[0]->release_date));?></span>
	
	</div>
	
	

</div>
<div class="article-content">
	<div class="projectdetails">
		<?php if($project->image != ''){ ?>
		<img border="0" align="left" vspace="0" hspace="15"  title="<?php echo $project->name;?>" alt="<?php echo $project->name;?>" src="<?php echo JURI::base();?>images/<?php echo $project->image;?>"/>
		<?php } ?>
		<?php echo $project->details;?>
	</div>
	<?php if($versions[0]->download_link != ''){?>
	<br><strong><a href="<?php echo $versions[0]->download_link;?>"><img alt="<?php echo $project->name;?>::<?php echo JText::_('Download');?>" title="<?php echo $project->name;?>::<?php echo JText::_('Download');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/download.png" align="left" /> &nbsp;<?php echo JText::_("Download");?></a>
	<?php } ?>
	<?php if($project->forum_link != '') { ?>
	<br><strong><a href="<?php echo $project->forum_link;?>"><img alt="<?php echo $project->name;?>::<?php echo JText::_('Support Forum');?>" title="<?php echo $project->name;?>::<?php echo JText::_('Support Forum');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/forum.png" align="left" /> &nbsp;<?php echo JText::_("Support Forum");?></a>
	<?php } ?>
	<?php if($project->newsletter_link != '') { ?>
	<br><strong><a href="<?php echo $project->newsletter_link;?>"><img alt="<?php echo $project->name;?>::<?php echo JText::_('Mailing List');?>" title="<?php echo $project->name;?>::<?php echo JText::_('Mailing List');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/newsletter.png" align="left" /> &nbsp;<?php echo JText::_("Mailing List");?></a>
	<?php } ?>
	<br><strong><a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$project->id);?>"><img alt="<?php echo $project->name;?>::<?php echo JText::_('Documentation Wiki');?>" title="<?php echo $project->name;?>::<?php echo JText::_('Documentation Wiki');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/wiki.png" align="left" /> &nbsp;<?php echo JText::_("Documentation Wiki");?></a>
	<br><strong><a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=projects&task=feed&pid='.$project_id .'&Itemid=' . JRequest::getVar('Itemid'),true,0);?>"><img alt="<?php echo $project->name;?>::<?php echo JText::_('Rss Feed');?>" title="<?php echo $project->name;?>::<?php echo JText::_('Rss Feed');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/feed.png" align="left" /> &nbsp;<?php echo JText::_('Rss Feed');?></a>
	
	<ul id="changeloglist">
	<?php foreach($versions as $version) { ?>
	<li class="changelogitem"><a href="<?php echo JRoute::_("index.php?option=com_jhproject&view=projects&task=changelog&pid=$project_id&vid=" . $version->id.'&Itemid=' . JRequest::getVar('Itemid'));?>" rel="gb_page_center[640, 480]" title="<?php echo $version->release_name;?>" target="_blank"><?php echo JText::_("Changelog: ");?><?php echo $version->release_name .': ' . $version->release_version . ' (' . DATE("Y-m-d", strtotime($version->release_date)) . ')';?></a></li>
	<?php } ?>
	</ul>
</div>