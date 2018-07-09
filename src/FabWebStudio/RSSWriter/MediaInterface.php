<?php


namespace FabWebStudio\RSSWriter;

/**
 * Interface MediaInterface
 * @package FabWebStudio\RSSWriter
 */
interface MediaInterface {

  /**
   * MediaInterface constructor.
   *
   * @param $url
   * @param string $type
   */
  public function __construct($url,$type = 'image/jpeg');

  /**
   * Set Thumbnail
   *
   * @param $thumbnail_url
   * @param $thumbnail_type
   *
   * @return $this
   *
   */
  public function thumbnail($thumbnail_url,$thumbnail_type = 'image/jpeg');

  /**
   * Set Credit
   *
   * @param $credit
   *
   * @return $this
   */
  public function credit($credit);

  /**
   * Set Title
   *
   * @param $title
   *
   * @return $this
   */
  public function title($title);

  /**
   * Set content:encoded
   * @param string $text
   * @return $this
   */
  public function text($text);

  /**
   * Set focal Region
   *
   * @param int $x1
   * @param int $y1
   * @param int $x2
   * @param int $y2
   *
   * @return $this
   */
  public function focalRegion($x1 = 246, $y1 = 140, $x2 = 246, $y2 = 140);

  /**
   * Set Rights
   *
   * @param int $syndication_rights
   *
   * @return $this
   */
  public function hasSyndicationRights($syndication_rights = 1);

  /**
   * Set License Id
   *
   * @param $license_id
   *
   * @return $this
   */
  public function licenseId($license_id);

  /**
   * Set licensor name
   *
   * @param $licensor_name
   *
   * @return $this
   */
  public function licensorName($licensor_name);

  /**
   * Set media keyword
   *
   * @param $keyword
   *
   * @return $this
   */
  public function keyword($keyword);

  /**
   * Append to item
   *
   * @param \FabWebStudio\RSSWriter\ItemInterface $item
   *
   * @return $this
   */
  public function appendTo(ItemInterface $item);

  /**
   * Return XML object
   * @return \FabWebStudio\RSSWriter\SimpleXMLElement
   */
  public function asXML();
}