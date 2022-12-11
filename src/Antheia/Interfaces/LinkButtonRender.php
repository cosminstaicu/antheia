<?php
namespace Antheia\Antheia\Interfaces;
/**
 * Defines the methods used in classes that can be rendered as buttons or as
 * links (tabs, fixedButtons, pageMenus etc)
 * @author Cosmin Staicu
 */
interface LinkButtonRender {
	/**
	 * The item will be redered as a link
	 * @var string
	 */
	const LINK = 'link';
	/**
	 * The item will be redered as a button
	 * @var string
	 */
	const BUTTON = 'button';
	/**
	 * Defines the render to be used by the item. It can be a button or a link.
	 * @param string $type the render type for the item, as one of the constants:
	 * <dl>
	 * <dt>LinkButtonRender::LINK</dt><dd>the item will be rendered as a link</dd>
	 * <dt>LinkButtonRender::BUTTON</dt><dd>the item will be rendered as a button</dd>
	 * </dl>
	 */
	public function setRender(string $type):void;
	/**
	 * Defines the href attribute if the item is rendered as a link (the action that
	 * will be triggered when the user clicks on the item)
	 * @param string $href the href attribute for the link of the item.
	 */
	public function setHref(string $href):void;
	/**
	 * The onClick script to be executed when the item is clicked
	 * @param string $code javascript code to be executed when the item
	 * is clicked
	 */
	public function setOnClick(string $code):void;
}
?>