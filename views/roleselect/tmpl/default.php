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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

// TO-DO change this to Confmgt ACL
/*
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_confmgt');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_confmgt')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
*/
?>
<div class="panel panel-default">
    <div class="panel-heading"><h1><?php echo JText::sprintf('COM_CONFMGT_ENTRY_FORM_PANEL_HEADING', $this->sitename); ?></h1></div>
  	<div class="panel-body">
 <div align="center">
       
             <?php if ($this->role['isAuthor']) : ?>
             <span>
				<form id="form-enrty-1" action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data" class="form-inline form-entry">
				<?php echo JHtml::_('form.token'); ?>
                <button class="btn btn-entry btn-default" type="submit"><?php echo '<span class="glyphicon glyphicon-user lg-span"></span><br />';  ?><?php echo JText::_("Author"); ?> </button>
				<input type="hidden" name="option" value="com_confmgt" />
                <input type="hidden" name="view" value="papers" />
				<input type="hidden" name="layout" value="default" />
                </form>
              </span>
    		<?php endif; ?>
            <?php if ($this->role['isThemeleader']) : ?> 
            	<span>
				<form id="form-enrty-2" action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data"  class="form-inline form-entry">
				<?php echo JHtml::_('form.token'); ?> 
                <input type="hidden" name="option" value="com_confmgt" />
                <input type="hidden" name="view" value="papers" />
				<input type="hidden" name="layout" value="leader_default" />
				<button class="btn btn-entry btn-default" type="submit"><?php echo '<span class="glyphicon glyphicon-lock lg-span"></span><br />';  ?><?php echo JText::_("Theme Leader"); ?> </button>
                </form> 
                </span>
            <?php endif; ?> 
            <?php if ($this->role['isRev1ewer']) : ?>
            	<span>
    			<form id="form-enrty-3" action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data" class="form-inline form-entry">                
				<?php echo JHtml::_('form.token'); ?>
                <input type="hidden" name="option" value="com_confmgt" />
                <input type="hidden" name="view" value="rev1ews" />
				<input type="hidden" name="layout" value="default" />
				<button class="btn btn-entry btn-default" type="submit"><?php echo '<span class="glyphicon glyphicon-pencil lg-span"></span><br />';  ?><?php echo JText::_("Reviewer"); ?> </button>
                </form>
				</span> 
    		<?php endif; ?>     


        </div>
        </div>
        </div>
<?php if ($this->item) : ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_AUTHOR_FORM_PANEL_HEADING'); ?></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_AUTHOR_FORM_PANEL_DETAILS'); ?></p>
  	</div>
    
    <table class="table">
    	<tr>
        	<td width="35%"> <?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_ID'); ?>: </td>
			<td width="65%"> <?php echo $this->item->id; ?></td>
        </tr>
        <tr>
        	<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_TITLE'); ?>:</td>
            <td><?php echo $this->item->title; ?></td>
        </tr>
  
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_FIRSTNAME'); ?>:</td>
			<td><?php echo $this->item->firstname; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_SURNAME'); ?>:</td>
			<td><?php echo $this->item->surname; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_EMAIL'); ?>:</td>
			<td><?php echo $this->item->email; ?></td>
        </tr>
     	
	</table>
</div>
<div>

    
	
	<form id="form-author-list-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=authors'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
	<?php echo JHtml::_('form.token'); ?>
	<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_AUTHORS_LIST"); ?> </button>
	</form>
    
		<form id="form-author-new-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.edit&id='.$this->item->id); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<?php echo JHtml::_('form.token'); ?>
		<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_EDIT_ITEM"); ?> </button>
		</form>
        

        
		
        <form id="form-author-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_DELETE_ITEM"); ?> </button>
		<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
		<input type="hidden" name="option" value="com_confmgt" />
		<input type="hidden" name="task" value="author.remove" />
		<?php echo JHtml::_('form.token'); ?>
		</form>
	

</div>
<?php
else:
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_HEADING'); ?></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_ITEM_NOT_LOADED'); ?></p>
  	</div>
</div>
<?php    
endif;
?>

