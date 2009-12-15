<?php 
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_($pagetitle), 'addedit.png');
$url = 'index.php?option=com_jhproject&controller=settings';
$bar = & JToolBar::getInstance('toolbar');
$bar->appendButton( 'Link', 'config', JText::_('Manage Options'), "$url&task=listoptions" );
JToolBarHelper::save();
JToolBarHelper::back();
?> 


<form action="index.php" method="post" name="adminForm">
<input type="hidden" name="option" value="com_jhproject" />
<input type="hidden" name="controller" value="settings" />
<input type="hidden" name="task" value="" />


	<div class="col width-60">
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'General' ); ?></legend>
			<table class="admintable">
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Bug Notification' ); ?>:
					</td>
					<td colspan="2">
					<select name="setting_name[NON_REG_ACCESS_GROUP]">
						<option value="1"><?php echo JText::_("On");?></option>
						<option value="0" <?php if($settings['NON_REG_ACCESS_GROUP'] == 0) echo 'Selected';?>><?php echo JText::_("Off");?></option>
					</select>
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Update notification' ); ?>:
					</td>
					<td colspan="2">
					<select name="setting_name[USER_BUG_UPDATE_NOTIFICATION]">
						<option value="1"><?php echo JText::_("On");?></option>
						<option value="0" <?php if($settings['USER_BUG_UPDATE_NOTIFICATION'] == 0) echo 'Selected';?>><?php echo JText::_("Off");?></option>
					</select>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
</form>