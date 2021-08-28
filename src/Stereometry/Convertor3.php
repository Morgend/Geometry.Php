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

/**
 * Description of Convertor3
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 17:55:02
 */
class Convertor3
{
    /**
     * 
     * @var Matrix3x3
     */
    private $warp;
    
    /**
     * 
     * @var Vector3
     */
    private $shift;
    
    public function __construct()
    {
        $this->warp = new Matrix3x3();
        $this->shift = new Vector3();
    }
    
    /**
     * 
     * @return Matrix3x3
     */
    public function warp() : Matrix3x3
    {
       return $this->warp; 
    }
    
    /**
     * 
     * @return Vector3
     */
    public function shift() : Vector3
    {
       return $this->shift;
    }
    
    public function loadIdentity()
    {
        $this->warp->loadIdentity();
        $this->shift->setToZero();
    }
    
    /**
     * 
     * @param Vector3 $vector
     * @return Vector3
     */
    public function convertVector(Vector3 $vector) : Vector3
    {
        $result = $this->warp->mutliplyAtVector($vector);
        
        $result->summarize($this->shift, true);
        
        return $result;
    }
}
