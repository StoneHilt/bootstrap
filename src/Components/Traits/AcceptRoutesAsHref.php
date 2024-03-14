<?php

namespace StoneHilt\Bootstrap\Components\Traits;

/**
 * Trait AcceptRoutesAsHref
 *
 * @package StoneHilt\Bootstrap\Components\Traits
 */
trait AcceptRoutesAsHref
{
    /**
     * @param string|array $href
     * @return string
     */
    protected function acceptRoutesAsHref(string|array $href): string
    {
        if (is_array($href)) {
            $href = route(...$href);
        } elseif ($href !== '#' && !filter_var($href, FILTER_VALIDATE_URL) && !str_starts_with($href, '/')) {
            $href = route($href);
        }

        return $href;
    }
}
