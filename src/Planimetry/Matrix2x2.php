<?php

/* ========================================================================== *
 *   Copyright 2019-2021 Andrey Pokidov <andrey.pokidov@gmail.com>            *
 *                                                                            *
 *   Licensed under the Apache License, Version 2.0 (the "License");          *
 *   you may not use this file except in compliance with the License.         *
 *   You may obtain a copy of the License at                                  *
 *                                                                            *
 *       http://www.apache.org/licenses/LICENSE-2.0                           *
 *                                                                            *
 *   Unless required by applicable law or agreed to in writing, software      *
 *   distributed under the License is distributed on an "AS IS" BASIS,        *
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. *
 *   See the License for the specific language governing permissions and      *
 *   limitations under the License.                                           *
 * ========================================================================== */

namespace CleverST\Geometry\Planimetry;

use CleverST\Geometry\GeometryException;

/**
 * Description of Matrix2x2
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 11:54:35
 */
class Matrix2x2
{
    const DEFAULT_CELL_VALUE = 0.0;
    
    public float $r1c1 = self::DEFAULT_CELL_VALUE;
    public float $r1c2 = self::DEFAULT_CELL_VALUE;
    public float $r2c1 = self::DEFAULT_CELL_VALUE;
    public float $r2c2 = self::DEFAULT_CELL_VALUE;
    
    public function loadIdentity()
    {
        $this->r1c1 = 1.0;
        $this->r1c2 = 0.0;
        $this->r2c1 = 0.0;
        $this->r2c2 = 1.0;
    }
    
    public function loadZero()
    {
        $this->r1c1 = self::DEFAULT_CELL_VALUE;
        $this->r1c2 = self::DEFAULT_CELL_VALUE;
        $this->r2c1 = self::DEFAULT_CELL_VALUE;
        $this->r2c2 = self::DEFAULT_CELL_VALUE;
    }
    
    public function copyValuesTo(Matrix2x2 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        $matrix->r1c1 = $this->r1c1;
        $matrix->r1c2 = $this->r1c2;
        $matrix->r2c1 = $this->r2c1;
        $matrix->r2c2 = $this->r2c2;
    }
    
    public function copyValuesFrom(Matrix2x2 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        $this->r1c1 = $matrix->r1c1;
        $this->r1c2 = $matrix->r1c2;
        $this->r2c1 = $matrix->r2c1;
        $this->r2c2 = $matrix->r2c2;
    }
    
    /**
     * 
     * @return Matrix2x2
     */
    public function clone() : Matrix2x2
    {
        $matrix = new Matrix2x2();
        
        $matrix->r1c1 = $this->r1c1;
        $matrix->r1c2 = $this->r1c2;
        $matrix->r2c1 = $this->r2c1;
        $matrix->r2c2 = $this->r2c2;
        
        return $matrix;
    }
    
    /**
     * 
     * @return float
     */
    public function determinant() : float
    {
        return $this->r1c1 * $this->r2c2 - $this->r1c2 * $this->r2c1;
    }
    
    /**
     * 
     * @param Matrix2x2 $matrix
     * @param bool $assign
     * @return Matrix2x2
     */
    public function add(Matrix2x2 $matrix, bool $assign = false) : Matrix2x2
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->r1c1 += $matrix->r1c1;
        $destination->r1c2 += $matrix->r1c2;
        $destination->r2c1 += $matrix->r2c1;
        $destination->r2c2 += $matrix->r2c2;
        
        return $destination;
    }
    
    /**
     * 
     * @param Matrix2x2 $matrix
     * @param bool $assign
     * @return Matrix2x2
     */
    public function subtract(Matrix2x2 $matrix, bool $assign = false) : Matrix2x2
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->r1c1 -= $matrix->r1c1;
        $destination->r1c2 -= $matrix->r1c2;
        $destination->r2c1 -= $matrix->r2c1;
        $destination->r2c2 -= $matrix->r2c2;
        
        return $destination;
    }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix2x2
     */
    public function mutliplyAtNumber(float $number, bool $assign = false) : Matrix2x2
    {
        $matrix = ($assign ? $this : new Matrix2x2());
        
        $matrix->r1c1 = $this->r1c1 * $number;
        $matrix->r1c2 = $this->r1c2 * $number;
        $matrix->r2c1 = $this->r2c1 * $number;
        $matrix->r2c2 = $this->r2c2 * $number;
        
        return $matrix;
    }
    
    /**
     * 
     * @param Vector2 $vector
     * @return Vector2
     */
    public function mutliplyAtVector(Vector2 $vector) : Vector2
    {
        return new Vector2(
                $vector->x * $this->r1c1 + $vector->y * $this->r1c2,
                $vector->x * $this->r1c2 + $vector->y * $this->r2c2
        );
    }
    
    /**
     * 
     * @param Matrix2x2 $matrix
     * @return Matrix2x2
     */
    public function mutliplyAtMatrix(Matrix2x2 $matrix, bool $assign = false) : Matrix2x2
    {
        $r1c1 = $this->r1c1 * $matrix->r1c1 + $this->r1c2 * $matrix->r2c1;
        $r1c2 = $this->r1c1 * $matrix->r1c2 + $this->r1c2 * $matrix->r2c2;
        $r2c1 = $this->r2c1 * $matrix->r1c1 + $this->r2c2 * $matrix->r2c1;
        $r2c2 = $this->r2c1 * $matrix->r1c2 + $this->r2c2 * $matrix->r2c2;

        $result = ($assign ? $this : new Matrix2x2());
        
        $result->r1c1 = $r1c1;
        $result->r1c2 = $r1c2;
        $result->r2c1 = $r2c1;
        $result->r2c2 = $r2c2;
        
        return $result;
    }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix2x2
     */
    public function divide(float $number, bool $assign = false) : Matrix2x2
    {
        $matrix = ($assign ? $this : new Matrix2x2());
        
        $matrix->r1c1 = $this->r1c1 / $number;
        $matrix->r1c2 = $this->r1c2 / $number;
        $matrix->r2c1 = $this->r2c1 / $number;
        $matrix->r2c2 = $this->r2c2 / $number;
        
        return $matrix;
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @return float
     * @throws GeometryException
     */
    public function getItem(int $row, int $column) : float
    {
        self::assertCellIndexesAreCorrect($row, $column);
        
        return $this->{'r' . $row . 'c' . $column};
    }

    /**
     * 
     * @param int $row
     * @param int $column
     * @param float $value
     * @return $this
     * @throws GeometryException
     */
    public function setItem(int $row, int $column, float $value) : Matrix2x2
    {
        self::assertCellIndexesAreCorrect($row, $column);
        
        $this->{'r' . $row . 'c' . $column} = $value;
        
        return $this;
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @throws GeometryException
     */
    private static function assertCellIndexesAreCorrect(int $row, int $column)
    {
        if (!self::areCorrectCellIndexes($row, $column)) {
            throw new GeometryException('Incorrect cell indexes (' . $row . ', ' . $column . ')');
        }
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @return bool
     */
    private static function areCorrectCellIndexes(int $row, int $column) : bool
    {
        return ($row == 1 || $row == 2) && ($column == 1 || $column == 2);
    }
}
