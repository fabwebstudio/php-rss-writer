<?php
/**
 * Created by PhpStorm.
 * User: Coders Earth
 * Date: 10/3/2017
 * Time: 6:20 PM
 */

namespace FabWebStudio\RSSWriter;


/**
 * Class Keywords
 *
 * @package FabWebStudio\RSSWriter
 */
class Keywords implements KeywordsInterface {

  protected $keywords;

  public function __construct($keyword = '') {
    $this->keywords = $keyword;
  }

  public function appendTo(ItemInterface $item) {
    $item->addKeywords($this);
    return $this;
  }

  public function asXML() {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><media:keywords>'.$this->keywords.'</media:keywords >', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);
    return $xml;
  }

}