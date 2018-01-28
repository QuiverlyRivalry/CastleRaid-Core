<?php
/**
 * -==+CastleRaid Core+==-
 * Originally Created by QuiverlyRivarly
 * Originally Created for CastleRaidPE
 *
 * @authors: QuiverlyRivarly and iiFlamiinBlaze
 * @contributors: Nick, Potatoe, and Nice.
 */
declare(strict_types=1);

namespace CRCore\Commands\Guest;

use CRCore\API;
use CRCore\Commands\BaseCommand;
use CRCore\Forms\FeedbackForm;
use CRCore\Loader;
use pocketmine\command\CommandSender;
use pocketmine\form\element\Input;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FeedbackCommand extends BaseCommand{

    public function __construct(Loader $plugin){
        parent::__construct($plugin, "feedback", "Gives us feedback", "/feedback", ["fb"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(API::NOT_PLAYER);
        }
        if(!$sender->hasPermission("castleraid.feedback")){
            $sender->sendMessage(API::NO_PERMISSION);
        }
        $sender->sendForm($this->makeForm());
    }

    public function makeForm() : FeedbackForm{
        $f = new FeedbackForm(TextFormat::BLUE . "Feedback", [new Input("Write your feedback/suggestion/bug report here!", "Vaults don't work.")]);
        return $f;
    }
}