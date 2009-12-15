<div class="componentheading"><?php echo $project->name . ' - ';?>  <?php echo JText::_("Bug Tracker");?> - <?php echo $bugs->bug_title;?></div> 
<table class="contentpane" width="100%" align="left" border="0" cellpadding="4" cellspacing="0">
<tbody>
<tr class="sectiontableentry2">
	<td nowrap><?php echo JText::_('Project');?></td><td nowrap><?php echo $project->name;?></td>
	<td nowrap><?php echo JText::_('Version');?></td><td nowrap><?php echo $versions[$bugs->bug_version_id];?></td>
</tr>
<tr class="sectiontableentry1">
	<td nowrap><?php echo JText::_('Reported By');?></td><td nowrap><?php echo JhProjectViewProjects::renderUsername($bugs->reported_by,JText::_('Anonomous'));?></td>
	<td nowrap><?php echo JText::_('Assigned To');?></td><td nowrap><?php echo JhProjectViewProjects::renderUsername($bugs->assigned_to);?></td>
	
</tr>
<tr class="sectiontableentry2">
	<td nowrap><?php echo JText::_('Date Added');?></td><td nowrap><?php echo DATE("Y-m-d", strtotime($bugs->date_added));?></td>
	<td nowrap><?php echo JText::_('Last Updated');?></td><td nowrap><?php if($bugs->date_closed > 0) echo DATE("Y-m-d", strtotime($bugs->date_closed));?></td>
</tr>
<tr class="sectiontableentry1">
	<td nowrap><?php echo JText::_('Type');?></td><td nowrap><?php echo $options['cat'][$bugs->bug_cat_id];?></td>
	<td nowrap><?php echo JText::_('Priority');?></td><td nowrap><?php echo $options['priority'][$bugs->bug_priority_id];?></td>
</tr>
<tr class="sectiontableentry1">
	<td nowrap><?php echo JText::_('Browser');?></td><td nowrap><?php echo $options['browser'][$bugs->bug_browser_id];?></td>
	<td nowrap><?php echo JText::_('Joomla Version');?></td><td nowrap><?php echo $options['os'][$bugs->bug_os_id];?></td>
</tr>

<tr class="sectiontableentry2">
	<td nowrap valign="top"><?php echo JText::_('Details');?></td>
		<td colspan="3"><?php echo nl2br($bugs->bug_details);?></td>
</tr>

</tbody>
</table>
<div style="float:right"><a href="javascript:history.go(-1);"><?php echo JText::_('Back');?></a></div>
