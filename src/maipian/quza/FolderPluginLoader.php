<?php

namespace maipian\quza;

use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginLoader;
use function file_exists;
use function file_get_contents;
use function is_dir;

class FolderPluginLoader implements PluginLoader{

	/** @var \DynamicClassLoader */
	private $loader;

	public function __construct(\DynamicClassLoader $loader){
		$this->loader = $loader;
	}

	public function canLoadPlugin(string $path) : bool{
		return is_dir($path) and file_exists($path . "/plugin.yml") and file_exists($path . "/src/");
	}

	/**
	 * Loads the plugin contained in $file
	 */
	public function loadPlugin(string $file) : void{
		$description = $this->getPluginDescription($file);
		if($description !== null){
			$this->loader->addPath($description->getSrcNamespacePrefix(), "$file/src");
		}
	}

	/**
	 * Gets the PluginDescription from the file
	 */
	public function getPluginDescription(string $file) : ?PluginDescription{
		if(is_dir($file) and file_exists($file . "/plugin.yml")){
			$yaml = @file_get_contents($file . "/plugin.yml");
			if($yaml != ""){
				return new PluginDescription($yaml);
			}
		}

		return null;
	}

	public function getAccessProtocol() : string{
		return "";
	}
}
