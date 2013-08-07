<?php
namespace wcf\data\user\group\premiumGroup;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to edit premium groups.
 * 
 * @author	Joshua Rüsweg
 * @package	de.joshsboard.jcoins
 */
class PremiumGroupEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\user\group\premiumGroup\PremiumGroup';
}
