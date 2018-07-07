<?php

namespace FabWebStudio\RSSWriter;

/**
 * Interface ItemInterface
 *
 * @package FabWebStudio\RSSWriter
 */
interface ItemInterface {

  /**
   * Set item title
   *
   * @param string $title
   *
   * @return $this
   */
  public function title($title);

  /**
   * Set item URL
   *
   * @param string $url
   *
   * @return $this
   */
  public function url($url);

  /**
   * Set item description
   *
   * @param string $description
   *
   * @return $this
   */
  public function description($description);

  /**
   * Set content:encoded
   *
   * @param string $content
   *
   * @return $this
   */
  public function contentEncoded($content);

  /**
   * Set item category
   *
   * @param string $name Category name
   * @param string $domain Category URL
   *
   * @return $this
   */
  public function category($name, $domain = NULL);

  /**
   * Set GUID
   *
   * @param string $guid
   * @param bool $isPermalink
   *
   * @return $this
   */
  public function guid($guid, $isPermalink = FALSE);

  /**
   * Set published date
   *
   * @param int $pubDate Unix timestamp
   *
   * @return $this
   */
  public function pubDate($pubDate);

  /**
   * Set last update date
   *
   * @param int $lastBuildDate Unix timestamp
   *
   * @return $this
   */
  public function lastBuildDate($lastBuildDate);


  /**
   * Set last update date
   *
   * @param int $updatedDate Unix timestamp
   *
   * @return $this
   */
  public function updatedDate($updatedDate);

  /**
   * Set enclosure
   *
   * @param string $url Url to media file
   * @param int $length Length in bytes of the media file
   * @param string $type Media type, default is audio/mpeg
   *
   * @return $this
   */
  public function enclosure($url, $length = 0, $type = 'audio/mpeg');

  /**
   * Set the author
   *
   * @param string $author Email of item author
   *
   * @return $this
   */
  public function author($author);

  /**
   * Add media object
   *
   * @param MediaInterface $media
   *
   * @return $this
   */
  public function addMedia(MediaInterface $media);

  /**
   * Add Link object
   *
   * @param \FabWebStudio\RSSWriter\LinkInterface $link
   *
   * @return mixed
   */
  public function addLink(LinkInterface $link);

  /**
   * Add keywords
   *
   * @param \FabWebStudio\RSSWriter\KeywordsInterface $keywords
   *
   * @return mixed
   */
  public function addKeywords(KeywordsInterface $keywords);

  /**
   * Append item to the channel
   *
   * @param \FabWebStudio\RSSWriter\ChannelInterface $channel
   *
   * @return $this
   */
  public function appendTo(ChannelInterface $channel);

  /**
   * Return XML object
   *
   * @return \FabWebStudio\RSSWriter\SimpleXMLElement
   */
  public function asXML();
}
