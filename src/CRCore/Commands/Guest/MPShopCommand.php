<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: CastleRaid Developer Team
 */
declare(strict_types=1);

namespace CRCore\Commands\Guest;

use CRCore\API;
use CRCore\Commands\BaseCommand;
use CRCore\Loader;
use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MPShopCommand extends BaseCommand{

    public $nomoney = TextFormat::RED . "You don't have enough money.";

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "mp", "MoneyPouch Shop", "/mp", ["mp"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
            return false;
        }
        if(!$sender->hasPermission("castleraid.mp")){
            $sender->sendMessage(parent::NO_PERMISSION);
            return false;
        }
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, array $data){
            if(isset($data[0])){
                switch($data[0]){
                    case 0:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if($money >= 20000){
                            $itemID = 130;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 101, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "1" . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$10,000 - $25,000"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 20000);
                        }else{
                            $sender->sendMessage($this->nomoney);
                        }
                        break;
                    case 1:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if($money >= 40000){
                            $itemID = 130;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 102, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "2" . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$25,000 - $50,000"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 40000);
                        }else{
                            $sender->sendMessage($this->nomoney);
                        }
                        break;
                    case 2:
                        $money = EconomyAPI::getInstance()->myMoney($sender->getName());
                        if($money >= 80000){
                            $itemID = 130;
                            $inv = $sender->getInventory();
                            $inv->addItem(Item::get($itemID, 103, 1)->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Money Pouch" . TextFormat::RESET . TextFormat::GRAY . " (Tap anywhere)" . PHP_EOL . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Tier Level: " . TextFormat::GRAY . "3" . PHP_EOL .
                                TextFormat::DARK_GRAY . " *" . TextFormat::AQUA . " Amount to win: " . TextFormat::GRAY . "$50,000 - $100,000"));
                            EconomyAPI::getInstance()->reduceMoney($sender, 80000);
                        }else{
                            $sender->sendMessage($this->nomoney);
                        }
                        break;
                }
            }
        });
        $form->setTitle("Money Pouch Shop");
        $form->setContent("Money Pouches available below!\nTier 1: Win between $10,000 to $25,000\nTier 2: Win between $25,000 to $50,000\nTier 3: Win between $50,000 t0 $100,000");
        $form->addButton(TextFormat::DARK_AQUA . "Tier 1 | $20k");
        $form->addButton(TextFormat::DARK_GREEN . "Tier 2 | $40k");
        $form->addButton(TextFormat::DARK_RED . "Tier 3 | $80k");
        $form->sendToPlayer($sender);
        return true;
    }
}
