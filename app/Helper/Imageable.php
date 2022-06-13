<?php

namespace App\Helper;

Trait Imageable 
{
  /**
   * Stores media and writes records to database;
   * todo: store image in a separate function
   */
  public function storeMedia($request) 
  {
    // Return if there is no images
    if (!$request->hasFile('image')) return $this;

    $path = storage_path('app/public/images');
    // if (!file_exists($path)) mkdir($path, 0777, true);

    $imagesId = [];

    foreach ($request->file('image') as $image) {
      $fileName = uniqid() . '_' . trim($image->getClientOriginalName());
      $image->move($path, $fileName);

      // Write record to database
      $image = new \app\Models\Image;
      $image->title = $fileName;
      $image->path = $path;
      $image->save();

      $imagesName[] = $fileName;
    }

    $this->images = json_encode($imagesId);
    $this->save();

    return $this;
  }
}