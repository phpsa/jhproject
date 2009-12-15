<?php 
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_($pagetitle), 'addedit.png');
JToolBarHelper::save();
JToolBarHelper::media_manager();
JToolBarHelper::back();
$editor =& JFactory::getEditor();
?>
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}
	
	if ( form.name.value == '' ){
		alert("<?php echo JText::_( 'Project must have a title', true ); ?>");
	} else {
		<?php
		echo $editor->save( 'details' ) ; ?>
		submitform(pressbutton);
	}
}
</script>

<form action="index.php" method="post" name="adminForm">
<div class="col width-60">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>

				<table class="admintable">
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Project Name' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="name" id="name" value="<?php echo $project->name; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Name of the Project, This will be grouped together on the frontend with the latest inserted record as the current release.' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Forum Link' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="forum_link" id="forum_link" value="<?php echo $project->forum_link; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Will present a link to the support forum for the project if set' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Newsletter Link' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="newsletter_link" id="documentation_link" value="<?php echo $project->newsletter_link; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Will present a link to the newsletter for the project if set' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Developer Name' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="developer_name" id="developer_name" value="<?php echo $project->developer_name; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Will display if set' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Developer Email' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="developer_email" id="developer_email" value="<?php echo $project->developer_email; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Mail from the contact form on the project will be mailed here' ); ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_( 'Published' ); ?>:
					</td>
					<td colspan="2">
					<?php echo JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $project->published ); ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_( 'Project Image' ); ?>:
					</td>
					<td colspan="2">
					<?php echo JHTML::_('list.images',  'image', $project->image,null,'/images/' );  ?>
					<?php
					$path = JURI::root() . 'images/';
						?>
						<img src="<?php echo $path;?><?php echo $project->image;?>" name="imagelib" width="80" height="80" border="2" alt="<?php echo JText::_( 'Preview' ); ?>" />
					</td>
				</tr>
				
				</table>
			</fieldset>

			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Project Description' ); ?></legend>

				<table class="admintable">
				<tr>
					<td valign="top" colspan="3">
						<?php
						// parameters : areaname, content, width, height, cols, rows
						echo $editor->display( 'details',  $project->details, '550', '300', '60', '20', array() ) ;
						?>
					</td>
				</tr>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="option" value="com_jhproject" />
		<input type="hidden" name="id" value="<?php echo $project->id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
</form>