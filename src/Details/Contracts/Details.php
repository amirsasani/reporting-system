<?php

namespace Amirsasani\ReportingSystem\Details\Contracts;

abstract class Details
{
    /**
     * @var array
     */
    private $details;

    public function __construct()
    {
        $this->details = [];
    }

    public function setId(int $id){
        $this->details['id'] = $id;
    }

    public function setSubject(string $subject){
        $this->details['subject'] = $subject;
    }

    public function setDescription(string $description = ""){
        $this->details['description'] = $description;
    }

    public function asArray()
    {
        return $this->details;
    }

    public function asJson()
    {
        return json_encode($this->asArray());
    }
}