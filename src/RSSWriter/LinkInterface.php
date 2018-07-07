<?php
/**
 * Created by PhpStorm.
 * User: Coders Earth
 * Date: 9/30/2017
 * Time: 12:44 PM
 */

namespace FabWebStudio\RSSWriter;

/**
 * Interface Link Interface
 * @package FabWebStudio\RSSWriter
 */
interface LinkInterface {

  /**
   * LinkInterface constructor.
   *
   * @param $href
   * @param $title
   * @param string $relation
   * @param string $type
   */
  public function __construct($href,$title,$relation = 'related',$type='text/html');

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
   * @param string $content
   * @return $this
   */
  public function text($text);

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