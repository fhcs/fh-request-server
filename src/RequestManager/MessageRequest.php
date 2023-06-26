<?php

namespace Fh\RequestServer\RequestManager;

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
    private $attributes;

    /**
     * @var string
     */
    private $multipleNodeName = 'item';

    /**
     * MessageRequest constructor.
     * @param string $type
     * @param array $attributes
     */
    public function __construct(string $type, array $attributes = [])
    {
        $this->type = $type;
        $this->attributes = $attributes;
    }


    /**
     * @param string $type
     * @param array $attributes
     * @return MessageRequest
     */
    public static function make(string $type, array $attributes = []): self
    {
        return new self($type, $attributes);
    }

    /**
     * @param bool $valAtAttr
     * @param string $multipleNodeName
     * @return string
     */
    public function toXml(bool $valAtAttr = false, string $multipleNodeName = 'item'): string
    {
        $this->setMultipleNodeName($multipleNodeName);
        return $valAtAttr ? $this->xmlAttribute() : $this->xml();
    }

    /**
     * @return string
     */
    public function xmlAttribute(): string
    {
        $message = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><REQUEST/>');
        $message->addAttribute('type', $this->type);

        if (!empty($this->attributes)) {
            Xml::arrayToXmlAttribute($this->attributes, $message, true, $this->multipleNodeName);
        }

        return $message->asXML();
    }

    /**
     * @return string
     */
    public function xml(): string
    {
        $message = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><REQUEST/>');
        $message->addAttribute('type', $this->type);

        if (!empty($this->attributes)) {
            Xml::arrayToXml($this->attributes, $message, true, $this->multipleNodeName);
        }

        return $message->asXML();
    }

    /**
     * @param string $multipleNodeName
     */
    public function setMultipleNodeName(string $multipleNodeName): void
    {
        $this->multipleNodeName = $multipleNodeName;
    }
}
