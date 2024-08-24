<?php
/**
 * Scroll Top Button
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! byron_get_mod( 'scroll_top', true ) ) return false;
?>

<a id="scroll-top"></a>