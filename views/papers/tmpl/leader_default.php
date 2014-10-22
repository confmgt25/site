<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */
// no direct access
defined('_JEXEC') or die;
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_CONFMGT_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-paper-delete-' + item_id).submit();
        }
    }
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_LEADERS_PAPERS_FORM_PANEL_HEADING'); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_LEADRRS_PAPERS_FORM_PANEL_DETAILS'); ?></p>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th><?php echo JText::_("COM_CONFMGT_ID"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_TITLE"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_AUTHOR"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_THEME"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_REV_ALLOCATED"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_AB_REV_POSTED"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_FULL_REV_POSTED"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $show = false; ?>
      <?php foreach ($this->leadersitems as $item) : ?>
      <?php $show = true; ?>
      <tr>
        <td width="5%"><?php echo $item->id; ?></td>
        <td width="20%"><?php echo $item->title; ?></td>
        <td width="20%"><?php echo $item->author; ?></td>
        <td width="20%"><?php echo $item->theme; ?></td>
        <td width="11%"> 
							<a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=rev1ewersforpaperform&linkid='.(int)$item->id); ?>"> 
                             <?php 
								 echo $item->rev1ewers;
							 ?>
							 </a>
                          
        
        </td>
        <td width="12%"><?php 
							 if ($item->abstract_review_outcome == 0) {
								 echo JText::_("No");  
							 }else{
								 echo JText::_("Yes");
							 }
								 ?></td>
        <td width="12%"><?php 
							 if ($item->full_review_outcome == 0) {
								 echo JText::_("No");  
							 }else{
								 echo JText::_("Yes");
							 }
							?></td>
      </tr>
      <?php // endif; ?>
      <?php endforeach; ?>
    </tbody>
    <?php
        if (!$show):
            echo JText::_('COM_CONFMGT_NO_ITEMS');
        endif;
        ?>
    <tfoot>
      <?php if ($show): ?>
    <div class="pagination">
      <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
      <?php echo $this->pagination->getPagesLinks(); ?> </div>
    <?php endif; ?>
      </tfoot>
    
  </table>
</div>
<div>
  <form id="form-entrypage" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_ENTRY_PAGE"); ?> </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="entrypage" />
  </form>
  <form id="form-reviewers-list" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_LEADER_REVIEWERS_LIST"); ?> </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="rev1ewers" />
  </form>
</div>
