<?php
namespace App\Enums;


trait BaseEnum 
{
  public function __invoke() {
    return $this->value;
  }

  public static function getValueByDescription($value) {
    foreach (self::cases() as $case) {
        if($case->name == $value) {
            return $case->value;
        }
    }
  }

  public static function values($string=null)
  {
    $cases = array_column(self::cases(), "value");

    if($string) {
        $cases = implode(",", $cases);
    }

    return $cases;
  }

  public static function names()
  {
      return array_column(self::cases(), "name");
  }

}