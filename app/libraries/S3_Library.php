<?php namespace XyLex\Libraries;

use \XyLex\Config;

class S3_Library {
    public function __construct() {
        $this->s3_config = Config::Load('S3_Config');
    }
}