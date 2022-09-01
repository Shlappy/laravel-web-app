<?php

if (!function_exists('convert_price')) {
  /**
   * @return float Converted price
   */
  function convert_price(?int $price): int
  {
    return is_null($price) ? 0 : intval($price / 100);
  }
}


if (!function_exists('format_price')) {
  /**
   * @return string Formatted price
   */
  function format_price(?int $price): string
  {
    return is_null($price) ? '0' : number_format($price, 0, '.', ' ');
  }
}
