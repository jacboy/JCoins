<?php
namespace wcf\data\jcoins\shop\item;

use wcf\data\DatabaseObject;

/**
 * Represents a shop item type. 
 * 
 * @author	Joshua Rüsweg
 * @package	de.joshsboard.jcoins
 */
class JCoinsShopItem extends DatabaseObject implements \wcf\system\request\IRouteController {

	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'jcoins_shop_item';

	/**
	 * @see	\wcf\data\DatabaseObject::$databaseIndexName
	 */
	protected static $databaseTableIndexName = 'itemID';
	
	public $type = null; 
	
	private $boughtCache = array(); 
	
	public function __construct($id, array $row = null, DatabaseObject $object = null) {
		parent::__construct($id, $row, $object);
		
		$this->type = \wcf\system\jcoins\shop\ShopHandler::getInstance()->getItemTypeByID($this->itemType);
	}
	
	/**
	 * get the shop-item-type
	 */
	public function getType() {
		return $this->type; 
	}
	
	public function canBuy($userID = null) {
		if ($userID === null) {
			$userID = \wcf\system\WCF::getSession()->userID; 
		}
		
		if ($userID == 0) return false; // guest cannot buy products
		
		if ($this->price > \wcf\system\WCF::getSession()->jCoinsBalance) return false; 
		
		if (!$this->type->isMultiple() && $this->hasBought()) return false; 
		
		return true; 
	}
	
	public function hasBought($userID = null) {
		if ($userID === null) {
			$userID = \wcf\system\WCF::getSession()->userID; 
		}
		
		// is this already cached? :) 
		if (isset($this->boughtCache[$userID])) return $this->boughtCache[$userID]; 
		
		// we first assume that he has not bought it
		// we can change this, if he has bought it yet
		$this->boughtCache[$userID] = false; 
		
		if ($userID == 0) return false; // guest cannot buy products
		
		// we must query the database :/ 
		// but it is not reasonable to directly caching all users
		$sql = "SELECT COUNT(*) as count FROM wcf". WCF_N ."_jcoins_shop_item_bought WHERE userID = ? AND itemID = ?";
		$stmt = \wcf\system\WCF::getDB()->prepareStatement($sql); 
		$stmt->execute(array($userID, $this->itemID));
		
		if ($stmt->fetchColumn() > 0) {
			$this->boughtCache[$userID] = true; 
			return true; 
		}
		
		return false; 
	}
	
	public function isMultiple() {
		return $this->type->isMultiple(); 
	}
	
	/**
	 * @see \wcf\data\ITitledObject::getTitle()
	 */
	public function getTitle() {
		return $this->name; 
	}
}
