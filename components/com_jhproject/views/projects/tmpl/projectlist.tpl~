<div class="componentheading"><?php echo JText::_("Projects List");?></div>
<table class="contentpane" width="100%" align="center" border="0" cellpadding="4" cellspacing="0">
<tbody>
	<tr>
		<td colspan="2" width="60%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td class="sectiontableheader" height="20" width="30%" ><?php echo JText::_("Project Name");?></td>
						<td class="sectiontableheader" height="20" width="30%"><?php echo JText::_("Latest Version");?></td>
						<td class="sectiontableheader" height="20" width="30%"><?php echo JText::_("Release Date");?></td>
						<td class="sectiontableheader" height="20" width="20" align="center"><a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=projects&task=feed&Itemid=' . JRequest::getVar('Itemid'),true,0);?>"><img alt="<?php echo JText::_('All Projects');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/feed.png" title="<?php echo JText::_('All Projects');?>" /></a></td>
					</tr>
					<?php 
					$r = 0;
					foreach($projects as $project)
					{
						?>
					<tr class="sectiontableentry<?php echo $r+1;?>">
					<td><a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=projects&pid=' . $project['id'] .'&Itemid=' . JRequest::getVar('Itemid'));?>"><?php echo $project['name'];?></a></td>
						<td><?php echo $project['versionNumber'] . ' ' . $project['versionName'];?></td>
						<td><?php echo DATE("Y-m-d", strtotime($project['versionDate']));?></td>
						<td height="20" width="10%" align="center" nowrap>
						<a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=projects&pid='.$project['id'].'&Itemid=' . JRequest::getVar('Itemid'),true,0);?>"><img alt="<?php echo $project['name'];?>::<?php echo JText::_('Overview');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Overview');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/information.png"/></a>
						 
						 <a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=wiki&project='.$project['id'].'&Itemid=' . JRequest::getVar('Itemid'),true,0);?>"><img alt="<?php echo $project['name'];?>::<?php echo JText::_('Documentation Wiki');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Documentation Wiki');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/wiki.png"/></a> 
							
							<?php if($project['newsletter_link'] != '') {?>
							<a href="<?php echo $project['newsletter_link'];?>"><img alt="<?php echo $project['name'];?>::<?php echo JText::_('Mailing List');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Mailing List');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/newsletter.png"/></a> 
							<?php } ?>
							
							<?php if($project['forum_link'] != '') {?>
							<a href="<?php echo $project['forum_link'];?>"><img alt="<?php echo $project['name'];?>::<?php echo JText::_('Support Forum');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Support Forum');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/forum.png"/></a> 
							<?php } ?>
							
							<?php if($project['download_link'] != '') {?>
							<a href="<?php echo $project['download_link'];?>"><img alt="<?php echo $project['name'];?>::<?php echo JText::_('Download');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Download');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/download.png"/></a> 
							<?php } ?>
							
							<a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=projects&task=feed&pid='.$project['id'] . '&Itemid=' . JRequest::getVar('Itemid'),true,0);?>"><img  alt="<?php echo $project['name'];?>::<?php echo JText::_('Rss Feed');?>" title="<?php echo $project['name'];?>::<?php echo JText::_('Rss Feed');?>" src="<?php echo JURI::base();?>components/com_jhproject/images/feed.png"/></a></td>
					</tr>
					<?php
						$r = 1-$r;
					}
					?>
					<tr>
						<td colspan="4" class="sectiontablefooter" align="right">
						
							</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</tbody>
</table>


