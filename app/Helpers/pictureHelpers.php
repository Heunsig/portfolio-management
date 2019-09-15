<?php
    
    /**
     * returns thumbnil directory which fits to the size parameter
     * @param  Eloquent Object $picture
     * @param  String $size   
     * @return String or Null
     */
    function get_thumbnail($picture=null, $size) {
        if ($picture){
            if ($picture->alternative_images) {
                $first_image = $picture->alternative_images->where('size', $size)->first();
                if ($first_image) {
                    return $first_image->saved_dir;
                }
            }    
        }

        return null;
    }