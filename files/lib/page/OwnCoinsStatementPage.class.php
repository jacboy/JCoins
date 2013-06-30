<?php
namespace wcf\page;
use wcf\page\SortablePage;
use wcf\system\WCF;

/**
 * all own statements page
 * 
 * @author	Joshua Rüsweg
 * @package	de.joshsboard.jcoins
 * @subpackage	wcf.page
 */
class OwnCoinsStatementPage extends SortablePage {
    
	/**
	 * @see	wcf\page\AbstractPage::$loginRequired
	 */
	public $loginRequired = true;
	
	/**
	 * @see	wcf\page\AbstractPage::$neededModules
	 */
	public $neededModules = array('MODULE_JCOINS');
	
	/**
	 * @see	wcf\page\MultipleLinkPage::$itemsPerPage
	 */
	public $itemsPerPage = 25;

	/**
	 * @see	wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'time';

	/**
	 * @see	wcf\page\SortablePage::$defaultSortOrder
	 */
	public $defaultSortOrder = 'DESC';

	/**
	 * @see	wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('entryID', 'executedUserID', 'reason', 'sum', 'time');

	/**
	 * @see	wcf\page\MultipleLinkPage::$objectListClassName
	 */
	public $objectListClassName = 'wcf\data\jCoins\statement\StatementList';
	
	/**
	 * @see	wcf\page\MultipleLinkPage::initObjectList()
	 */
	protected function initObjectList() {
		parent::initObjectList();

		$this->objectList->getConditionBuilder()->add("statement_entrys.userID = ? AND statement_entrys.isTrashed = 0", array(WCF::getUser()->userID));
	}
}