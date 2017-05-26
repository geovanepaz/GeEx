<?php
namespace Application\Model\Traids;

trait exchangeArray
{

    function exchangeArray($data)
    {
        $atributos = $this->getArrayCopy();
        foreach ($data as $i => $v) {
            $indices = array_keys($atributos);

            if (in_array($i, $indices)) {
                if ($v == "") {
                    $v = null;

                }
                $this->$i = (!is_null($v)) ? $v : null;
            }

        }


    }
}