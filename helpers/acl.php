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
	
	public static function isRev1ewer($paperid = 0)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
		if ($paperid == 0) {
		
			//Build the query 
			$query = $db->getQuery(true)
						->select($db->quoteName(array('a.id', 'a.userid', 'a.agreed')))
						->from($db->quoteName('#__confmgt_rev1ewers', 'a'))
						->where('a.userid = '. (int)$user->id)
						->where('a.agreed = 1');
		}else{
						//Build the query 
			$query = $db->getQuery(true)
						->select($db->quoteName(array('a.*', 'b.username', 'b.name', 'b.id')))
						->from($db->quoteName('#__confmgt_rev1ewers_papers', 'a'))
						->join('INNER', $db->quoteName('#__users', 'b') . ' ON (' . $db->quoteName('a.userid') . ' = ' . $db->quoteName('b.id').')')
						->where('b.id = '. (int)$user->id)
						->where('a.paperid = '. (int)$paperid)
						->where('a.agreed = 1');
		}
			
		//Prepare the query
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		if (empty($rows)) {
			$result = false;
		}else{
			$result = true;
		}
		
		return $result; 
	}
	
	// function to get userid by entering the email 
	
	public static function getUserID($email)
	{
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
			$query = $db->getQuery(true)
						->select('id, email')
						->from($db->quoteName('#__users'))
						->where($db->quoteName('email').' = '.$db->quote($email));
			
		//Prepare the query
		$db->setQuery($query); 
		// Load the row.
		$row = $db->loadObject();
		print_r($query);
		if ($row) {
			return $row->id;
		}else{
			return false;
		}
	}
	
	//Function to get Reviewer ID by email
	public static function getRev1ewerID($email)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
			//Build the query 
			$query = $db->getQuery(true)
						->select($db->quoteName(array('a.id', 'a.userid', 'a.email', 'a.agreed'))) 
						->from($db->quoteName('#__confmgt_rev1ewers', 'a'))
						->where($db->quoteName('email').' = '.$db->quote($email));
			
		//Prepare the query
		$db->setQuery($query);
		$row = $db->loadObject();
		if ($row) {
			return $row;
		}else{
			return false;
		}
		
	}
	
	//Function to get the number of reviewers for a given paper
	public static function getNumofRev1ewers($paperid)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) {
			return false;
		}
		
			//Build the query 
			$query = $db->getQuery(true)
						->select($db->quoteName(array('a.id', 'a.userid', 'a.email', 'a.agreed'))) 
						->from($db->quoteName('#__confmgt_rev1ewers_papers', 'a'))
						->where($db->quoteName('paperid').' = '.(int)($paperid));
			
		//Prepare the query
		$db->setQuery($query);
		$db->execute();
		$num_rows = $db->getNumRows();
		if ($num_rows > 0) {
			return $num_rows;
		}else{
			return false;
		}
		
	}
		
	
}

