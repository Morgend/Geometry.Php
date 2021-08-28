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
 * Description of MathHelper
 *
 * @author Andrey Pokidov <andrey.pokidov@gmail.com>
 * Created at 2020.10.07, 13:39:58
 */
class MathHelper
{
    const POSITIVE_EPSYLON = 1e-15;
    const NEGATIVE_EPSYLON = -1e-15;
    
    const POSITIVE_SQUARE_EPSYLON = 1e-30;
    const NEGATIVE_SQUARE_EPSYLON = -1e-30;

    const HIGH_EPSYLON = 1.000000000000001;
    const LOW_EPSYLON = 0.999999999999999;

    public static function areEqual(float $a, float $b)
    {
	if (-self::HIGH_EPSYLON <= $b && $b <= self::HIGH_EPSYLON) {
            $difference = $b - $a;
            return -self::EPSYLON <= $difference && $difference <= self::EPSYLON;
	}

	$relation = a / b;

        return self::LOW_EPSYLON <= $relation && $relation <= self::HIGH_EPSYLON;
    }
}
