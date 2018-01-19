<?php

/**
 * Check if an item or items does NOT exist in an array using "dot" notation.
 * Inverse of Laravel helpers\array_has
 *
 * @param  array  $array
 * @param  string|array  $keys
 * @return bool
 */
function array_has_not($array, $keys)
{
    return ! array_has($array, $keys);
}

/**
 * Returns the item of the array given the index, if the index exists; otherwise, return $default
 *
 * @param  array  $array
 * @param  int  $index
 * @param  mixed  $default
 * @return mixed
 */
function array_get_index(array $array, $index, $default)
{
    return isset($array[$index]) ? $array[$index] : $default;
}
