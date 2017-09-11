<?php

include "includes/config/Global.conf.php";

class Puush
{
    /**
    * Generates a random file name
    * by https://github.com/ajanvier/
    */
    private static function random_filename()
    {
        $random_string = md5(uniqid(rand(), true));
        return substr($random_string, 0, rand(4, 8));
    }

    /**
     * Generates an unused imagename
     */
    public static function generateFileName($extension)
    {
        global $uploadDirectory;
        $name = Puush::random_filename();

        while (file_exists($uploadDirectory."/".$name.".".$extension))
        {
            $name = Puush::random_filename();
        }

        return $name;
    }

    /**
     * Get extension of a file
     */
    public static function getExtension($file)
    {
        return end(explode(".", $file));
    }

    /**
     * Validate a file
     */
    public static function validateFile($file)
    {
        global $whitelist;
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $file["tmp_name"],FILEINFO_MIME_TYPE);
        finfo_close($finfo);


        if (array_key_exists($mimeType, $whitelist) == false)
            return false;

        if ($whitelist[$mimeType] != Puush::getExtension($file["name"]))
            return false;

        if (substr($mimeType, 0, 5) === "image")
        {
            $imgInfo = getimagesize($file["tmp_name"]);

            if (empty($imgInfo))
                return false;
        }

        return true;
    }
}