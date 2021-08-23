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

namespace CleverST\Geometry;

/**
 * Description of Angle
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2020.10.07, 13:48:52
 */
class Angle
{
    const DEFAULT_VALUE = 0.0;
    
    const DEGREES_IN_RADIAN = 180.0 / M_PI;
    const GRADIANS_IN_RADIAN = 200.0 / M_PI;
    const DEGREES_IN_GRADIAN = 0.9;
    
    const PI     = M_PI;
    const PIx2   = M_PI * 2.0;
    const PId2   = M_PI / 2.0;
    const PIx3d2 = M_PI * 1.5;
    
    /**
     * 
     * @var float
     */
    private $radians = self::DEFAULT_VALUE;
    
    public function __construct(float $radians = self::DEFAULT_VALUE)
    {
        $this->radians = $radians;
    }
    
    /**
     * 
     * @return Angle
     */
    public function clone()
    {
        return new Angle($this->radians);
    }
    /**
     * 
     * @param Angle $destination
     * @return $this
     */
    public function copyValueTo(Angle $destination)
    {
        $destination->radians = $this->radians;
        
        return $this;
    }
    
    public function copyValueFrom(Angle $source)
    {
        $this->radians = $source->radians;
    }
    
    /**
     * 
     * @return float
     */
    public function radians()
    {
        return $this->radians;
    }
    
