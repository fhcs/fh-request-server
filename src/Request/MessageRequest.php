<?php

namespace Fh\RequestServer\Request;

use Illuminate\Support\Traits\Macroable;
use SimpleXMLElement;
use Vladmeh\XmlUtils\Xml;

class MessageRequest
{
    use Macroable;

    private $type;

    private $parameters;

    /**
     * MessageRequest constructor.
     * @param $type
     * @param $parameters
     */
    public function __construct($type, $parameters = [])
    {
        $this->type = $type;
        $this->parameters = $parameters;
    }


    /**
     * @param $type
     * @param array $parameters
     * @return MessageRequest
     */
    public static function make($type, $parameters = []): self
    {
        return new self($type, $parameters);
    }

    /**
     * @param false $valAtAttr
     * @return string
     */
    public function toXml($valAtAttr = false): string
    {
        return $valAtAttr ? $this->xmlAttribute() : $this->xml();
    }

    /**
     * @return string
     */
    public function xmlAttribute(): string
    {
        $message = new SimpleXMLElement('<REQUEST/>');
        $message->addAttribute('type', $this->type);

        if (!empty($this->parameters)) {
            Xml::arrayToXmlAttribute($this->parameters, $message, true);
        }

        return $message->asXML();
    }

    /**
     * @return string
     */
    public function xml(): string
    {
        $message = new SimpleXMLElement('<REQUEST/>');
        $message->addAttribute('type', $this->type);

        if (!empty($this->attributes)) {
            Xml::arrayToXml($this->attributes, $message, true);
        }

        return $message->asXML();
    }
}
