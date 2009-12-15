<div class="componentheading"><?php echo $project->name . ' - ';?>  <?php echo JText::_("Bug Tracker");?></div>
<form id="bugform" name="bugform" action="<?php echo JRoute::_('index.php?option=com_jhproject&view=bugs&task=savebug&pid='.$project->id);?>" method="post" class="form-validate">
<table class="contentpane" width="100%" align="left" border="0" cellpadding="4" cellspacing="0">
<tbody>
	<tr>
		<td width="100" nowrap>
			<?php echo JText::_('Title: ');?>
		</td>
		<td>
			<input type="text" name="bug_title" class="required inputbox" value="<?php echo $bug->bug_title;?>"/>
		</td>
	</tr>
	<tr>
		<td nowrap>
		 <?php echo JText::_('Type: ');?>
		</td>
		<td>
		<select name="bug_cat_id"  class="inputbox">
		<?php
		foreach($options['cat'] as $ckey=>$cvalue)
		{
			$selected = ($ckey == $bug->bug_cat_id)?'Selected':'';
			echo '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';
		}?>
		</td>
	</tr>
	<tr>
		<td nowrap>
			<?php echo JText::_('Priority: ');?>
		</td>
		<td>
		<select name="bug_priority_id"  class="inputbox">
				<?php 
				foreach($options['priority'] as $pkey=>$pvalue)
				{
					$selected = ($pkey == $bug->bug_priority_id)?'Selected':'';
					echo '<option value="'.$pkey.'" '.$selected.'>'.$pvalue.'</option>';
				}?>
				</select>
		</td>
	</tr>
	<tr>
		<td nowrap>
		 <?php echo JText::_('Browser: ');?>
		</td>
		<td>
		<select name="bug_browser_id"  class="inputbox">
				<?php 
				foreach($options['browser'] as $pkey=>$pvalue)
				{
					$selected = ($pkey == $bug->bug_browser_id)?'Selected':'';
					echo '<option value="'.$pkey.'" '.$selected.'>'.$pvalue.'</option>';
				}?>
				</select>
		</td>
	</tr>
	<tr>
		<td nowrap>
		 <?php echo JText::_('Joomla Version: ');?>
		</td>
		<td>
		<select name="bug_os_id"  class="inputbox">
		<?php 
		foreach($options['os'] as $pkey=>$pvalue)
		{
			$selected = ($pkey == $bug->bug_os_id)?'Selected':'';
			echo '<option value="'.$pkey.'" '.$selected.'>'.$pvalue.'</option>';
		}?>
		</select>
		</td>
	</tr>
	<tr>
		<td nowrap>
		<?php echo $project->name  .' ' . JText::_('version: ');?>
		</td>
		<td>
		<select name="bug_version_id" class="inputbox">
		<?php
		foreach($versions as $vkey=>$vvalue)
		{
			$selected = ($bug->bug_version_id == $vkey)?'Selected':'';
			echo '<option value="'.$vkey.'" '.$selected.'>'.$vvalue.'</option>';
		}
		?></select>
		</td>
	</tr>
	<tr>
		<td valign="top" nowrap>
		<?php echo JText::_('Details');?>
		</td>
		<td>
		<textarea name="bug_details" class="inputbox" rows="5" cols="40"><?php echo $bug->bug_details;?></textarea>
		</td>
	</tr>
	<tr>
	<td></td>
	<td><button class="button validate" type="submit">Register</button>
	</td></tr>
</tbody>
</table>
</form>