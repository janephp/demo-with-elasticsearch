<?php

namespace Generated\Model;

class Beer
{
    /**
     * 
     *
     * @var string
     */
    protected $name;
    /**
     * 
     *
     * @var string
     */
    protected $brewer;
    /**
     * 
     *
     * @var string
     */
    protected $style;
    /**
     * 
     *
     * @var int
     */
    protected $volume;
    /**
     * 
     *
     * @var int
     */
    protected $alcohol;
    /**
     * 
     *
     * @var string
     */
    protected $country;
    /**
     * 
     *
     * @var string
     */
    protected $color;
    /**
     * 
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getBrewer() : string
    {
        return $this->brewer;
    }
    /**
     * 
     *
     * @param string $brewer
     *
     * @return self
     */
    public function setBrewer(string $brewer) : self
    {
        $this->brewer = $brewer;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getStyle() : string
    {
        return $this->style;
    }
    /**
     * 
     *
     * @param string $style
     *
     * @return self
     */
    public function setStyle(string $style) : self
    {
        $this->style = $style;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getVolume() : int
    {
        return $this->volume;
    }
    /**
     * 
     *
     * @param int $volume
     *
     * @return self
     */
    public function setVolume(int $volume) : self
    {
        $this->volume = $volume;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getAlcohol() : int
    {
        return $this->alcohol;
    }
    /**
     * 
     *
     * @param int $alcohol
     *
     * @return self
     */
    public function setAlcohol(int $alcohol) : self
    {
        $this->alcohol = $alcohol;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }
    /**
     * 
     *
     * @param string $country
     *
     * @return self
     */
    public function setCountry(string $country) : self
    {
        $this->country = $country;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getColor() : string
    {
        return $this->color;
    }
    /**
     * 
     *
     * @param string $color
     *
     * @return self
     */
    public function setColor(string $color) : self
    {
        $this->color = $color;
        return $this;
    }
}