    /**
     * 
     * @param float $radians
     * @return $this
     */
    public function setRadians(float $radians)
    {
        $this->radians = $radians;
        
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function degrees()
    {
        return $this->radians * self::DEGREES_IN_RADIAN;
    }
    
    /**
     * 
     * @param float $degrees
     * @return $this
     */
    public function setDegrees(float $degrees)
    {
        $this->radians = $degrees / self::DEGREES_IN_RADIAN;
        
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function gradians()
    {
        return $this->radians * self::GRADIANS_IN_RADIAN;
    }
    
    /**
     * 
     * @param float $gradians
     * @return $this
     */
    public function setGradians(float $gradians)
    {
        $this->radians = $gradians / self::GRADIANS_IN_RADIAN;
        
        return $this;
    }
    
    /**
     * 
     * @param Angle $angle
     * @param bool $assign
     * @return Angle
     */
    public function summarize(Angle $angle, bool $assign = false)
    {
        if ($assign) {
            $this->radians += $angle->radians;
            return $this;
        }
        
        return new Angle($this->radians + $angle->radians);
    }
    
    /**
     * 
     * @param float $radians
     * @param bool $assign
     * @return Angle
     */
    public function addRadians(float $radians, bool $assign = false)
    {
        if ($assign) {
            $this->radians += $radians;
            return $this;
        }
        
        return new Angle($this->radians + $radians);
    }
    
    /**
     * 
     * @param float $degrees
     * @param bool $assign
     * @return Angle
     */
    public function addDegrees(float $degrees, bool $assign = false)
    {
        if ($assign) {
            $this->radians += $degrees / self::DEGREES_IN_RADIAN;
            return $this;
        }
        
        return new Angle($this->radians + $degrees / self::DEGREES_IN_RADIAN);
    }
    
    /**
     * 
     * @param float $gradians
     * @param bool $assign
     * @return Angle
     */
    public function addGradians(float $gradians, bool $assign = false)
    {
        if ($assign) {
            $this->radians += $gradians / self::GRADIANS_IN_RADIAN;
            return $this;
        }
        
        return new Angle($this->radians + $gradians / self::GRADIANS_IN_RADIAN);
    }
    
    /**
     * 
     * @param Angle $angle
     * @param bool $assign
     * @return $this
     */
    public function subtract(Angle $angle, bool $assign = false)
    {
        if ($assign) {
            $this->radians -= $angle->radians;
            return $this;
        }
        
        return new Angle($this->radians - $angle->radians);
    }
    
    /**
     * 
     * @param float $radians
     * @param bool $assign
     * @return $this
     */
    public function subtractRadians(float $radians, bool $assign = false)
    {
        if ($assign) {
            $this->radians -= $radians;
            return $this;
        }
        
        return new Angle($this->radians - $radians);
    }
    
    /**
     * 
     * @param float $degrees
     * @param bool $assign
     * @return $this
     */
    public function subtractDegrees(float $degrees, bool $assign = false)
    {
        if ($assign) {
            $this->radians -= $degrees / self::DEGREES_IN_RADIAN;
            return $this;
        }
        
        return new Angle($this->radians - $degrees / self::DEGREES_IN_RADIAN);
    }
    
    /**
     * 
     * @param float $gradians
     * @param bool $assign
     * @return $this
     */
    public function subtractGradians(float $gradians, bool $assign = false)
    {
        if ($assign) {
            $this->radians -= $gradians / self::GRADIANS_IN_RADIAN;
            return $this;
        }
        
        return new Angle($this->radians - $gradians / self::GRADIANS_IN_RADIAN);
    }
    
    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return Angle
     */
    public function multiply(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->radians *= $value;
            return $this;
        }
        
        return new Angle($this->radians * $value);
    }
    
    /**
     * 
     * @param float $value
     * @param bool $assign
     * @return $this
     */
    public function divide(float $value, bool $assign = false)
    {
        if ($assign) {
            $this->radians /= $value;
            return $this;
        }
        
        return new Angle($this->radians / $value);
    }
    
    /**
     * 
     * @return $this
     */
    public function revert()
    {
        $this->radians = -$this->radians;
        return $this;
    }
    
    /**
     * 
     * @return Angle
     */
    public function getReverted()
    {
        return new Angle(-$this->radians);
    }
    
    /**
     * 
     * @return float
     */
    public function cos()
    {
        return cos($this->radians);
    }
    
    /**
     * 
     * @return float
     */
    public function sin()
    {
        return sin($this->radians);
    }
    
    /**
     * 
     * @return float
     */
    public function tg()
    {
        return tan($this->radians);
    }
    
    /**
     * 
     * @return float
     */
    public function ctg()
    {
        return 1.0 / tan($this->radians);
    }
    
    /**
     * 
     * @param float $radians
     * @return Angle
     */
    public static function createWithRadians(float $radians)
    {
        return new Angle($radians);
    }
    
    /**
     * 
     * @param float $degrees
     * @return Angle
     */
    public static function createWithDegrees(float $degrees)
    {
        return new Angle($degrees / self::DEGREES_IN_RADIAN);
    }
    
    /**
     * 
     * @param float $gradians
     * @return Angle
     */
    public static function createWithGradians(float $gradians)
    {
        return new Angle($gradians / self::GRADIANS_IN_RADIAN);
    }
    
    /**
     * 
     * @param float $degrees
     * @return float
     */
    public static function degreesToRadians(float $degrees)
    {
        return $degrees / self::DEGREES_IN_RADIAN;
    }
    
    /**
     * 
     * @param float $radians
     * @return float
     */
    public static function radiansToDegress(float $radians)
    {
        return $radians * self::DEGREES_IN_RADIAN;
    }
    
    /**
     * 
     * @param float $gradians
     * @return float
     */
    public static function gradiansToRadians(float $gradians)
    {
        return $gradians / self::GRADIANS_IN_RADIAN;
    }
    
    /**
     * 
     * @param float $radians
     * @return float
     */
    public static function radiansToGradians(float $radians)
    {
        return $radians * self::GRADIANS_IN_RADIAN;
    }

    /**
     * 
     * @param float $gradians
     * @return float
     */
    public static function gradiansToDegrees(float $gradians)
    {
        return $gradians * self::DEGREES_IN_GRADIAN;
    }

    /**
     * 
     * @param float $degrees
     * @return float
     */
    public static function degreesToGradians(float $degrees)
    {
        return $degrees / self::DEGREES_IN_GRADIAN;
    }
}
