<?php
namespace auto;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
class response implements Listener {
    public function Auto(PlayerChatEvent $event)
    {
        $message = $event->getMessage();
        $player = $event->getPlayer();
        $name = $player->getName();
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("AutoResponse");
        if ($plugin !== null) {
            if ($message == "Hello") {
                $plugin->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($name, $plugin): void {
                    if (!$player = $plugin->getServer()->getPlayer($name)) return;
                    $player->sendMessage(TextFormat::AQUA . "Hello $name, " . TextFormat::GRAY . "Hint: say `How are you?' Next!");
                }), 2);
            }
            if ($message == "How are you?") {
                $plugin->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($name, $plugin): void {
                    if (!$player = $plugin->getServer()->getPlayer($name)) return;
                    $player->sendMessage(TextFormat::AQUA . "Good thanks for asking!");
                    $player->sendMessage(TextFormat::RED . "So..Sorr..Sorry booting offline.");
                    $player->sendMessage(TextFormat::GRAY . "Beep Boop.");
                    $player->sendMessage(TextFormat::DARK_GRAY . "NOW OFFLINE");
                }), 2);
            }
        }
    }
    public function Broadcast(PlayerJoinEvent $joinEvent) {
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("AutoResponse");
        $name = $joinEvent->getPlayer()->getName();
        $plugin->getScheduler()->scheduleDelayedTask(new ClosureTask(function (int $currentTick) use ($name, $plugin): void{
            if(!$player = $plugin->getServer()->getPlayer($name)) return;
            $player->sendMessage(TextFormat::RED . "Type 'Hello' to begin!");
        }), 2);
    }
}