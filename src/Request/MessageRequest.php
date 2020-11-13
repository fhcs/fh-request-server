<?php

namespace Fh\RequestServer\Request;

use Illuminate\Support\Traits\Macroable;
use SimpleXMLElement;
use Vladmeh\XmlUtils\Xml;

class MessageRequest
{
    use Macroable;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array|mixed
     */
    private $parameters;

    /**
     * MessageRequest constructor.
     * @param string $type
     * @param array $parameters
     */
    public function __construct(string $type, array $parameters = [])
    {
        $this->type = $type;
        $this->parameters = $parameters;
    }


    /**
     * @param string $type
     * @param array $parameters
     * @return MessageRequest
     */
    public static function make(string $type, array $parameters = []): self
    {
        return new self($type, $parameters);
    }

    /**
     * @param bool $valAtAttr
     * @return string
     */
    public function toXml(bool $valAtAttr = false): string
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
