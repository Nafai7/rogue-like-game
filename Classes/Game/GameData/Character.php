<?php

namespace Nafai\Game\GameData;

require_once __DIR__."/Actions/Abilities/Ability.php";

use Nafai\Game\GameData\Actions\Abilities\Ability;

class Character {
    private $character_name;
    private $character_level;
    private $character_health;
    private $character_max_health;
    private $character_attack;
    private $character_defense;
    private $character_attack_speed;
    private $character_critical_chance;
    private $character_critical_damage;
    private $character_abilities;

    public function __construct(array $character_data) {
        if (!is_string($character_data['character_name'])) {
            throw new Exception("Character name must be string");
        } else {
            $this->character_name = $character_data['character_name'];
        }

        if (!is_integer($character_data['character_level'])) {
            throw new Exception("Character level must be integer");
        } else {
            $this->character_level = $character_data['character_level'];
        }

        if (!is_integer($character_data['character_health'])) {
            throw new Exception("Character health must be integer");
        } else {
            $this->character_health = $character_data['character_health'];
        }

        if (!is_integer($character_data['character_max_health'])) {
            throw new Exception("Character max health must be integer");
        } else {
            $this->character_max_health = $character_data['character_max_health'];
        }

        if (!is_integer($character_data['character_attack'])) {
            throw new Exception("Character attack must be integer");
        } else {
            $this->character_attack = $character_data['character_attack'];
        }

        if (!is_integer($character_data['character_defense'])) {
            throw new Exception("Character defense must be integer");
        } else {
            $this->character_defense = $character_data['character_defense'];
        }

        if (!is_integer($character_data['character_attack_speed'])) {
            throw new Exception("Character attack speed must be integer");
        } else {
            $this->character_attack_speed = $character_data['character_attack_speed'];
        }

        if (!is_integer($character_data['character_critical_chance'])) {
            throw new Exception("Character critical chance must be integer");
        } else {
            $this->character_critical_chance = $character_data['character_critical_chance'];
        }

        if (!is_float($character_data['character_critical_damage'])) {
            throw new Exception("Character critical damage must be float");
        } else {
            $this->character_critical_damage = $character_data['character_critical_damage'];
        }

        if (!is_array($character_data['character_abilities'])) {
            throw new Exception("Character abilities must be array");
        } else {
            $this->character_abilities = $character_data['character_abilities'];
        }
    } 
}

?>