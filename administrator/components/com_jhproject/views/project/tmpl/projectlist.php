<?php
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_($pagetitle), 'article.png');
JToolBarHelper::addNew();
JToolBarHelper::editList();
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::deleteList(JText::_('Are you sure you want to delete the selected projects?'));

?>
<form action="index.php?option=com_jhproject" method="post" name="adminForm">
<table class="adminlist">
	<thead>
		<tr>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $list['rows'] );?>);" /></th>
			<th width="150"><?php echo JText::_('Project Name'); ?></th>
			<th width="150"><?php echo JText::_('Forum Link'); ?></th>
			<th width="150"><?php echo JText::_('Newsletter Link'); ?></th>
			<th width="*"></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="5">
			<?php if($list['PageNav']) echo ($list['PageNav']->getListFooter()); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
	<?php if(!count($list['rows'])) {?>
		<tr><td colspan="6"><?php echo JText::_('No Results Found');?></td></tr>
	<?php }else{ ?>
	<?php
		$r = 0;
		$i = 0;
		foreach($list['rows'] as $row)
		{?>
			<tr class="<?php echo "row$r"; ?>">
				<td>
				<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->id;?>" name="cid[]" id="cb<?php echo $i;?>"/>
				</td>
				<td>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Title' );?>::<?php echo $row->name; ?>">
						<a href="<?php echo JRoute::_( 'index.php?option=com_jhproject&task=edit&cid=' . $row->id ); ?>">
						<?php echo $row->name; ?></a>
					</span>
				</td>
				<td>
					<?php echo $row->forum_link;?>
				</td>
				<td>
					<?php echo $row->newsletter_link;?>
				</td>
				
				<td>
					<?php echo  JHTML::_('grid.published', $row, $i );?>
				</td>
			</tr>
		<?php
			$r = 1-$r;
			$i++;
		}
		?>
		
	<?php } ?>
	</tbody>
</table>


<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="type" value="project" />
</form>