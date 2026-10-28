<?php

declare(strict_types=1);

namespace Pablo\TicTacToeKata;

class WinnerChecker{
    public function winner(array $board): ?string{
        return $this->horizontalWinner($board)
            ?? $this->verticalWinner($board)
            ?? $this->mainDiagonalWinner($board)
            ?? $this->secondaryDiagonalWinner($board);
    }

    public function horizontalWinner(array $board): ?string{
        foreach($board as $row){
            if($row[0] !== '' && $row[0] === $row[1] && $row[1] === $row[2]){
                return $row[0];
            }
        }

        return null;
    }

    public function verticalWinner(array $board): ?string{
        for($column = 0; $column < 3; $column++){
            if($board[0][$column] !== '' 
            && $board[0][$column] === $board[1][$column]
            && $board[1][$column] === $board[2][$column]){
                return $board[0][$column];
            }
        }

        return null;
    }

    public function mainDiagonalWinner(array $board): ?string{
        if($board[0][0] !== ''
        && $board[0][0] === $board[1][1]
        && $board[1][1] === $board[2][2]){
            return $board[0][0];
        }

        return null;
    }

    private function secondaryDiagonalWinner(array $board): ?string{
        if($board[0][2] !== ''
        && $board[0][2] === $board[1][1]
        && $board[1][1] === $board[2][0]){
            return $board[0][2];
        }

        return null;
    }
}