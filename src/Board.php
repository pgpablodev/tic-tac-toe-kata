<?php

declare(strict_types=1);

namespace Pablo\TicTacToeKata;

class Board{
    private array $cells = [
        ['', '', ''],
        ['', '', ''],
        ['', '', ''],
    ];

    public function place(int $row, int $column, Player $player): void{
        if(!isset($this->cells[$row][$column]) || $this->cells[$row][$column] !== ''){
            throw new \InvalidArgumentException('Invalid move');
        }

        $this->cells[$row][$column] = $player->value;
    }

    public function cells(): array{
        return $this->cells;
    }
}