<?php

namespace Spot\Shipment\Excel\Concerns;

interface WithMapping
{
    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array;
}
