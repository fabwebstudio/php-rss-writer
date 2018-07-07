<?php
/**
 * Created by PhpStorm.
 * User: Coders Earth
 * Date: 9/30/2017
 * Time: 12:49 PM
 */

namespace FabWebStudio\RSSWriter;


class Link implements LinkInterface {

  protected $href;

  protected $link_title;

  protected $relation;

  protected $type;

  protected $thumbnail_url;

  protected $thumbnail_type;

  protected $credit;

  protected $title;

  protected $text;

  public function __construct($href, $title, $relation = 'related', $type = 'text/html') {

    $this->href = $href;
    $this->link_title = $title;
    $this->relation = $relation;
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

  public function appendTo(ItemInterface $item) {
    $item->addLink($this);
    return $this;
  }

  public function asXML() {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><link></link >', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

    $xml->addAttribute('rel', $this->relation);
    $xml->addAttribute('type', $this->type);
    $xml->addAttribute('href', $this->href);
    $xml->addAttribute('title', $this->link_title);

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

    return $xml;
  }

}