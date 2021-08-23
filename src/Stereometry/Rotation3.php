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

use CleverST\Geometry\Angle;

/**
 * Description of Rotation3
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2021.08.23, 16:46:35
 */
class Rotation3
{
    /**
     * 
     * @var Vector3
     */
    private $axis;
    
    /**
     * 
     * @var Angle
     */
    private $angle;
    
    private function __construct()
    {
        $this->axis = new Vector3();
        $this->angle = new Angle();
    }
    
    /**
     * 
     * @return Vector3
     */
    public function axis()
    {
        return $this->axis;
    }
    
    /**
     * 
     * @return Angle
     */
    public function angle()
    {
        return $this->angle;
    }
}
