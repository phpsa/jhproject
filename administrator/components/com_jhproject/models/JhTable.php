<?php

Class JhTable extends JTable
{

	/**
	 * @name __construct
	 * @access public
	 * @details constuctor class, calls JTable::_Construct with the table name, table key and database object
	 * @return null
	 */
	function __construct()
	{
		$db	=& JFactory::getDBO();
		parent::__construct( $this->_tbl, $this->_tbl_key, $db );
	}
	
	/**
	 * @name fetchRow
	 * @access public
	 * @details alias to JTable::load
	 * @param $oid int/null
	 * @return array
	 */
	function fetchRow($oid = null)
	{
		return parent::load( $oid);
	}
	
	/**
	 * @name fetchOne
	 * @access public
	 * @details alias to JTable::loadResult
	 * @param $field text
	 * @param $oid int/null
	 * @return $field on success false of failure
	 */
	function fetchOne($field,$oid = null)
	{
		$k = $this->_tbl_key;

		if ($oid !== null) 
		{
			$this->$k = $oid;
		}

		$oid = $this->$k;
		
		$db =& $this->getDBO();

		$query = 'SELECT `'.$field.'`'
		. ' FROM '.$this->_tbl
		. ' WHERE '.$this->_tbl_key.' = '.$db->Quote($oid);
		$db->setQuery( $query );

		if ($result = $db->loadResult( )) {
			return $result;
		}
		else
		{
			$this->setError( $db->getErrorMsg() );
			return false;
		}
	}
	
	/**
	 * @name fetchAll
	 * @access public
	 * @details Fetch all results based on query
	 * @param $where text/null
	 * @param $order text/null
	 * @param $limit int
	 * @param $limitstart int
	 * @return Array / object
	 */
	function fetchAll($where = null,$order = null, $limit = 0, $limitstart = 0)
	{
		$db =& $this->getDBO();
		$query = "Select * from " . $this->_tbl . " ";
		if($where !== null && $where != '')
			$query .= " WHERE $where ";
		if($order !== null && $order != '')
			$query .= " ORDER BY $order ";
		if($limit > 0)
		{
			jimport('joomla.html.pagination');
			$total = $this->fetchCount($where);
			$pageNav = new JPagination( $total, $limitstart, $limit );
			$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
			$result = $db->loadObjectList();
			//print_r($query);
			return array('PageNav'=>$pageNav,'rows'=>$result);
			
		}else{
			$db->setQuery($query);
			if ($result = $db->loadObjectList()) {
				return $result;
			}
		}
		
			$this->setError( $db->getErrorMsg() );
			return false;
		
	}
	
	/**
	 * @name fetchCount
	 * @access public
	 * @details returns count of rows
	 * @param $where text/null
	 * @return int on success false on failure
	 */
	function fetchCount($where = null)
	{
		$query = "Select count(*) as cnted from `" . $this->_tbl . "` ";
		if($where !== null && $where != '')
			$query .= "Where $where";
		$db =& $this->getDBO();
		$db->setQuery($query);
		if ($result = $db->loadResult( )) {
			return $result;
		}
		else
		{
			$this->setError( $db->getErrorMsg() );
			return false;
		}
	}
	
	/**
	 * @name insert
	 * @access public
	 * @details alias to JTable::store
	 * @param none
	 * @return int
	 */
	function insert()
	{
		return $this->store();
	}
	
	/**
	 * @name query
	 * @access public 
	 * @details custom query
	 * @param $query
	 * @return dbQuery
	 */
	function query($query)
	{
		$db =& $this->getDBO();
		$db->setQuery($query);
		return $db->query();
	}
	
	/**
	 * @name deleteList
	 * @access public
	 * @details Delete 1 or more items from the table
	 * @param $oid, null/int/array
	 * @return bool
	 */
	function deleteList( $oid=null )
	{
		$k = $this->_tbl_key;
		if(!is_array($oid)) $oid = array($oid);
		JArrayHelper::toInteger( $oid );
		
		$query = 'DELETE FROM '.$this->_db->nameQuote( $this->_tbl ).
		' WHERE '.$this->_tbl_key.' in ('. implode(",",$oid) . ')';
		$this->_db->setQuery( $query );
		
		if ($this->_db->query())
		{
			return true;
		}
		else
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	}
	
	/**
	 * @name fetchKeyArray
	 * @access public
	 * @details fetch array with specified index
	 * @param $key text
	 * @param $value array
	 * @param $where text
	 * @return Array
	 */
	function fetchKeyArray($key,$value,$where='')
	{
		$db =& $this->getDBO();
		$db->setQuery("select `$key`,`".implode("`,`",$value)."` from `{$this->_tbl}` {$where} order by `$key` asc");
		$result = $db->loadAssocList($key);
		
		return $result;
	}
	
	/**
	 * @name fetchKeyPair
	 * @access public
	 * @details fetch Indexed Array based on $key and $value
	 * @param $key text
	 * @param $value text
	 * @param $where text
	 * @return array
	 */
	function fetchKeyPair($key,$value,$where='')
	{
		$db =& $this->getDBO();
		$db->setQuery("select `$key`,`$value` from `{$this->_tbl}` {$where} order by `$key` asc");
		$result = $db->loadAssocList();
		$return = array();
		foreach($result as $res)
			$return[$res[$key]] = $res[$value];
		
		return $return;
	
	}
}