<?php
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_($pagetitle), 'article.png');
JToolBarHelper::addNew();
JToolBarHelper::editList();
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::deleteList(JText::_('Are you sure you want to delete the selected projects?'));

?> 
<form action="index.php" method="post" name="adminForm">
<input type="hidden" name="option" value="com_jhproject" />
<input type="hidden" name="controller" value="versions" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="" />
<div style="float:right"><?php echo JText::_('Filter By:');?> <select name="selectedproject" onchange="adminForm.submit();"><?php
		foreach($plist as $k=>$v)
		{
			$selected = ($selectedproject == $k)?'Selected':'';
			echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
		}?></select></div>
<table class="adminlist">
	<thead>
		<tr>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $list['rows'] );?>);" /></th>
			<th width="150"><?php echo JText::_('Project Name'); ?></th>
			<th width="150"><?php echo JText::_('Release Name'); ?></th>
			<th width="150"><?php echo JText::_('Release Version'); ?></th>
			<th width="150"><?php echo JText::_('Download Link'); ?></th>
			<th width="*"></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="6">
			<?php if($vlist['PageNav']) echo ($vlist['PageNav']->getListFooter()); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php if(count($vlist['rows'])) { 
		$i = 0;
		$r = 0;
		foreach($vlist['rows'] as $row)
		{
   ?>
   <tr class="<?php echo "row$r"; ?>">
				<td>
				<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->id;?>" name="cid[]" id="cb<?php echo $i;?>"/>
				</td>
				<td>
					<?php echo $plist[$row->project_id];?>
				</td>
				<td> 
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Release Name:' );?>::<?php echo $row->release_name; ?>">
						<a href="<?php echo JRoute::_( 'index.php?option=com_jhproject&controller=versions&task=edit&cid=' . $row->id ); ?>">
						<?php echo $row->release_name; ?></a>
					</span>
				</td>
				<td>
					<?php echo $row->release_version;?>
				</td>
				<td>
					<?php echo $row->download_link;?>
				</td>
				
				<td>
					<?php echo  JHTML::_('grid.published', $row, $i );?>
				</td>
			</tr>
		
		<?php
		$r = 1-$r;
		$i++;
		}
		}else{ ?>
			<tr><td colspan="6"><?php echo JText::_('No Results Found');?></td></tr>
		<?php } ?>
	</tbody>
</table>
</form>