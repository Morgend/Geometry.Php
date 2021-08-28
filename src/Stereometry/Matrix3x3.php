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

namespace CleverST\Geometry\Stereometry;

use CleverST\Geometry\GeometryException;

/**
 * Description of Matrix3x3
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 17:57:28
 */
class Matrix3x3
{
    const DEFAULT_CELL_VALUE = 0.0;
    
    public float $r1c1 = self::DEFAULT_CELL_VALUE;
    public float $r1c2 = self::DEFAULT_CELL_VALUE;
    public float $r1c3 = self::DEFAULT_CELL_VALUE;
    
    public float $r2c1 = self::DEFAULT_CELL_VALUE;
    public float $r2c2 = self::DEFAULT_CELL_VALUE;
    public float $r2c3 = self::DEFAULT_CELL_VALUE;
    
    public float $r3c1 = self::DEFAULT_CELL_VALUE;
    public float $r3c2 = self::DEFAULT_CELL_VALUE;
    public float $r3c3 = self::DEFAULT_CELL_VALUE;
    
    
    public function loadIdentity()
    {
        $this->r1c1 = 1.0;
        $this->r1c2 = 0.0;
        $this->r1c3 = 0.0;
        
        $this->r2c1 = 0.0;
        $this->r2c2 = 1.0;
        $this->r2c3 = 0.0;
        
        $this->r3c1 = 0.0;
        $this->r3c2 = 0.0;
        $this->r3c3 = 1.0;
    }
    
    public function loadZero()
    {
        $this->r1c1 = self::DEFAULT_CELL_VALUE;
        $this->r1c2 = self::DEFAULT_CELL_VALUE;
        $this->r1c3 = self::DEFAULT_CELL_VALUE;
        
        $this->r2c1 = self::DEFAULT_CELL_VALUE;
        $this->r2c2 = self::DEFAULT_CELL_VALUE;
        $this->r2c3 = self::DEFAULT_CELL_VALUE;
        
        $this->r3c1 = self::DEFAULT_CELL_VALUE;
        $this->r3c2 = self::DEFAULT_CELL_VALUE;
        $this->r3c3 = self::DEFAULT_CELL_VALUE;
    }
    
    public function copyValuesTo(Matrix3x3 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        $matrix->r1c1 = $this->r1c1;
        $matrix->r1c2 = $this->r1c2;
        $matrix->r1c3 = $this->r1c3;
        
        $matrix->r2c1 = $this->r2c1;
        $matrix->r2c2 = $this->r2c2;
        $matrix->r2c3 = $this->r2c3;
        
        $matrix->r3c1 = $this->r3c1;
        $matrix->r3c2 = $this->r3c2;
        $matrix->r3c3 = $this->r3c3;
    }
    
    public function copyValuesFrom(Matrix3x3 $matrix)
    {
        if ($matrix == $this) {
            return;
        }
        
        $this->r1c1 = $matrix->r1c1;
        $this->r1c2 = $matrix->r1c2;
        $this->r1c3 = $matrix->r1c3;
        
        $this->r2c1 = $matrix->r2c1;
        $this->r2c2 = $matrix->r2c2;
        $this->r2c3 = $matrix->r2c3;
        
        $this->r3c1 = $matrix->r3c1;
        $this->r3c2 = $matrix->r3c2;
        $this->r3c3 = $matrix->r3c3;
    }
    
    /**
     * 
     * @return Matrix3x3
     */
    public function clone()
    {
        $matrix = new Matrix3x3();
        
        $matrix->r1c1 = $this->r1c1;
        $matrix->r1c2 = $this->r1c2;
        $matrix->r1c3 = $this->r1c3;
        
        $matrix->r2c1 = $this->r2c1;
        $matrix->r2c2 = $this->r2c2;
        $matrix->r2c3 = $this->r2c3;
        
        $matrix->r3c1 = $this->r3c1;
        $matrix->r3c2 = $this->r3c2;
        $matrix->r3c3 = $this->r3c3;
        
        return $matrix;
    }
    
