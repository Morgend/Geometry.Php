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

use CleverST\Geometry\Helper;

/**
 * Description of Vector2
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2020.10.07, 11:43:26
 */
class Vector2
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
    
    public function __construct(float $x = self::DEFAULT_COORDINATE_VALUE, float $y = self::DEFAULT_COORDINATE_VALUE)
    {
        $this->x = $x;
        $this->y = $y;
    }
    
    /**
     * 
     * @return Vector2
     */
    public function clone()
    {
        return new Vector2($this->x, $this->y);
    }
    
    /**
     * 
     * @param Vector2 $destination
     * @return $this
     */
    public function copyValuesTo(Vector2 $destination)
    {
        $destination->x = $this->x;
        $destination->y = $this->y;
        
        return $this;
    }
    
    /**
     * 
     * @param Vector2 $source
     * @return $this
     */
    public function copyValuesFrom(Vector2 $source)
    {
        $this->x = $source->x;
        $this->y = $source->y;
        
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
     * @return boolean
     */
    public function isZero()
    {
        return $this->x * $this->x + $this->y * $this->y <= Helper::POSITIVE_SQUARE_EPSYLON;
    }
    
    /**
     * 
     * @return $this
     */
    public function setToZero()
    {
        $this->x = self::DEFAULT_COORDINATE_VALUE;
        $this->y = self::DEFAULT_COORDINATE_VALUE;
        
        return $this;
    }
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @return $this
     */
    public function setValues(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
        
        return $this;
    }
    
    /**
     * 
     * @param Vector2 $vector
     * @return float
     */
    public function scalar(Vector2 $vector)
    {
        return $this->x * $vector->x + $this->y * $vector->y;
    }
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @return float
     */
    public function scalarXY(float $x, float $y)
    {
        return $this->x * $x + $this->y * $y;
    }
    
    /**
     * 
     * @return float
     */
    public function module()
    {
        return sqrt($this->x * $this->x + $this->y * $this->y);
    }
    
    /**
     * 
     * @return boolean If vector has been normalized to an identity vector then the method returns TRUE otherwise the vector sets to zero and the method returns FALSE
     */
    public function normalize()
    {
        $squareModule = $this->x * $this->x + $this->y * $this->y;
        
        if ($squareModule <= Helper::POSITIVE_SQUARE_EPSYLON) {
            $thix->x = self::DEFAULT_COORDINATE_VALUE;
            $thix->y = self::DEFAULT_COORDINATE_VALUE;
            return false;
        }
        
        $module = sqrt($squareModule);
        
        $this->x /= $module;
        $this->y /= $module;
        
        return true;
    }
    
    /**
     * 
     * @return Vector2
     */
    public function getNormalized()
    {
        $copy = $this->clone();
        $copy->normalize();
        return $copy;
    }

    /**
     * 
     * @param Vector2 $vector
     * @param bool $assign
     * @return Vector2
     */
    public function summarize(Vector2 $vector, bool $assign = false)
    {
        if ($assign) {
            $this->x += $vector->x;
            $this->y += $vector->y;
            
            return $this;
        }
        
        return new Vector2($this->x + $vector->x, $this->y + $vector->y);
    }

    /**
     * 
     * @param Vector2 $vector
     * @param bool $assign
     * @return $this
     */
    public function subtract(Vector2 $vector, bool $assign = false)
    {
        if ($assign) {
            $this->x -= $vector->x;
            $this->y -= $vector->y;
            
            return $this;
        }
        
        return new Vector2($this->x - $vector->x, $this->y - $vector->y);
    }

    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector2
     */
    public function multiply(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->x *= $value;
            $this->y *= $value;
            
            return $this;
        }
        
        return new Vector2($this->x * $value, $this->y * $value);
    }

    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Vector2
     */
    public function divide(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->x /= $value;
            $this->y /= $value;
            
            return $this;
        }
        
        return new Vector2($this->x / $value, $this->y / $value);
    }

    /**
     * 
     * @return $this
     */
    public function reverse()
    {
        $this->x = -$this->x;
        $this->y = -$this->y;
        
        return $this;
    }
    
    /**
     * 
     * @return Vector2
     */
    public function makeReverted()
    {
        return new Vector2(-$this->x, -$this->y);
    }
}
