<?php

namespace auto;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\RegisteredListener;

class main extends PluginBase{
    public function onEnable(){
        $this->getLogger()->info("Plugin enabled");
        $this->getServer()->getPluginManager()->registerEvents(new response(), $this);
    }
    public function onLoad(){
       $this->getLogger()->info("Plugin loading");
    }
    public function onDisable(){
       $this->getLogger()->info("Plugin disabled");
    }

}
