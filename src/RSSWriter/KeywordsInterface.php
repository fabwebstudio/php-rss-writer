<?php
/**
 * Created by PhpStorm.
 * User: Coders Earth
 * Date: 10/3/2017
 * Time: 6:12 PM
 */

namespace FabWebStudio\RSSWriter;

/**
 * Interface KeywordsInterface
 *
 * @package FabWebStudio\RSSWriter
 */
interface KeywordsInterface {

  /**
   * KeywordsInterface constructor.
   *
   * @param string $keyword
   */
  public function __construct($keyword = '');
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