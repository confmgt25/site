<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */

defined('_JEXEC') or die;

//ACL helper class for the confmgt. Using a specific ACL for the component as the Joomla ACL does not serve the purpose

abstract class AclHelper
{
	
	// Check if the logged in user is the author for the given paper id
	public static function isAuthor($paperid = 0)
	{
		
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
		//Build the query 
		$query = $db->getQuery(true)
					->select($db->quoteName('created_by'))
					->from($db->quoteName('#__confmgt_papers'))
					->where('id = '. (int)$paperid);
		//Prepare the query
		$db->setQuery($query);
		// Load the row.
		$row = $db->loadResult();	
		//check if user ceareted the record 
		$result = ($user->id == $row);
		//Return the Hello
		return $result; 
	}
	
	public static function isThemeleader($themeid = 0)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
		if ($themeid == 0) {
		
			//Build the query 
			$query = $db->getQuery(true)
						->select('COUNT(*)')
						->from($db->quoteName('#__confmgt_themes'))
						->where('userid = '. (int)$user->id);
		}else{
						//Build the query 
			$query = $db->getQuery(true)
						->select('COUNT(*)')
						->from($db->quoteName('#__confmgt_themes'))
						->where('userid = '. (int)$user->id)
						->where('id = '. (int)$themeid);
		}
			
		//Prepare the query
		$db->setQuery($query); 
		// Load the row.
		$row = $db->loadResult();	
		//check if user ceareted the record 
		$result = ($row > 0);
		//Return the Hello
		return $result; 
	}
	
	public static function isRev1ewer($themeid = 0)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
		if ($themeid == 0) {
		
			//Build the query 
			$query = $db->getQuery(true)
						->select('COUNT(*)')
						->from($db->quoteName('#__confmgt_rev1ewers'))
						->where('created_by = '. (int)$user->id);
		}else{
						//Build the query 
			$query = $db->getQuery(true)
						->select('COUNT(*)')
						->from($db->quoteName('#__confmgt_rev1ewers'))
						->where('theme = '. (int)$themeid); 
		}
			
		//Prepare the query
		$db->setQuery($query);
		// Load the row.
		$row = $db->loadResult();	
		//check if user ceareted the record 
		$result = ($row > 0);
		//Return the Hello
		return $result; 
	}
	
	
	
}

