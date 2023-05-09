<?php

namespace Nafai\Game\GameData\Characters;

require_once __DIR__."/Character.php";

use Nafai\Game\GameData\Characters\Character;

class Enemy {
    private Character $character;
    private int $base_experience;
    private int $spawn_biome_id;

    public function __construct(Character $character, int $base_experience, int $spawn_biome_id) {
        $this->character = $character;
        $this->base_experience = $base_experience;
        $this->spawn_biome_id = $spawn_biome_id;
    }

    public function getCharacter(): Character {
        return $this->character;
    }

    public function getKillExperience(): int {
        return $this->character->getLevel() * $this->base_experience;
    }

    public function getSpawnBiomeID(): int {
        return $this->spawn_biome_id;
    }
}

?>