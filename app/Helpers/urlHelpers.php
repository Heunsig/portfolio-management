<?php

function image_path ($dir, $type='local') {
    switch ($type) {
        case 'local':
          return $dir ? url('storage/'.$dir) : null;
        case 's3':
            return $dir ? env('AWS_OBJECT_BASEURL'). '/' . $dir : null;
        default: 
            return null;
    }
}