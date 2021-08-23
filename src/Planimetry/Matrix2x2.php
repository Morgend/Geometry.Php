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

/**
 * Description of Matrix2x2
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 11:54:35
 */
class Matrix2x2
{
    const ITEM_AMOUNT = 4;
    
    const ROW_AMOUNT = 2;
    const COLUMN_AMOUNT = 2;
    
    /**
     * 
     * @var float[]
     */
    private $items = [
        0.0, 0.0,
        0.0, 0.0
    ];
    
    public function loadIdentity()
    {
        $this->items[0] = 1.0;
        $this->items[1] = 0.0;
        $this->items[2] = 0.0;
        $this->items[3] = 1.0;
    }
    
    public function loadZero()
    {
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $this->items[$i] = 0.0;
        }
    }
    
    public function copyTo(Matrix2x2 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $matrix->items[$i] = $this->items[$i];
        }
    }
    
    public function copyFrom(Matrix2x2 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $this->items[$i] = $matrix->items[$i];
        }
    }
    
    /**
     * 
     * @return Matrix2x2
     */
    public function clone()
    {
        $matrix = new Matrix2x2();
        
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $matrix->items[$i] = $this->items[$i];
        }
        
        return $matrix;
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @return boolean
     */
    public function areCorrectIndexes(int $row, int $column)
    {
        return 0 <= $row && $row < self::ROW_AMOUNT
            && 0 <= $column && $column < self::COLUMN_AMOUNT;
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @return float
     */
    public function getItem(int $row, int $column)
    {
        if ($this->areCorrectIndexes($row, $column)) {
            return $this->items[($row << 1) | $column];
        }
        
        //TODO: throw exception
        return 0.0;
        
        
    }
    
    /**
     * 
     * @param int $row
     * @param int $column
     * @param float $value
     */
    public function setItem(int $row, int $column, float $value)
    {
        if ($this->areCorrectIndexes($row, $column)) {
            $this->items[($row << 1) | $column] = $value;
        }
   }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix2x2
     */
    public function mutliplyAtNumber(float $number, bool $assign = false)
    {
        if ($assign) {
            for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
                $this->items[$i] *= $number;
            }
            
            return $this;
        }
        
        $matrix = new Matrix2x2();
        
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $matrix->items[$i] = $this->items[$i] * $number;
        }
        
        return $matrix;
    }
    
    /**
     * 
     * @param Vector2 $vector
     * @return Vector2
     */
    public function mutliplyAtVector(Vector2 $vector)
    {
        return new Vector2(
                $vector->x() * $this->items[0] + $vector->y() * $this->items[1],
                $vector->x() * $this->items[3] + $vector->y() * $this->items[3]
        );
    }
    
    /**
     * 
     * @param Matrix2x2 $matrix
     * @return Matrix2x2
     */
    public function mutliplyAtMatrix(Matrix2x2 $matrix, bool $assign = false)
    {
        $r0c0 = $this->r0c0 * $matrix->r0c0 + $this->r0c1 * $matrix->r1c0;
        $r0c1 = $this->r0c0 * $matrix->r0c1 + $this->r0c1 * $matrix->r1c1;
        $r1c0 = $this->r1c0 * $matrix->r0c0 + $this->r1c1 * $matrix->r1c0;
        $r1c1 = $this->r1c0 * $matrix->r0c1 + $this->r1c1 * $matrix->r1c1;

        $result = ($assign ? $this : new Matrix2x2());
        
        $result->r0c0 = $r0c0;
        $result->r0c1 = $r0c1;
        $result->r1c0 = $r1c0;
        $result->r1c1 = $r1c1;
        
        return $result;
    }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix2x2
     */
    public function divideAt(float $number, bool $assign = false)
    {
        if ($assign) {
            for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
                $this->items[$i] /= $number;
            }
            
            return $this;
        }
        
        $matrix = new Matrix2x2();
        
        for ($i = 0; $i < self::ITEM_AMOUNT; $i++) {
            $matrix->items[$i] = $this->items[$i] / $number;
        }
        
        return $matrix;
    }
}
