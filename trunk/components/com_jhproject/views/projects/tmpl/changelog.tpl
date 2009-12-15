<div style="padding:5px">
<h2 class="contentheading"> <?php echo $project->name;?></h2>
<div class="article-tools">
	<div class="article-meta">
	<php echo JText::_('Version: ');?><?php echo $version->release_version;?> : <?php echo $version->release_name;?> : <span class="createdate"><?php echo DATE("Y-m-d", strtotime($version->release_date));?></span>
	
	</div>
</div>
<div class="article-content">
	<?php echo $version->changelog;?>
</div>
</div>