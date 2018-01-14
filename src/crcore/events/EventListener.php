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

namespace crcore\events;

use crcore\Loader;

use onebone\economyapi\EconomyAPI;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsResponsePacket;

use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;

class EventListener implements Listener{
	/** @var Loader */
	private $main;

	public function __construct(Loader $main){
		$this->main = $main;
		$main->getServer()->getPluginManager()->registerEvents($this, $main);
	}

	public function onDataPacket(DataPacketReceiveEvent $event) : void{
		$packet = $event->getPacket();
		if($packet instanceof ServerSettingsRequestPacket){
			$packet = new ServerSettingsResponsePacket();
			$packet->formData = file_get_contents($this->main->getDataFolder() . "tsconfig.json");
			$packet->formId = 5928;
			$event->getPlayer()->dataPacket($packet);
		}elseif($packet instanceof ModalFormResponsePacket){
			$formId = $packet->formId;
			if($formId !== 5928){
				return;
			}
		}
	}

	public function onJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$player->sendMessage(TextFormat::GREEN . "                     -=CastleRaid=-                ");
		$player->sendMessage(TextFormat::GRAY . "                                             ");
		$player->sendMessage(TextFormat::GRAY . "         A Kingdoms Minecraft Pocket Ediition Server        ");
		$player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   VOTE:" . TextFormat::GRAY . " http://bit.do/castleraid                   ");
		$player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . " DO:" . TextFormat::GRAY . " /menu                               ");
		$player->sendMessage(TextFormat::BOLD . TextFormat::AQUA . "   DONATE:" . TextFormat::GRAY . " castleraid.buycraft.net");
		$player->sendMessage(TextFormat::GRAY . "                                             ");
		$player->sendMessage(TextFormat::GREEN . "                    -=-                     ");
		switch($player->getName()){
			case "iiFlamiinBlaze":
				$this->main->getServer()->broadcastMessage("Blazes are love, blazes are life!");
				break;
			case "QuiverlyRivalry":
				$this->main->getServer()->broadcastMessage("Wb oh sir lord of our kingdoms!");
				break;
		}
		$h = round($player->getHealth()) / $player->getMaxHealth() * 100;
		$player->setNameTag($player->getDisplayName() . "\n" . TextFormat::RED . $h . "%");
	}

	public function onPlayerLogin(PlayerLoginEvent $event) : void{
		$event->getPlayer()->teleport($this->main->getServer()->getDefaultLevel()->getSafeSpawn());
	}

	public function onConsume(PlayerItemConsumeEvent $event) : void{
		$player = $event->getPlayer();
		$inv = $player->getInventory();
		$hand = $inv->getItemInHand();
		if($hand->getId() === 373 && $hand->getDamage() === 1){
			$player->addEffect(Effect::getEffect(Effect::STRENGTH)->setAmplifier(3)->setDuration(2000));
			$inv->removeItem($hand);
		}
	}

	public function onInteract(PlayerInteractEvent $event) : void{
		$player = $event->getPlayer();
		$item = $event->getItem();
		$inventory = $player->getInventory();
		$economy = EconomyAPI::getInstance();
		if($item->getId() === 130){
			$damage = $item->getDamage();
			switch($damage){
				case 101:
					$tier1 = Item::get(Item::ENDER_CHEST, 101, 1);
					$tier1win = rand(10000, 25000);
					$economy->addMoney($player, $tier1win);
					$player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier1win);
					$inventory->removeItem($tier1);
					break;
				case 102:
					$tier2 = Item::get(Item::ENDER_CHEST, 102, 1);
					$tier2win = rand(25000, 50000);
					$economy->addMoney($player, $tier2win);
					$player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier2win);
					$inventory->removeItem($tier2);
					break;
				case 103:
					$tier3 = Item::get(Item::ENDER_CHEST, 103, 1);
					$tier3win = rand(50000, 100000);
					$economy->addMoney($player, $tier3win);
					$player->addTitle(TextFormat::BOLD . TextFormat::DARK_GRAY . "(" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . ") " . TextFormat::RESET . TextFormat::GRAY . "You have won:", TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "$" . $tier3win);
					$inventory->removeItem($tier3);
					break;
			}
		}
	}

	public function onEntityDamage(EntityDamageEvent $e){
		$p = $e->getEntity();
		if($p instanceof Player){
			$h = round($p->getHealth()) / $p->getMaxHealth() * 100;
			$p->setNameTag($p->getDisplayName() . "\n" . TextFormat::RED . $h . "%");
		}
	}
}
