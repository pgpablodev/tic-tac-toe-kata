<?php

declare(strict_types=1);

namespace Pablo\TicTacToeKata\Tests;

use PHPUnit\Framework\TestCase;
use Pablo\TicTacToeKata\TicTacToe;

class TicTacToeTest extends TestCase{
    public function testGameStartsWithAnEmptyBoard(): void{
        $game = new TicTacToe();

        self::assertSame([
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ], $game->board());
    }

    public function testXStartsTheGame(): void{
        $game = new TicTacToe();
        self::assertSame('X', $game->currentPlayer());
    }

    
    public function testPlayerCanMakeAMoveAndTurnChanges(): void{
        $game = new TicTacToe();

        $game->play(0, 0);

        self::assertSame('X', $game->board()[0][0]);
        self::assertSame('O', $game->currentPlayer());
    }

    public function testCannotPlayOnAnOccupiedPosition(): void{
        $game = new TicTacToe();
        $game->play(0, 0);

        $this->expectException(\InvalidArgumentException::class);

        $game->play(0, 0);
    }

    public function testInvalidMoveDoesNotChangeTheCurrentPlayer(): void{
        $game = new TicTacToe();
        $game->play(0, 0);

        try {
            $game->play(0, 0);
        } catch (\InvalidArgumentException) {
            
        }

        self::assertSame('O', $game->currentPlayer());
        self::assertSame('X', $game->board()[0][0]);
    }

    public function testPlayerWinsWithThreeSymbolsHorizontally(): void{
        $game = new TicTacToe();

        $game->play(0, 0); // X
        $game->play(1, 0); // O
        $game->play(0, 1); // X
        $game->play(1, 1); // O
        $game->play(0, 2); // X

        self::assertSame('X', $game->winner());
    }

    
    public function testPlayerWinsWithThreeSymbolsVertically(): void{
        $game = new TicTacToe();

        $game->play(0, 0); // X
        $game->play(0, 1); // O
        $game->play(1, 0); // X
        $game->play(1, 1); // O
        $game->play(2, 0); // X

        self::assertSame('X', $game->winner());
    }

    public function testPlayerWinsWithMainDiagonal(): void{
        $game = new TicTacToe();

        $game->play(0, 0); // X
        $game->play(0, 1); // O
        $game->play(1, 1); // X
        $game->play(0, 2); // O
        $game->play(2, 2); // X

        self::assertSame('X', $game->winner());
    }

    public function testPlayerWinsWithSecondaryDiagonal(): void{
        $game = new TicTacToe();

        $game->play(0, 2); // X
        $game->play(0, 0); // O
        $game->play(1, 1); // X
        $game->play(1, 0); // O
        $game->play(2, 0); // X

        self::assertSame('X', $game->winner());
    }

    public function testCannotPlayAfterAPlayerHasWon(): void{
        $game = new TicTacToe();

        $game->play(0, 0); // X
        $game->play(1, 0); // O
        $game->play(0, 1); // X
        $game->play(1, 1); // O
        $game->play(0, 2); // X wins

        $this->expectException(\LogicException::class);

        $game->play(2, 2);
    }

    public function testGameIsDrawWhenBoardIsFullWithoutWinner(): void{
        $game = new TicTacToe();

        $game->play(0, 0); // X
        $game->play(0, 1); // O
        $game->play(0, 2); // X
        $game->play(1, 1); // O
        $game->play(1, 0); // X
        $game->play(1, 2); // O
        $game->play(2, 1); // X
        $game->play(2, 0); // O
        $game->play(2, 2); // X

        self::assertTrue($game->isDraw());
        self::assertNull($game->winner());
    }

    public function testCannotPlayAfterADraw(): void{
        $game = new TicTacToe();

        $game->play(0, 0);
        $game->play(0, 1);
        $game->play(0, 2);
        $game->play(1, 1);
        $game->play(1, 0);
        $game->play(1, 2);
        $game->play(2, 1);
        $game->play(2, 0);
        $game->play(2, 2);

        $this->expectException(\LogicException::class);

        $game->play(0, 0);
    }
}