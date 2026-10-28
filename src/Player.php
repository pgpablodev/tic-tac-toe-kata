<?php

declare(strict_types=1);

namespace Pablo\TicTacToeKata;

enum Player: string{
    case X = 'X';
    case O = 'O';

    public function next(): self
    {
        return $this === self::X ? self::O : self::X;
    }
}