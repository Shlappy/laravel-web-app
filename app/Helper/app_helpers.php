<?php

if (!function_exists('convert_price')) {
  /**
   * @return string Converted price
   */
  function convert_price(int|null $price): int
  {
    return is_null($price) ? 0 : $price / 100;
  }
}


if (!function_exists('format_price')) {
  /**
   * @return string Formatted price
   */
  function format_price(int|null $price): string
  {
    return is_null($price) ? '0' : number_format($price / 100, 0, '.', ' ');
  }
}
