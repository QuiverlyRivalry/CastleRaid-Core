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

class HealCommand extends PluginCommand{

	public function __construct(Loader $plugin){
		parent::__construct("heal", $plugin);
		$this->setDescription("Heals a player");
		$this->setPermission("castleraid.heal");
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $commandLabel
	 * @param array         $args
	 *
	 * @return bool|mixed|void
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($this->testPermission($sender) and $sender instanceof Player){
			$sender->setHealth($sender->getMaxHealth());
			$sender->sendMessage(TextFormat::AQUA . "You have been healed!");
			$sender->addTitle(TextFormat::DARK_RED . "You have been healed!");
		}
	}
}