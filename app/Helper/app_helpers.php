<?php

if (! function_exists('convert_price')) {
  function convert_price(int|null $price)
  {
    return $price ?? 0;
  }
}