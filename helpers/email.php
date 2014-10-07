<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */

defined('_JEXEC') or die;

//Email helper class for the confmgt. Helping with all email related acitivities within the Confmgt

abstract class EmailHelper
{
	
	// Sending emails
	public static function sendEmail($recipient, $subject, $body, $sender=0, $cc=0,  $bcc=0, $attachment=0)
	{
		
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		if ($sender ===0) {
		$sender = array( 
			$config->getValue( 'config.mailfrom' ),
			$config->getValue( 'config.fromname' ) ); 
		}
		$mailer->setSender($sender);
		$mailer->addRecipient($recipient);
		$mailer->setSubject($subject);
		$mailer->setBody($body);
		
		if (!$cc ==0) {
			$mailer->addCC($cc);
		}
		
		if (!$bcc ==0) {
			$mailer->addBCC($bcc);
		}
		
		if (!$attachment ==0) {
			$mailer->addBCC($bcc);
		}
		
		
		$send = $mailer->Send();
		if ( $send !== true ) {
			JFactory::getApplication()->enqueueMessage(JText::_('ERROR_OCCURRED_SENDING_MAIL'), 'error');
			return false;
		} else {
			JFactory::getApplication()->enqueueMessage(JText::_('MAIL_SENT'), 'notice'); 
			return true;
		}
			
	}
	
	//Helping with placeholders in email message body
	
	public static function replacePlaceholders($variables, $text)
	{
		foreach($variables as $key => $value){ //e.g. array("first_name"=>"John","last_name"=>"Smith","status"=>"won");
		
			$text = str_replace('{'.strtoupper($key).'}', $value, $text);
		}
		return $text;
	}
	
	public static function getEmailcontent ($emailcode) 
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
		//Build the query 
		$query = $db->getQuery(true)
					->select($db->quoteName(array('subject','message','emailcode')))
					->from($db->quoteName('#__confmgt_emails'))
					->where('emailcode = '.$db->quote($emailcode));
		//Prepare the query
		$db->setQuery($query);
		// Load the row.
		$row = $db->loadObject();
		$result = $row;
		if ($error = $db->getErrorMsg()) {
    		throw new Exception($error);
			return false;
		}else{ 
			return $result;
		}
	}
	
}

