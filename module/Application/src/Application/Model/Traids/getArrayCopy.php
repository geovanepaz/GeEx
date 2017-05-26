<?php
namespace Application\Model\Traids;

trait getArrayCopy
{
    function getArrayCopy()
    {
        return  get_object_vars($this);

    }
}