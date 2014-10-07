<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

//adding helpers
JLoader::register( 'ConfmgtHelper' , JPATH_COMPONENT.'/helpers/confmgt.php' );
JLoader::register( 'AclHelper' , JPATH_COMPONENT.'/helpers/acl.php' );
JLoader::register( 'EmailHelper' , JPATH_COMPONENT.'/helpers/email.php' );

//adding bootstrap styles
$url = JURI::root()."components/com_confmgt/assets/css/bootstrap.css";
$document = JFactory::getDocument();
$document->addStyleSheet($url);
// correction for bootstrap 62.5% font-size issue (may be there is a better way of doing this?)
$style = 'html{font-size:100%;}';
$document->addStyleDeclaration($style);

// Execute the task.
$controller	= JController::getInstance('Confmgt');
$controller->registerDefaultTask('displayDefault');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
