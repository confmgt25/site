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
<div class = 'form-horizontal well'>
  <fieldset>
    <div class="author-edit front-end-edit">
      <?php if (!empty($this->item->id)): ?>
      <legend><?php echo JText::_('Add a reviewer'); ?></legend>
      <?php else: ?>
      <legend><?php echo JText::_('Add a reviewer'); ?></legend>
      <?php endif; ?>
      <form id="form-author" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('id'); ?> </div>
          <div class="col-sm-10"> <?php echo $this->form->getInput('id'); ?> </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('firstname'); ?> </div>
          <div class="col-sm-10"> <?php echo $this->form->getInput('firstname'); ?> </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('rev1ewer'); ?> </div>
          <div class="col-sm-10"> <?php echo $this->form->getInput('rev1ewer'); ?> </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" ><?php echo JText::_('Add'); ?></button>
            <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewersforpaperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="rev1ewersforpaperform.save" />
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
<?php
$canView = $this->isThemeleader;
$canEdit = $this->isThemeleader;

if ($canView): 
	if ($this->item): ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_REVIEWER_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  
  <div class="panel-body">
    <div align="right">
    </div>
  </div>
  <?php
  if ($this->rev1ewers)
  { ?>
  <table class="table">
  <?php
  $i=1;
  foreach($this->rev1ewers as $rev1ewer)
  { ?>
    <tr>
      <td width="5%"><?php
		echo $i; ?>
        :</td>
      <td><?php

				echo ( $rev1ewer->revtitle . ' ' . $rev1ewer->revfirstname . ' ' . $rev1ewer->revsurname );
		  ?>
		</td>
    </tr>
  <?php $i = $i+1;
  }  ?>
  </table>
  <?php } ?>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_AUTHOR_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <div class="panel-body">
    <div align="right">
    </div>
  </div>
  <table class="table">
    <tr>
      <td width="35%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_AUTHORS'); ?>
        :</td>
      <td width="65%"><?php
		if ($this->authors)
		{
			echo '<div align="left"><ol>';
			foreach($this->authors as $author)
			{
				echo ('<li>' . $author->title . ' ' . $author->firstname . ' ' . $author->surname . '</li>');
			}

			echo '</ol></div>';
		} ?></td>
    </tr>
  </table>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_ABSRTACT_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <table class="table">
    <tr>
      <td width="35%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ID'); ?>
        : </td>
      <td width="65%"><?php
		echo $this->item->id; ?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_TITLE'); ?>
        :</td>
      <td><?php
		echo $this->item->title; ?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT'); ?>
        : </td>
      <td><?php
		echo $this->item->abstract; ?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>
        :</td>
      <td><?php
		echo $this->item->keywords; ?></td>
    </tr>
  </table>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <div class="panel-body"> </div>
  <table class="table">
    <tr>
      <td width="35%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>
        :</td>
      <td width="65%"><?php
		if ($this->item->abstract_review_outcome == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->abstract_review_outcome;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
		if ($this->item->abstract_review_comments == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->abstract_review_comments;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
        :</td>
      <td><?php
		if ($this->item->full_paper == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->full_paper;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
		if ($this->item->full_review_outcome == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->full_review_outcome;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
		if ($this->item->full_review_comments == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->full_review_comments;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>
        :</td>
      <td><?php
		if ($this->item->camera_ready == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->camera_ready;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>
        :</td>
      <td><?php
		if ($this->item->presentation == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->presentation;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>
        :</td>
      <td><?php
		echo $this->item->created_by_name; ?></td>
    </tr>
  </table>
</div>
<form id="form-paper-list-<?php
		echo $this->item->id ?>" style="display:inline" action="<?php
		echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
  <?php
		echo JHtml::_('form.token'); ?>
  <input type="hidden" name="option" value="com_confmgt" />
  <input type="hidden" name="view" value="papers" />
  <input type="hidden" name="layout" value="leader_default" />
  <button class="btn btn-default" type="submit">
  <?php
		echo JText::_("<< Back"); ?>
  </button>
</form>
<?php
	else:
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <?php
		echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_HEADING'); ?>
  </div>
  <div class="panel-body"> </div>
</div>
<?php
	endif;
else:
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <?php
	echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_NOT_AUTHORISED'); ?>
  </div>
  <div class="panel-body"> </div>
</div>
<?php
endif;
