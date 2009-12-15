<?php 
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_($pagetitle), 'addedit.png');
JToolBarHelper::save();
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
	
	if ( form.release_version.value == '' ){
		alert("<?php echo JText::_( 'Project must have a version', true ); ?>");
	} else if(form.release_name.value == ''){
		alert("<?php echo JText::_('Project must have a release name', true); ?>");
	}else if(form.project_id.selectedIndex == 0){
		alert("<?php echo JText::_("Please Select a Project",true);?>");
	} else {
		<?php
		echo $editor->save( 'changelog' ) ; ?>
		submitform(pressbutton);
	}
}
</script>

<form action="index.php" method="post" name="adminForm">
<div class="col width-60">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Release Details' ); ?></legend>

				<table class="admintable">
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Project Name' ); ?>:
					</td>
					<td colspan="2">
					<select name="project_id">
						<?php foreach($plist as $k=>$v) {
							$selected = ($version->project_id == $k)?'Selected':'';
							echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
							}?>
					</select>
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Release Name' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="release_name" id="release_name" value="<?php echo $version->release_name; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Release Name of the Project' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Release Version' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="release_version" id="release_version" value="<?php echo $version->release_version; ?>" size="15" maxlength="15" title="<?php echo JText::_( 'Eg V1.1.0RC5' ); ?>" />
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo JText::_( 'Download Link' ); ?>:
					</td>
					<td colspan="2">
					<input class="text_area" type="text" name="download_link" id="download_link" value="<?php echo $version->download_link; ?>" size="50" maxlength="50" title="<?php echo JText::_( 'Will present a link to the download for the project if set' ); ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_( 'Published' ); ?>:
					</td>
					<td colspan="2">
					<?php echo JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $version->published ); ?>
					</td>
				</tr>
				<tr>
				<td class="key">
				<?php echo JText::_( 'Release Date' ); ?>:
				</td>
				<td colspan="2">
				<?php echo JHTML::_('calendar',  $version->release_date, 'release_date', 'release_date'); ?>
				</td>
				</tr>
				
				
				
				</table>
			</fieldset>

			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Version Changelog' ); ?></legend>

				<table class="admintable">
				<tr>
					<td valign="top" colspan="3">
						<?php
						// parameters : areaname, content, width, height, cols, rows
						echo $editor->display( 'changelog',  $version->changelog, '550', '300', '60', '20', array() ) ;
						?>
					</td>
				</tr>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="option" value="com_jhproject" />
		<input type="hidden" name="controller" value="versions" />
		<input type="hidden" name="id" value="<?php echo $version->id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
</form>