<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Shop extends Model
{
  public $timestamps = false;

  private $rules = array(
    'title' => 'required|string|min:2|max:50',
    'region_id' => 'required|integer|min:1',
    'city' => 'required|string|min:2|max:20',
    'address' => 'required|string|min:2|max:120',
    'user_id' => 'required|integer|min:1'
  );

  public function get($prop = null) {
    if (!is_null($prop)) {
      return $this->$prop;
    } else {
      return $this->getAttributes();
    }
  }

  public function set($prop, $val = null) {
    if (!is_null($val)) {
      $this->$prop = $val;
    } else {
      foreach ($prop as $key => $val) {
        $this->$key = $val;
      }
    }
  }

  public function validate() {
    $data = $this->get();
    $validator = Validator::make($data, $this->rules);

    if ($validator->fails()) {
      $errors = $validator->messages();
      return $errors;
    }

    return true;
  }

  public function save(array $options = []) {
    parent::save($options);
  }
}