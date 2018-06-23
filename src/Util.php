<?php declare(strict_types=1);

namespace FOXRP\Rippled;

class Util
{
    /**
     * Converts snake case to pascal case.
     *
     * @param string $key Snake case key
     * @return string Pascal case key
     */
    public static function CaseFromSnake(string $key): string
    {
        return str_replace('_', '', ucwords($key, '_'));
    }
}
