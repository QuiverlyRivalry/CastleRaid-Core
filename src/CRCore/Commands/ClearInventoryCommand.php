<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Jason.
 */
declare(strict_types=1);

namespace CRCore\Commands;

use CRCore\Loader;
use CRCore\API;
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

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender->hasPermission("castleraid.clearinv")){
            if($sender instanceof Player){
                $sender->getInventory()->clearAll();
                $sender->sendMessage(TextFormat::AQUA . "Your inventory has been cleared!");
                $sender->addTitle(TextFormat::DARK_RED . "Inventory cleared!");
                return true;
            }else{
                $sender->sendMessage(API::NOT_PLAYER);
            }
        }else{
            $sender->sendMessage(API::NO_PERMISSION);
        }
        return true;
    }
}