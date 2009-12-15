<?php

defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'views'.DS.'project'.DS.'view.html.php' );
// require_once( JPATH_COMPONENT.DS.'tables'.DS.'project'.DS.'view.html.php' );
class Controller_Faq extends JhprojectController 
{
	/**
	 * @name index
	 * @access public
	 * @details default task method, list of faq items
	 * @param none
	 * @return null
	 */
	public function index()
	{
		$model = $this->loadModel('JhProjectFaq');
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		$data['faqs'] = $model->fetchAll(null,null,$limit,$limitStart);
		
		$model = $this->loadModel('JhProjectFaqCats');
		$data['faqCats'] = $model->fetchKeyPair('id','name');
		
		$model = $this->loadModel('JhProject');
		$data['projects'] = $model->fetchKeyPair('id','name');
		Viewproject::display('faqlist',$data);
		
		
// 		$nmodel = $this->loadModel('JhProject');
// 		$md = $nmodel->fetchKeyArray('id',array('name'));
// 		print_r($md);
// 		$cd = $nmodel->fetchKeyPair('id','name');
// 		print_r($cd);
	}
	
	/**
	* @name editfaq
	* @access public
	* @details edit faq data
	* @param none
	* @return null
	*/
	function editfaq()
	{
		$model = $this->loadModel('JhProjectFaq');
		$faq_id = JRequest::getVar('faq_id');
		if(is_array($faq_id)) $faq_id = $faq_id[0];
		$model->load($faq_id);
		$data['faq'] = $model;
		Viewproject::display('faqform',$data);
	}
	
	/**
	* @name savefaq
	* @access public
	* @details saves posted data for faq
	* @param none
	* @return null
	*/
	function savefaq()
	{
		$model = $this->loadModel('JhProjectFaq');
		$model->bind($_POST);
		$model->store();
		$this->setRedirect('index.php?option=com_jhproject&controller=faq', JText::_('FAQ Updated'));
	}
	
	/**
	* @name listcats
	* @access public
	* @details list of faq categories
	* @param none
	* @return null
	*/
	function listcats()
	{
		$model = $this->loadModel('JhProjectFaqCats');
		$mainframe = & JFactory::getApplication();
		$limit = JRequest::getCmd('limit',$mainframe->getCfg('list_limit'));
		$limitStart = JRequest::getCmd('limitstart',0);
		$data['faqcats'] = $model->fetchAll(null,null,$limit,$limitstart);
		Viewproject::display('faqcatlist',$data);
	}
	
	/**
	* @name editcat
	* @access public
	* @details editable data for the faq category
	* @param none
	* @return null
	*/
	function editcat()
	{
		$model = $this->loadModel('JhProjectFaqCats');
		$cat_id = JRequest::getVar('cat_id');
		if(is_array($cat_id)) $cat_id = $cat_id[0];
		$model->load($cat_id);
		$data['cat'] = $model;
		Viewproject::display('faqcatform',$data);
	}
	
	/**
	* @name index
	* @access public
	* @details save faq category
	* @param none
	* @return null
	*/
	function savecat()
	{
		$model = $this->loadModel('JhProjectFaqCats');
		$model->bind($_POST);
		$model->store();
		$this->setRedirect('index.php?option=com_jhproject&controller=faq&task=listcats',JText::_('FAQ Categories Updated'));
	}
	
	/**
	* @name catpublish
	* @access public
	* @details publish faq category
	* @param none
	* @return null
	*/
	function catpublish()
	{
		
	}
	
	/**
	* @name catunpublish
	* @access public
	* @details unpublish faq category
	* @param none
	* @return null
	*/
	function catunpublish()
	{
		
	}
	
	/**
	* @name catremove
	* @access public
	* @details delete faq category
	* @param none
	* @return null
	*/
	function catremove()
	{
		
	}
	
	/**
	* @name publish
	* @access public
	* @details publish faq item
	* @param none
	* @return null
	*/
	function publish()
	{
		
	}
	
	/**
	* @name unpublish
	* @access public
	* @details unpublish faq item
	* @param none
	* @return null
	*/
	function unpublish()
	{
		
	}
	
	/**
	* @name remove
	* @access public
	* @details delete faq item
	* @param none
	* @return null
	*/
	function remove()
	{
		
	}
	
	//TODO Publish functions!
	
}
