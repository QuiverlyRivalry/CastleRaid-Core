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

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class API {
    /** @var Loader $main */
    public static $main;

    /** @var Config $names */
    public static $names;

    /** @var Config $chat */
    public static $chat;

    const NO_PERMISSION = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "You don't have permission to use this command";
    const NOT_PLAYER = TextFormat::BOLD . TextFormat::GRAY . "(" . TextFormat::RED . "!" . TextFormat::GRAY . ")" . TextFormat::RED . "Use this command in-game";
    const CORE_VERSION = "v1.4.6";

    public static function getRandomName() : string{
        $n = self::$names->getNested("names");
        return $n[array_rand($n)];
    }

    public static function getRandomChat() : string{
        $c = self::$chat->getNested("chat");
        return $c[array_rand($c)];
    }
}