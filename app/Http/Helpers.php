<?php

/**
 * @param $query
 *
 * @return null|string|string[]
 */
function getFullSql($query)
{
    $sql = $query->toSql();
    foreach($query->getBindings() as $binding)
    {
        $value = is_numeric($binding) ? $binding : "'".$binding."'";
        $sql = preg_replace('/\?/', $value, $sql, 1);
    }
    return $sql;
}