    /**
     * 
     * @return float
     */
    public function determinant()
    {
        return $this->r1c1 * $this->r2c2 * $this->r3c3
             + $this->r1c2 * $this->r2c3 * $this->r3c1
             + $this->r1c3 * $this->r2c1 * $this->r3c2
             - $this->r1c3 * $this->r2c2 * $this->r3c1
             - $this->r1c2 * $this->r2c1 * $this->r3c3
             - $this->r1c1 * $this->r2c3 * $this->r3c2;
    }
    
    /**
     * 
     * @param Matrix3x3 $matrix
     * @param bool $assign
     * @return Matrix3x3
     */
    public function add(Matrix3x3 $matrix, bool $assign = false) : Matrix3x3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->r1c1 += $matrix->r1c1;
        $destination->r1c2 += $matrix->r1c2;
        $destination->r1c3 += $matrix->r1c3;
        
        $destination->r2c1 += $matrix->r2c1;
        $destination->r2c2 += $matrix->r2c2;
        $destination->r2c3 += $matrix->r2c3;
        
        $destination->r3c1 += $matrix->r3c1;
        $destination->r3c2 += $matrix->r3c2;
        $destination->r3c3 += $matrix->r3c3;
        
        return $destination;
    }
    
    /**
     * 
     * @param Matrix3x3 $matrix
     * @param bool $assign
     * @return Matrix3x3
     */
    public function subtract(Matrix3x3 $matrix, bool $assign = false) : Matrix3x3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->r1c1 -= $matrix->r1c1;
        $destination->r1c2 -= $matrix->r1c2;
        $destination->r1c3 -= $matrix->r1c3;
        
        $destination->r2c1 -= $matrix->r2c1;
        $destination->r2c2 -= $matrix->r2c2;
        $destination->r2c3 -= $matrix->r2c3;
        
        $destination->r3c1 -= $matrix->r3c1;
        $destination->r3c2 -= $matrix->r3c2;
        $destination->r3c3 -= $matrix->r3c3;
        
        return $destination;
    }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix3x3
     */
    public function mutliplyAtNumber(float $number, bool $assign = false)
    {
        $matrix = ($assign ? $this : new Matrix3x3());
        
        $matrix->r1c1 = $this->r1c1 * $number;
        $matrix->r1c2 = $this->r1c2 * $number;
        $matrix->r1c3 = $this->r1c3 * $number;
        
        $matrix->r2c1 = $this->r2c1 * $number;
        $matrix->r2c2 = $this->r2c2 * $number;
        $matrix->r2c3 = $this->r2c3 * $number;
        
        $matrix->r3c1 = $this->r3c1 * $number;
        $matrix->r3c2 = $this->r3c2 * $number;
        $matrix->r3c3 = $this->r3c3 * $number;
        
        return $matrix;
}
    
    /**
     * 
     * @param Vector3 $vector
     * @return Vector3
     */
    public function mutliplyAtVector(Vector3 $vector)
    {
        return new Vector3(
                $vector->x * $this->r1c1 + $vector->y * $this->r1c2 + $vector->z * $this->r1c3,
                $vector->x * $this->r2c2 + $vector->y * $this->r2c2 + $vector->z * $this->r2c3,
                $vector->x * $this->r3c2 + $vector->y * $this->r3c2 + $vector->z * $this->r3c3
        );
    }
    
    /**
     * 
     * @param float $number
     * @param bool $assign 
     * @return Matrix3x3
     */
    public function divide(float $number, bool $assign = false)
    {
        $matrix = ($assign ? $this : new Matrix3x3());
        
        $matrix->r1c1 = $this->r1c1 / $number;
        $matrix->r1c2 = $this->r1c2 / $number;
        $matrix->r1c3 = $this->r1c3 / $number;
        
        $matrix->r2c1 = $this->r2c1 / $number;
        $matrix->r2c2 = $this->r2c2 / $number;
        $matrix->r2c3 = $this->r2c3 / $number;
        
        $matrix->r3c1 = $this->r3c1 / $number;
        $matrix->r3c2 = $this->r3c2 / $number;
        $matrix->r3c3 = $this->r3c3 / $number;
        
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
        return 1 <= $row && $row <= 3 && 1 <= $column && $column <= 3;
    }
}
