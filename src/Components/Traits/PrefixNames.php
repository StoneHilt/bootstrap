<?php

namespace StoneHilt\Bootstrap\Components\Traits;

/**
 * Trait PrefixNames
 *
 * @package StoneHilt\Bootstrap\Components\Traits
 */
trait PrefixNames
{
    /**
     * @param string|array|null $subject
     * @param string $prefix
     * @return array
     */
    public function prefixNames(string|array|null $subject, string $prefix): array
    {
        if (!isset($subject)) {
            return [];
        }

        $subjectList = (array) $subject;
        $names = [];

        foreach ($subjectList as $reference) {
            $names[] = sprintf(
                '%s%s',
                $prefix,
                $reference !== '' ? '-' . $reference : ''
            );
        }

        return $names;
    }
}
