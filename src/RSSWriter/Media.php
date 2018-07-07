<?php

namespace FabWebStudio\RSSWriter;

/**
 * Class Media
 *
 * @package FabWebStudio\RSSWriter
 */
class Media implements MediaInterface {

  protected $url;

  protected $type = 'image/jpeg';

  protected $thumbnail_url;

  protected $thumbnail_type = 'image/jpeg';

  protected $credit;

  protected $title;

  protected $text;

  protected $x1 = 246;

  protected $x2 = 246;

  protected $y1 = 140;

  protected $y2 = 140;

  protected $syndication_rights = 1;

  protected $license_id;

  protected $licensor_name;

  protected $keyword;


  public function __construct($url, $type = 'image/jpeg') {
    $this->url = $url;
    $this->type = $type;
  }

  public function thumbnail($thumbnail_url, $thumbnail_type = 'image/jpeg') {
    $this->thumbnail_url = $thumbnail_url;
    $this->thumbnail_type = $thumbnail_type;
    return $this;
  }

  public function credit($credit) {
    $this->credit = $credit;
    return $this;
  }

  public function title($title) {
    $this->title = $title;
    return $this;
  }

  public function text($text) {
    $this->text = $text;
    return $this;
  }

  public function focalRegion($x1 = 246, $y1 = 140, $x2 = 246, $y2 = 140) {
    $this->x1 = $x1;
    $this->y1 = $y1;
    $this->x2 = $x2;
    $this->y2 = $y2;
    return $this;
  }

  public function hasSyndicationRights($syndication_rights = 1) {
    $this->syndication_rights = $syndication_rights;
    return $this;
  }

  public function licenseId($license_id) {
    $this->license_id = $license_id;
    return $this;
  }

  public function licensorName($licensor_name) {
    $this->licensor_name = $licensor_name;
    return $this;
  }

  public function keyword($keyword) {
    $this->keyword = $keyword;
    return $this;
  }

  public function appendTo(ItemInterface $item) {
    $item->addMedia($this);
    return $this;
  }

  public function asXML() {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><media:content></media:content >', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

    $xml->addAttribute('url', $this->url);
    $xml->addAttribute('type', $this->type);

    if (!empty($this->thumbnail_url)) {
      $thumbnail = $xml->addChild('xmlns:media:thumbnail');
      $thumbnail->addAttribute('url', $this->thumbnail_url);
      $thumbnail->addAttribute('type', $this->thumbnail_type);
    }

    if (!empty($this->credit)) {
      $credit = $xml->addChild('xmlns:media:credit', $this->credit);
    }

    if (!empty($this->title)) {
      $title = $xml->addChild('xmlns:media:title', $this->title);
    }

    if (!empty($this->text)) {
      $text = $xml->addCdataChild('xmlns:media:text', $this->text);
    }

    // Adding focal region
    $focalRegion = $xml->addChild('xmlns:mi:focalRegion');
    $focalRegion->addChild('xmlns:media:x1', $this->x1);
    $focalRegion->addChild('xmlns:media:y1', $this->y1);
    $focalRegion->addChild('xmlns:media:x2', $this->x2);
    $focalRegion->addChild('xmlns:media:y2', $this->y2);
    // End Adding focal region

    $syndication_rights = $xml->addChild('xmlns:mi:hasSyndicationRights', $this->syndication_rights);

    if(!empty($this->keyword)){
      $keyword = $xml->addChild('xmlns:media:keywords', $this->keyword);
    }

    if (!empty($this->license_id)) {
      $licence_id = $xml->addChild('xmlns:mi:licenseId', $this->license_id);
    }
    if (!empty($this->licensor_name)) {
      $licensor_name = $xml->addChild('xmlns:mi:licensorName', $this->licensor_name);
    }

    return $xml;
  }

}