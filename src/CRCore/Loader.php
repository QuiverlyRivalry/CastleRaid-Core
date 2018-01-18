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

namespace CRCore;

use CRCore\Commands\ClearInventoryCommand;
use CRCore\Commands\CustomPotionsCommand;
use CRCore\Commands\FlyCommand;
use CRCore\Commands\HealCommand;
use CRCore\Commands\InfoCommand;
use CRCore\Commands\MenuCommand;
use CRCore\Commands\MPShopCommand;
use CRCore\Commands\NickCommand;
use CRCore\Commands\FeedCommand;
use CRCore\Commands\QuestsCommand;

use CRCore\Events\EventListener;
use CRCore\Events\PotionListener;
use CRCore\Events\RelicListener;

use CRCore\Tasks\BroadcastTask;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase {

    public $tutorial;

    const NO_PERMISSION = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "You don't have permission to use this command";
    const NOT_PLAYER = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "Use this command in-game";
    const CORE_VERSION = "v1.4.6";

    public function onLoad(): void {
        $this->saveDefaultConfig();
        $this->saveResource("tsconfig.json");
    }

    public function onEnable(): void {
        new EventListener($this);
        new PotionListener($this);
        new RelicListener($this);
        
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), 2400);

        $this->getServer()->getCommandMap()->registerAll("CRCore", [
            new ClearInventoryCommand($this),
            new CustomPotionsCommand($this),
            new FlyCommand($this),
            new HealCommand($this),
            new InfoCommand($this),
            new MenuCommand($this),
            new MPShopCommand($this),
            new NickCommand($this),
            new FeedCommand($this),
            new QuestsCommand($this)
        ]);
    }
}
