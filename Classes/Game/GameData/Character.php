<?php

namespace Nafai\Game\GameData;

require_once __DIR__."/Actions/Abilities/Ability.php";

use Nafai\Game\GameData\Actions\Abilities\Ability;

class Character {
    private $name;
    private $level;
    private $health;
    private $max_health;
    private $attack;
    private $defense;
    private $attack_speed;
    private $critical_chance;
    private $critical_damage;
    private $abilities;

    public function __construct(array $character_data) {
        if (!is_string($character_data['name'])) {
            throw new Exception("Character name must be string");
        } else {
            $this->name = $character_data['name'];
        }

        if (!is_integer($character_data['level'])) {
            throw new Exception("Character level must be integer");
        } else {
            $this->level = $character_data['level'];
        }

        if (!is_integer($character_data['health'])) {
            throw new Exception("Character health must be integer");
        } else {
            $this->health = $character_data['health'];
        }

        if (!is_integer($character_data['max_health'])) {
            throw new Exception("Character max health must be integer");
        } else {
            $this->max_health = $character_data['max_health'];
        }

        if (!is_integer($character_data['attack'])) {
            throw new Exception("Character attack must be integer");
        } else {
            $this->attack = $character_data['attack'];
        }

        if (!is_integer($character_data['defense'])) {
            throw new Exception("Character defense must be integer");
        } else {
            $this->defense = $character_data['defense'];
        }

        if (!is_integer($character_data['attack_speed'])) {
            throw new Exception("Character attack speed must be integer");
        } else {
            $this->attack_speed = $character_data['attack_speed'];
        }

        if (!is_integer($character_data['critical_chance'])) {
            throw new Exception("Character critical chance must be integer");
        } else {
            $this->critical_chance = $character_data['critical_chance'];
        }

        if (!is_float($character_data['critical_damage'])) {
            throw new Exception("Character critical damage must be float");
        } else {
            $this->critical_damage = $character_data['critical_damage'];
        }

        if (!is_array($character_data['abilities'])) {
            throw new Exception("Character abilities must be array");
        } else {
            $this->abilities = $character_data['abilities'];
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getHealth(): int {
        return $this->health;
    }

    public function getMaxHealth(): int {
        return $this->max_health;
    }

    public function getAttack(): int {
        return $this->attack;
    }

    public function getDefense(): int {
        return $this->defense;
    }

    public function getAttackSpeed(): int {
        return $this->attack_speed;
    }

    public function getCriticalChance(): int {
        return $this->critical_chance;
    }

    public function getCriticalDamage(): float {
        return $this->critical_damage;
    }

    public function addLevel(int $value): int {
        if ($value < 0) {
            throw new Exception("Can't decrease level");
        }
        $this->level += $value;

        return $this->level;
    }

    public function addHealth(int $value): int {
        $new_health = $this->health + $value;
        if ($new_health > $this->max_health) {
            throw new Exception("Can't increase health above max health");
        }
        $this->health = $new_health;

        return $this->health;
    }

    public function addMaxHealth(int $value): int {
        $new_max_health = $this->max_health + $value;
        if ($new_max_health <= 0) {
            throw new Exception("Max health can't be value below or equal to 0");
        }
        $this->max_health = $new_max_health;

        return $this->max_health;
    }

    public function addAttack(int $value): int {
        $new_attack = $this->attack + $value;
        if ($new_attack <= 0) {
            throw new Exception("Attack can't be value below or equal to 0");
        }
        $this->attack = $new_attack;

        return $this->attack;
    }

    public function addDefense(int $value): int {
        $new_defense = $this->defense + $value;
        if ($new_defense <= 0) {
            throw new Exception("Defense can't be value below or equal to 0");
        }
        $this->defense = $new_defense;

        return $this->defense;
    }

    public function addAttackSpeed(int $value): int {
        $new_attack_speed = $this->attack_speed + $value;
        if ($new_attack_speed < 0) {
            throw new Exception("Attack speed can't be value below 0");
        }
        $this->attack_speed = $new_attack_speed;

        return $this->attack_speed;
    }

    public function addCriticalChance(int $value): int {
        $new_critical_chance = $this->critical_chance + $value;
        if ($new_critical_chance < 0) {
            throw new Exception("Critical chance can't be value below 0");
        }
        $this->critical_chance = $new_critical_chance;

        return $this->critical_chance;
    }

    public function addCriticalDamage(float $value): float {
        $new_critical_damage = $this->critical_damage + $value;
        if ($new_critical_damage <= 1.0) {
            throw new Exception("Critical damage can't be value below or equal to 1.0");
        }
        $this->critical_damage = $new_critical_damage;

        return $this->critical_damage;
    }
}

?>