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
   
   JHtml::_('behavior.modal');
   
   //Load admin language file
   $lang = JFactory::getLanguage();
   $lang->load('com_confmgt', JPATH_ADMINISTRATOR);
   
   //Check if the user is the author so the record can be viewed and edited
   $canView = $this->isAuthor;
   $canEdit = $this->isAuthor;
   
   if ($canView) :
   if ($this->item) : ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_PAPER_AUTHOR_PANEL_HEADING').' - '.JText::_('Paper ID').$this->item->id ; ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPER_AUTHOR_PANEL_DETAILS'); ?></p>
  </div>
  <table class="table">
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_AUTHORS'); ?>:</td>
      <td><?php if ($this->authors) {
                  	echo '<div align="left"><ol>';
                  		foreach ($this->authors as $author) { 
                  			echo ('<li>'.$author->title.' '.$author->firstname.' '.$author->surname.'</li>');
                  		}
                  	echo '</ol></div>';
                  ?></td>
      <td><div align="right">
          <form id="form-authors" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name= "linkid" value="<?php echo $this->item->id; ?>" />
            <button class="btn btn-default btn-sm" type="submit"><?php echo JText::_("Edit author details"); ?> </button>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="authors" />
            <input type="hidden" name="layout" value="update" />
          </form>
          <form id="form-authors-reorder" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name= "linkid" value="<?php echo $this->item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="authors" />
            <input type="hidden" name="layout" value="reorder" />
            <button class="btn btn-default btn-sm" type="submit"><?php echo JText::_("Edit author sequence"); ?> </button>
          </form>
        </div>
        <?php } ?></td>
    </tr>
  </table>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_PAPER_ABSRTACT_HEADING').' - '.JText::_('Paper ID').$this->item->id ; ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPER_ABSRTACT_DETAILS'); ?></p>
    <?php if($canEdit): ?>
    <div align="right">
      <form id="form-paper-new-<?php echo $this->item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <?php echo JHtml::_('form.token'); ?>
        <input type="hidden" name="option" value="com_confmgt" />
        <input type="hidden" name="task" value="paper.edit" />
        <input type="hidden" name="id" value="<?php echo $this->linkid; ?>" />
        <button class="btn btn-default btn-sm" type="submit"><?php echo JText::_("COM_CONFMGT_EDIT_ABSRTACT"); ?> </button>
      </form>
      <?php endif; ?>
    </div>
  </div>
  <table class="table">
    <tr>
      <td width="35%"><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ID'); ?>: </td>
      <td width="65%"><?php echo $this->item->id; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_TITLE'); ?>:</td>
      <td><?php echo $this->item->title; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT'); ?>: </td>
      <td><?php echo $this->item->abstract; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>:</td>
      <td><?php echo $this->item->keywords; ?></td>
    </tr>
  </table>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_PAPER_PANEL_HEADING').' - '.JText::_('Paper ID').$this->item->id ;; ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPER_PANEL_DETAILS'); ?></p>
  </div>
  <table class="table">
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>:</td>
      <td><?php echo $this->item->abstract_review_outcome; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>:</td>
      <td><?php echo $this->item->abstract_review_comments; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>:</td>
      <td><?php 
               echo '<ol>';
               foreach ($this->fullpapers as $fullpaper) { 
               	echo ('<li>'.$fullpaper->full_paper.' ('.$fullpaper->type.')</li>');
               }
               echo '</ol>';
               
               ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>:</td>
      <td><?php echo $this->item->full_review_outcome; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>:</td>
      <td><?php echo $this->item->full_review_comments; ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>:</td>
      <td><?php
               echo '<ol>';
               foreach ($this->camerareadypapers as $camerareadypaper) { 
               echo ('<li>'.$camerareadypaper->cameraready_paper.' ('.$camerareadypaper->type.')</li>');
               }
               echo '</ol>';
               ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>:</td>
      <td><?php
               echo '<ol>';
               foreach ($this->presentations as $presentation) { 
               echo ('<li>'.$presentation->presentation.' ('.$presentation->type.')</li>');
               }
               echo '</ol>';
               ?></td>
    </tr>
    <tr>
      <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>:</td>
      <td><?php echo $this->item->created_by; ?></td>
    </tr>
  </table>
</div>
<div>
  <form id="form-paper-list-<?php echo $this->item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="papers" />
    <button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_PAPERS_LIST"); ?> </button>
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
   else:
   ?>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_NOT_AUTHORISED'); ?></div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_DESC_NOT_AUTHORISED'); ?></p>
  </div>
</div>
<?php
endif;




