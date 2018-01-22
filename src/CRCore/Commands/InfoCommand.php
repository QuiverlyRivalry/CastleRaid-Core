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
use pocketmine\item\Item;
use pocketmine\item\WrittenBook;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class InfoCommand extends PluginCommand{

    public function __construct(Loader $plugin){
        parent::__construct("info", $plugin);
        $this->setDescription("CastleRaid Core Info Command");
        $this->setAliases(["information"]);
        $this->setPermission("castleraid.info");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender->hasPermission("castleraid.info")){
            if($sender instanceof Player){
                $book = Item::get(Item::WRITTEN_BOOK, 0, 1);
                $book->setTitle(TextFormat::GREEN . TextFormat::UNDERLINE . "Information Booklet");
                $book->setPageText(0, TextFormat::GREEN . TextFormat::UNDERLINE . "What's a Kingdom?" . TextFormat::BLACK . "\n - A kingdom, is your home, its like a factions. Except bigger! \n - Kingdoms, have many members and a custom world! \n - Each kingdom has a king, this king is who you shall fight for!");
                $book->setPageText(1, TextFormat::GREEN . TextFormat::UNDERLINE . "How can my Kingdom win?" . TextFormat::BLACK . "\n - You can earn power in the weekly wars, and from PvPing enemy kingdoms! \n - You can earn power in our KOTH at warzone.");
                $book->setPageText(2, TextFormat::GREEN . TextFormat::UNDERLINE . "How do I store my loot, and get loot?" . TextFormat::BLACK . "\n - Try doing /pv 1, for a vault! \n - Go to your kingdoms world, and make a base, skybase, or lair! \n - Make sure you raid other kingdoms' bases!");
                $book->setPageText(3, TextFormat::GREEN . TextFormat::UNDERLINE . "Helpful Commands" . TextFormat::BLACK . "\n- /k \n - /warpme \n - /pv \n - /shop \n - /cpshop \n - /mpshop \n - /menu");
                $book->setAuthor("CastleRaid Network");
                $sender->getInventory()->addItem($book);
                $sender->sendMessage(TextFormat::GREEN . "You received an Information Book!");
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