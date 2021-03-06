
<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com>
 - http://www.confmgt.com */ 
 
 //no direct access 
 defined('_JEXEC') or die; 
 JHtml::_('behavior.keepalive'); 
 JHtml::_('behavior.tooltip'); 
 JHtml::_('behavior.formvalidation'); 
 JHtml::_('behavior.modal'); 
 
?>

<div class="reg-edit front-end-edit">
	<?php if (!empty($this->item->id)): ?>
	<h1><?php echo JText::_('Step 2 of 2: Paper ID: '); echo $this->linkid; ?></h1>
	<?php else: ?>
	<h1>Add</h1>
	<?php endif; ?>
	<form id="form-reg" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=regform.save'); ?>
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->form->getLabel('id'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->form->getInput('id'); ?>
			</div>
		</div>
        <div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('title'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('title'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('firstname'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('firstname'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('surname'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('surname'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('email'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('email'); ?>
			</div>
		</div>
        <div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('username'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('username'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('password'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('password'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">
				<?php echo $this->
				form->getLabel('password2'); ?>
			</div>
			<div class="col-sm-10">
				<?php echo $this->
				form->getInput('password2'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?>
				</button>
				<?php echo JText::_('or'); ?>
				<a href="<?php echo jroute::_('index.php?option=com_confmgt&task=regform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?>
				</a>
				<input type="hidden" name="option" value="com_confmgt"/>
				<input type="hidden" name="task" value="regform.save"/>
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</form>
</div>