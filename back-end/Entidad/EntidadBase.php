<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 07/06/2015
 * Time: 07:58 PM
 */


class EntidadBase {

     protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}