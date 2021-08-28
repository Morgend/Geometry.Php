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

use CleverST\Geometry\MathHelper;

/**
 * Description of Vector3
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2020.10.07, 12:06:26
 */
class Vector3
{
    const DEFAULT_COORDINATE_VALUE = 0.0;
    
    /**
     *
     * @var float
     */
    public float $x = self::DEFAULT_COORDINATE_VALUE;
    
    /**
     *
     * @var float
     */
    public float $y = self::DEFAULT_COORDINATE_VALUE;
    
    /**
     *
     * @var float
     */
    public float $z = self::DEFAULT_COORDINATE_VALUE;
    
    public function __construct(float $x = self::DEFAULT_COORDINATE_VALUE, float $y = self::DEFAULT_COORDINATE_VALUE, float $z = self::DEFAULT_COORDINATE_VALUE)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
    
    /**
     * 
     * @return Vector3
     */
    public function clone() : Vector3
    {
        return new Vector3($this->x, $this->y, $this->z);
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return $this
     */
    public function copyValuesFrom(Vector3 $vector) : Vector3
    {
        $this->x = $vector->x;
        $this->y = $vector->y;
        $this->z = $vector->z;
        
        return $this;
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return $this
     */
    public function copyValuesTo(Vector3 $vector) : Vector3
    {
        $vector->x = $this->x;
        $vector->y = $this->y;
        $vector->z = $this->z;
        
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isUnit() : bool
    {
        $difference = $this->x * $this->x + $this->y * $this->y + $this->z * $this->z - 1.0;
        return MathHelper::NEGATIVE_EPSYLON <= $difference && $difference <= MathHelper::POSITIVE_EPSYLON;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isZero() : bool
    {
        return $this->x * $this->x + $this->y * $this->y + $this->z * $this->z <= MathHelper::POSITIVE_SQUARE_EPSYLON;
    }
    
    /**
     * 
     * @return $this
     */
    public function setToZero() : Vector3
    {
        $this->x = self::DEFAULT_COORDINATE_VALUE;
        $this->y = self::DEFAULT_COORDINATE_VALUE;
        $this->z = self::DEFAULT_COORDINATE_VALUE;
        
        return $this;
    }
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @param float $z
     * @return $this
     */
    public function setValues(float $x, float $y, float $z) : Vector3
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        
        return $this;
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return float
     */
    public function scalar(Vector3 $vector) : float
    {
        return $this->x * $vector->x + $this->y * $vector->y + $this->z * $vector->z;
    }
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @param float $z
     * @return float
     */
    public function scalarXYZ(float $x, float $y, float $z) : float
    {
        return $this->x * $x + $this->y * $y + $this->z * $z;
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return Vector3|$this
     */
    public function vectorMultiply(Vector3 $vector, bool $assign = false) : Vector3
    {
        $x = $this->y * $vector->z - $this->z * $vector->y;
        $y = $this->z * $vector->x - $this->x * $vector->z;
        $z = $this->x * $vector->y - $this->y * $vector->x;
        
        if ($assign) {
            $this->setValues($x, $y, $z);
            return $this;
        }
        
        return new Vector3($x, $y, $z);
    }
    
    /**
     * 
     * @return float
     */
    public function module() : float
    {
        return sqrt($this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
    }
    
    /**
     * 
     * @return boolean If vector has been normalized to an identity vector then the method returns TRUE otherwise the vector sets to zero and the method returns FALSE
     */
    public function normalize() : bool
    {
        $squareModule = $this->x * $this->x + $this->y * $this->y + $this->z * $this->z;
        
        if ($squareModule <= Helper::POSITIVE_SQUARE_EPSYLON) {
            $thix->x = self::DEFAULT_COORDINATE_VALUE;
            $thix->y = self::DEFAULT_COORDINATE_VALUE;
            $thix->z = self::DEFAULT_COORDINATE_VALUE;
            return false;
        }
        
        $module = sqrt($squareModule);
        
        $this->x /= $module;
        $this->y /= $module;
        $this->z /= $module;
        
        return true;
    }
    
    /**
     * 
     * @return Vector3
     */
    public function getNormalized() : Vector3
    {
        $copy = $this->clone();
        $copy->normalize();
        return $copy;
    }


    /**
     * 
     * @param Vector3 $vector
     * @param bool $assign
     * @return Vector3|$this
     */
    public function add(Vector3 $vector, bool $assign = false) : Vector3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->x += $vector->x;
        $destination->y += $vector->y;
        $destination->z += $vector->z;
        
        return $destination;
    }

    /**
     * 
     * @param Vector3 $vector
     * @param bool $assign
     * @return Vector3|$this
     */
    public function subtract(Vector3 $vector, bool $assign = false) : Vector3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->x -= $vector->x;
        $destination->y -= $vector->y;
        $destination->z -= $vector->z;
        
        return $destination;
    }


    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector3|$this
     */
    public function multiply(float $value, bool $assign = false) : Vector3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->x *= $value;
        $destination->y *= $value;
        $destination->z *= $value;
        
        return $destination;
    }

    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector3|$this
     */
    public function divide(float $value, bool $assign = false) : Vector3
    {
        $destination = ($assign ? $this : $this->clone());
        
        $destination->x /= $value;
        $destination->y /= $value;
        $destination->z /= $value;
        
        return $destination;
    }

    /**
     * 
     * @return $this
     */
    public function revert()
    {
        $this->x = -$this->x;
        $this->y = -$this->y;
        $this->z = -$this->z;
        
        return $this;
    }
    
    /**
     * 
     * @return Vector3
     */
    public function makeReverted()
    {
        return new Vector3(-$this->x, -$this->y, -$this->z);
    }
}
