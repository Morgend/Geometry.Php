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

use CleverST\Geometry\Helper;

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
    private $x = self::DEFAULT_COORDINATE_VALUE;
    
    /**
     *
     * @var float
     */
    private $y = self::DEFAULT_COORDINATE_VALUE;
    
    /**
     *
     * @var float
     */
    private $z = self::DEFAULT_COORDINATE_VALUE;
    
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
    public function clone()
    {
        return new Vector3($this->x, $this->y, $this->z);
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return $this
     */
    public function copyValuesFrom(Vector3 $vector)
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
    public function copyValuesTo(Vector3 $vector)
    {
        $vector->x = $this->x;
        $vector->y = $this->y;
        $vector->z = $this->z;
        
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function x()
    {
        return $this->x;
    }
    
    /**
     * 
     * @param float $x
     * @return $this
     */
    public function setX(float $x)
    {
        $this->x = $x;
        
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function y()
    {
        return $this->y;
    }
    
    /**
     * 
     * @param float $y
     * @return $this
     */
    public function setY(float $y)
    {
        $this->y = $y;
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function z()
    {
        return $this->z;
    }
    
    /**
     * 
     * @param float $z
     * @return $this
     */
    public function setZ(float $z)
    {
        $this->z = $z;
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isZero()
    {
        return $this->x * $this->x + $this->y * $this->y + $this->z * $this->z <= Helper::POSITIVE_SQUARE_EPSYLON;
    }
    
    /**
     * 
     * @return $this
     */
    public function setToZero()
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
    public function setValues(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        
        return $this;
    }
    
    /**
     * 
     * @param Vector3 $v
     * @return float
     */
    public function scalar(Vector3 $v)
    {
        return $this->x * $v->x + $this->y * $v->y + $this->z * $v->z;
    }
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @param float $z
     * @return float
     */
    public function scalarXYZ(float $x, float $y, float $z)
    {
        return $this->x * $x + $this->y * $y + $this->z * $z;
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return Vector3
     */
    public function vectorMultiply(Vector3 $vector, bool $assign = false)
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
    public function module()
    {
        return sqrt($this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
    }
    
    /**
     * 
     * @return boolean If vector has been normalized to an identity vector then the method returns TRUE otherwise the vector sets to zero and the method returns FALSE
     */
    public function normalize()
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
    public function getNormalized()
    {
        $copy = $this->clone();
        $copy->normalize();
        return $copy;
    }


    /**
     * 
     * @param Vector3 $vector
     * @param bool $assign
     * @return Vector3
     */
    public function summarize(Vector3 $vector, bool $assign = false)
    {
        if ($assign) {
            $this->x += $vector->x;
            $this->y += $vector->y;
            $this->z += $vector->z;
            
            return $this;
        }
        
        return new Vector3($this->x + $vector->x, $this->y + $vector->y);
    }

    /**
     * 
     * @param Vector3 $vector
     * @param bool $assign
     * @return $this
     */
    public function subtract(Vector3 $vector, bool $assign = false)
    {
        if ($assign) {
            $this->x -= $vector->x;
            $this->y -= $vector->y;
            $this->z -= $vector->z;
            
            return $this;
        }
        
        return new Vector3($this->x - $vector->x, $this->y - $vector->y);
    }


    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector3
     */
    public function multiply(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->x *= $value;
            $this->y *= $value;
            $this->z *= $value;
            
            return $this;
        }
        
        return new Vector3($this->x * $value, $this->y * $value);
    }

    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector3
     */
    public function divide(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->x /= $value;
            $this->y /= $value;
            $this->z /= $value;
            
            return $this;
        }
        
        return new Vector3($this->x / $value, $this->y / $value);
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
