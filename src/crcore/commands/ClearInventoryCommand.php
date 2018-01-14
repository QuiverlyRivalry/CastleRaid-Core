<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors     : QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace crcore\commands;

use crcore\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ClearInventoryCommand extends PluginCommand{

	public function __construct(Loader $plugin){
		parent::__construct("clearinv", $plugin);
		$this->setDescription("Clears a player's inventory");
		$this->setPermission("castleraid.clearinv");
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 *
	 * @return bool|mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($this->testPermission($sender) and $sender instanceof Player){
			$sender->getInventory()->clearAll();
			$sender->sendMessage(TextFormat::AQUA . "You have now cleared your inventory!");
			$sender->addTitle(TextFormat::DARK_RED . "Inventory Cleared!");
			return true;
		}else{
			return false;
		}
	}
}