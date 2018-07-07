<?php

namespace FabWebStudio\RSSWriter;

/**
 * Class Item
 *
 * @package FabWebStudio\RSSWriter
 */
class Item implements ItemInterface {

  /** @var string */
  protected $title;

  /** @var string */
  protected $url;

  /** @var string */
  protected $description;

  /** @var string */
  protected $contentEncoded;

  /** @var array */
  protected $categories = [];

  /** @var string */
  protected $guid;

  /** @var bool */
  protected $isPermalink;

  /** @var int */
  protected $pubDate;

  /** @var int */
  protected $lastBuildDate;

  /** @var int */
  protected $updatedDate;

  /** @var array */
  protected $enclosure;

  /** @var string */
  protected $author;

  /** @var string */
  protected $creator;

  protected $preferCdata = FALSE;

  protected $medias = [];

  protected $links = [];

  protected $keywords = '';

  public function title($title) {
    $this->title = $title;
    return $this;
  }

  public function url($url) {
    $this->url = $url;
    return $this;
  }

  public function description($description) {
    $this->description = $description;
    return $this;
  }

  public function contentEncoded($content) {
    $this->contentEncoded = $content;
    return $this;
  }

  public function category($name, $domain = NULL) {
    $this->categories[] = [$name, $domain];
    return $this;
  }

  public function guid($guid, $isPermalink = FALSE) {
    $this->guid = $guid;
    $this->isPermalink = $isPermalink;
    return $this;
  }

  public function pubDate($pubDate) {
    $this->pubDate = $pubDate;
    return $this;
  }

  public function lastBuildDate($lastBuildDate) {
    $this->lastBuildDate = $lastBuildDate;
    return $this;
  }

  public function updatedDate($updatedDate) {
    $this->updatedDate = $updatedDate;
    return $this;
  }

  public function enclosure($url, $length = 0, $type = 'audio/mpeg') {
    $this->enclosure = ['url' => $url, 'length' => $length, 'type' => $type];
    return $this;
  }

  public function author($author) {
    $this->author = $author;
    return $this;
  }

  public function creator($creator) {
    $this->creator = $creator;
    return $this;
  }

  public function preferCdata($preferCdata) {
    $this->preferCdata = (bool) $preferCdata;
    return $this;
  }

  /**
   * Add item object
   *
   * @param MediaInterface $media
   *
   * @return $this
   */
  public function addMedia(MediaInterface $media) {
    $this->medias[] = $media;
    return $this;
  }

  public function addLink(LinkInterface $link) {
    $this->links[] = $link;
    return $this;
  }

  public function addKeywords(KeywordsInterface $keywords) {
    $this->keywords = $keywords;
    return $this;
  }

  public function appendTo(ChannelInterface $channel) {
    $channel->addItem($this);
    return $this;
  }

  public function asXML() {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><item></item>', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

    if ($this->preferCdata) {
      $xml->addCdataChild('title', $this->title);
    }
    else {
      $xml->addChild('title', $this->title);
    }

    if ($this->preferCdata) {
      $xml->addCdataChild('description', $this->description);
    }
    else {
      $xml->addChild('description', $this->description);
    }

    if ($this->contentEncoded) {
      $xml->addCdataChild('xmlns:content:encoded', $this->contentEncoded);
    }

    foreach ($this->categories as $category) {
      $element = $xml->addChild('category', $category[0]);

      if (isset($category[1])) {
        $element->addAttribute('domain', $category[1]);
      }
    }

    if ($this->guid) {
      $guid = $xml->addChild('guid', $this->guid);

      if ($this->isPermalink === FALSE) {
        $guid->addAttribute('isPermaLink', 'false');
      }
    }

    if (!empty($this->author)) {
      $xml->addChild('author', $this->author);
    }

    if ($this->pubDate !== NULL) {
      $xml->addChild('pubDate', date(DATE_RSS, $this->pubDate));
    }

    if ($this->lastBuildDate !== NULL) {
      $xml->addChild('lastBuildDate', date(DATE_RSS, $this->lastBuildDate));
    }

    if ($this->updatedDate !== NULL) {
      $xml->addChild('updatedDate', date(DATE_RSS, $this->updatedDate));
    }

    if($this->url){
      $xml->addChild('link', $this->url);
    }

    if (is_array($this->enclosure) && (count($this->enclosure) == 3)) {
      $element = $xml->addChild('enclosure');
      $element->addAttribute('url', $this->enclosure['url']);
      $element->addAttribute('type', $this->enclosure['type']);

      if ($this->enclosure['length']) {
        $element->addAttribute('length', $this->enclosure['length']);
      }
    }

    if (!empty($this->creator)) {
      $xml->addChild('dc:creator', $this->creator, "http://purl.org/dc/elements/1.1/");
    }

    foreach ($this->medias as $media) {
      $toDom = dom_import_simplexml($xml);
      $fromDom = dom_import_simplexml($media->asXML());
      $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, TRUE));
    }

    if(is_object($this->keywords)){
      $toDom = dom_import_simplexml($xml);
      $fromDom = dom_import_simplexml($this->keywords->asXML());
      $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, TRUE));
    }

    foreach ($this->links as $link) {
      $toDom = dom_import_simplexml($xml);
      $fromDom = dom_import_simplexml($link->asXML());
      $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, TRUE));
    }

    return $xml;
  }
}
