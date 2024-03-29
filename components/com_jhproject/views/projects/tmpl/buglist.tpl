<div class="componentheading"><?php echo $project->name . ' - ';?>  <?php echo JText::_("Bug Tracker");?></div>
<form id="bugform" name="bugform" action="<?php echo JRoute::_('index.php?option=com_jhproject&view=bugs&pid='.$project->id);?>" method="post">

<table class="contentpane" width="100%" align="center" border="0" cellpadding="4" cellspacing="0">
<tbody>
	<tr>
		<td>
			<table>
				<tr>
				<th><?php echo JText::_('Type: ');?><select name="bug_cat_id"  class="inputbox">
				<option value="0"><?php echo JText::_('All');?></option>
				<?php
				foreach($options['cat'] as $ckey=>$cvalue)
				{
					$selected = ($ckey == $bug_cat_id)?'Selected':'';
					echo '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';
				}?>
				</select>
					</th>
				<th>
				<?php echo JText::_('Priority: ');?> <select name="bug_priority_id"  class="inputbox">
				<option value="0"><?php echo JText::_('All');?></option>
				<?php 
				foreach($options['priority'] as $pkey=>$pvalue)
				{
					$selected = ($pkey == $bug_priority_id)?'Selected':'';
					echo '<option value="'.$pkey.'" '.$selected.'>'.$pvalue.'</option>';
				}?>
				</select>
				</th>
				<th>
				<?php echo JText::_('Status: ');?> <select name="bug_status_id"  class="inputbox">
				<option value="0"><?php echo JText::_('All');?></option>
				<?php 
				foreach($options['status'] as $pkey=>$pvalue)
				{
					$selected = ($pkey == $bug_status_id)?'Selected':'';
					echo '<option value="'.$pkey.'" '.$selected.'>'.$pvalue.'</option>';
				}
				$options['status'][0] = JText::_("Uncomfirmed");
				?>
				</select>
				</th>
				<th>
				<?php echo JText::_('Version');?><select name="bug_version_id" class="inputbox">
					<option value="0"><?php echo JText::_('All');?></option>
					<?php
						foreach($versions as $vkey=>$vvalue)
						{
							$selected = ($bug_version_id == $vkey)?'Selected':'';
							echo '<option value="'.$vkey.'" '.$selected.'>'.$vvalue.'</option>';
						}
						?></select>
				</th>
				<th>
					<input type="submit" value="<?php echo JText::_('Filter');?>" class="button" />
					<a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=bugs&pid='.$project->id.'&task=addbug');?>" ><img src="addnew.png" alt="<?php echo JText::_('Add');?>" /></a>
				</th>
					
					</tr>
				</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td class="sectiontableheader" height="20" width="15%" ><?php echo JText::_("Title");?></td>
						<td class="sectiontableheader" height="20" width="10%"><?php echo JText::_("Type");?></td>
						<td class="sectiontableheader" height="20" width="10%"><?php echo JText::_("Priority");?></td>
						<td class="sectiontableheader" height="20" width="10%"><?php echo JText::_("Status");?></td>
						<td class="sectiontableheader" height="20" width="15%"><?php echo JText::_("Assigned To");?></td>
						<td class="sectiontableheader" height="20" width="15%"><?php echo JText::_("Added");?></td>
						<td class="sectiontableheader" height="20" width="*">&nbsp;</td>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					if(!count($buglist['rows']))
					{
						?>
						<tr class="sectiontableentry1">
							<th colspan="7"><?php echo JText::_('No Bugs / Feature Requests for the project');?>
							</td>
						</tr>
						<?php
						
					}else{
					$r = 0;
					foreach($buglist['rows'] as $bug)
					{
						?>
					<tr class="sectiontableentry<?php echo $r+1;?>">
					<td><a href="<?php echo JRoute::_('index.php?option=com_jhproject&view=bugs&task=view&bid='.$bug->bug_id.'&pid=' . $bug->project_id .'&Itemid=' . JRequest::getVar('Itemid'));?>"><?php echo $bug->bug_title;?></a></td>
						<td><?php echo $options['cat'][$bug->bug_cat_id];?></td>
						<td><?php echo $options['priority'][$bug->bug_priority_id];?></td>
						<td><?php echo $options['status'][$bug->bug_status_id];?></td>
						<td><?php echo JhProjectViewProjects::renderUsername($bug->assigned_to);?></td>
						<td><?php echo DATE("Y-m-d", strtotime($bug->date_added));?></td>
						<td><?php echo JhProjectViewProjects::renderBugListActions($bug);?></td>
					</tr>
					<?php
						$r = 1-$r;
					}
					}
					?>
					</tbody>
					<tfoot>
					<tr>
					
						<th colspan="7" class="sectiontablefooter" align="right">
							<?php if($buglist['PageNav']) echo ($buglist['PageNav']->getListFooter()); ?>
						</th>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</tbody>
</table>
</form>

