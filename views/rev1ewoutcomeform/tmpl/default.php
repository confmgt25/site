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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.modal');


//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div class="reviewoutcome-edit front-end-edit">
  <?php if (!empty($this->item->id)): ?>
  <h1><?php echo JText::_(''); ?> <?php echo $this->linkid; ?></h1>
  <?php else: ?>
  <h1>Add</h1>
  <?php endif; ?>
  <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('id'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('id'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('abstract_review_outcome'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('abstract_review_outcome'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('abstract_review_comments'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('abstract_review_comments'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('full_review_outcome'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('full_review_outcome'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('full_review_comments'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('full_review_comments'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('created_by'); ?> </div>
      <div class="col-sm-10"> <?php echo $this->form->getInput('created_by'); ?> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" ><?php echo JText::_('JSUBMIT'); ?></button>
        <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewoutcomeform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
        <input type="hidden" name="option" value="com_confmgt" />
        <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
        <input type="hidden" name="task" value="rev1ewoutcomeform.save" />
        <?php echo JHtml::_('form.token'); ?> </div>
    </div>
  </form>
</div>
