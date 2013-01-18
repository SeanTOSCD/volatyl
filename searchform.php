<?php
/**
 * The template for displaying search forms in Volatyl
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

echo 	"<form method=\"get\" id=\"searchform\" action=\"", 
		esc_url( home_url( '/' ) ), "\" role=\"search\">\n",
		"\t<label for=\"s\" class=\"assistive-text\">", 
		__( 'Search', 'volatyl' ), "</label>\n",
		"\t<input type=\"text\" class=\"field\" name=\"s\" value=\"", 
		esc_attr( get_search_query() ), "\" id=\"s\" placeholder=\"", 
		esc_attr_e( 'Enter Keyword(s)&hellip;', 'volatyl' ), "\" />\n",
		"\t<input type=\"submit\" class=\"submit\" name=\"submit\" id=\"searchsubmit\" value=\"", 
		esc_attr_e( 'Search', 'volatyl' ), "\" />\n",
		"</form>";

