<?php

/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Confmgt records.
 */
class ConfmgtModelPapers extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();
		
		//Reset the link ID
		$linkid = JFactory::getApplication()->setUserState('com_confmgt.linkid', null);

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);
		
		//Get the current user
		
		$user = JFactory::getuser();

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );

        $query->from('`#__confmgt_papers` AS a');
		
		// Only the papers submitted by the user
		$query->where('a.created_by ='. $user->id);

        
    	// Join over the users for the checked out user.
    	$query->select('uc.name AS editor');
   		$query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
		
		//join the themes table
		$query->select('b.title AS themename');
   		$query->join('LEFT', '#__confmgt_themes AS b ON b.id=a.theme');
    
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		$query->order('a.id ASC');
        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%'); 
                
            }
        } 

        return $query;
    }
	
	
	
	protected function tmpRemoveQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);
		$user = JFactory::getUser();

        // Select the required fields from the table.
        $query->delete($db->quoteName('#__confmgt_papers'));
	    $query->where("title = ''");
		$query->where('created_by = '.$user->id);
 
        $db->setQuery($query);
		$result = $db->query();
    }

    public function getItems() {
		
		//remove temporary papers
		$this->tmpRemoveQuery();	
		
        return parent::getItems();
    }
	
	    /**
     * Method to get the paper list for theme leaders 
     *
     * @return	List
     * 
     */
	
	public function getLeadersitems() {
		
		// Get a db connection.
		$db = JFactory::getDbo();
		 
		// Create a new query object.
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		$query
			->select('a.*')
			->from('#__confmgt_papers as a')
			->select('b.title as theme')
			->join('LEFT', '#__confmgt_themes as b ON a.theme = b.id')
			->select('uc.name as author')
			->select('COUNT(d.reviewerid) AS rev1ewers')
			->join('LEFT', '#__users as uc ON uc.id = a.created_by')
			->join('LEFT', $db->quoteName('#__confmgt_rev1ewers_papers', 'd') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('d.paperid') . ')')
			->where('b.userid = '.$user->id) 
			->group('a.id')
			->order('a.id ASC');
		
		 
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		 
		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$results = $db->loadObjectList();

	return $results;
	}
	
}
