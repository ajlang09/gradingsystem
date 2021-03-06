<?php 
namespace App\Traits;

use \Webpatser\Uuid\Uuid;

trait UuidForKey
{
    /**
     * Boot the Uuid trait for the model.
     *
     * @return void
     */
    public static function bootUuidForKey()
    {
        static::creating(function ($model) {
            $model->incrementing = false;
            if (!$model->{$model->getKeyName()}) {
                $model->{$model->getKeyName()} = (string)Uuid::generate();
            }
        });
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts()
    {
        return $this->casts;
    }
}