<?php

declare(strict_types=1);

namespace Pablo\TicTacToeKata;

class TicTacToe{
    private Player $currentPlayer;
    private WinnerChecker $winnerChecker;
    private Board $board;

    public function __construct(){
        $this->currentPlayer = Player::X;
        $this->winnerChecker = new WinnerChecker();
        $this->board = new Board();
    }

    public function board(): array{
        return $this->board->cells();
    }

    public function currentPlayer(): string{
        return $this->currentPlayer->value;
    }

    
    public function play(int $row, int $column): void{
        if($this->winner() !== null || $this->isDraw()){
            throw new \LogicException('The game has already been won');
        }

        $this->board->place($row, $column, $this->currentPlayer);

        $this->currentPlayer = $this->currentPlayer->next();
    }

    
    public function winner(): ?string{
        return $this->winnerChecker->winner($this->board->cells());
    }

    public function isDraw(): bool{
        if($this->winner() !== null){
            return false;
        }

        foreach($this->board() as $row){
            if(in_array('', $row, true)){
                return false;
            }
        }

        return true;
    }
}