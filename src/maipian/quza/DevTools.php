<?php

namespace maipian\quza;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permissible;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionAttachmentInfo;
use pocketmine\permission\PermissionManager;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use function assert;
use function buildPhar;
use function count;
use function date;
use function generatePluginMetadataFromYml;
use function implode;
use function ini_get;
use function php_ini_loaded_file;
use function realpath;
use function rtrim;
use function sprintf;
use function strtolower;
use function trim;
use const DEVTOOLS_PLUGIN_STUB;
use const DEVTOOLS_REQUIRE_FILE_STUB;
use const DIRECTORY_SEPARATOR;

class DevTools extends PluginBase{

	public function onLoad():void
    {
		$this->getServer()->getPluginManager()->registerInterface(new FolderPluginLoader($this->getServer()->getLoader()));
		$this->getLogger()->info("Registered folder plugin loader");
	}
}
