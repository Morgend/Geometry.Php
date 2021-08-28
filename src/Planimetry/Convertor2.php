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
 * Description of Convertor2
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 14:04:37
 */
class Convertor2
{
    /**
     * 
     * @var Matrix2x2
     */
    private $warp;
    
    /**
     * 
     * @var Vector2
     */
    private $shift;
    
    public function __construct()
    {
        $this->warp = new Matrix2x2();
        $this->shift = new Vector2();
    }
    
    /**
     * 
     * @return Matrix2x2
     */
    public function warp() : Matrix2x2
    {
       return $this->warp; 
    }
    
    /**
     * 
     * @return Vector2
     */
    public function shift() : Vector2
    {
       return $this->shift;
    }
    
    /**
     * 
     * @return Convertor2
     */
    public function clone() : Convertor2
    {
        $clone = new Convertor2();
        
        $clone->warp->copyFrom($this->warp);
        $clone->shift->copyValuesFrom($this->shift);
        
        return $clone;
    }
    
    public function __clone()
    {
        $this->warp = $this->warp->clone();
        $this->shift = $this->shift->clone();
    }
    
    public function loadIdentity()
    {
        $this->warp->loadIdentity();
        $this->shift->setToZero();
    }
    
    /**
     * 
     * @param Vector2 $vector
     * @return Vector2
     */
    public function convertVector(Vector2 $vector) : Vector2
    {
        $result = $this->warp->mutliplyAtVector($vector);
        
        $result->summarize($this->shift, true);
        
        return $result;
    }
}
