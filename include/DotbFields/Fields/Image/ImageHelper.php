<?php

class ImageHelper
{
    private $file;
    private $image;
    private $info;

    public function __construct($file)
    {
        if (file_exists($file)) {
            $this->file = $file;

            $info = getimagesize($file);

            $this->info = array(
                'width' => $info[0],
                'height' => $info[1],
                'bits' => $info['bits'],
                'mime' => $info['mime']
            );

            $this->image = $this->create($file);
        } else {
            exit('Error: Could not load image ' . $file . '!');
        }
    }

    private function create($image)
    {
        $mime = $this->info['mime'];

        if ($mime == 'image/gif') {
            return imagecreatefromgif($image);
        } elseif ($mime == 'image/png') {
            return imagecreatefrompng($image);
        } elseif ($mime == 'image/jpeg') {
            return imagecreatefromjpeg($image);
        }
    }

    public function save($file, $quality = 90)
    {
        //        $info = pathinfo($file);
        //        $extension = strtolower($info['extension']);
        //            } elseif($extension == 'gif') {
        //                } elseif($extension == 'png') {
        //                   if ($extension == 'jpeg' || $extension == 'jpg') {
        $mine = $this->info['mime'];

        if (is_resource($this->image)) {


            if ($mine == 'image/jpeg') {

                imagejpeg($this->image, $file, $quality);

            } elseif ($mine == 'image/png') {
                imagepng($this->image, $file);
            } elseif ($mine == 'image/gif') {
                imagegif($this->image, $file);
            }
            imagedestroy($this->image);
        }
    }

    public function resize($width = 0, $height = 0)
    {
        if (!$this->info['width'] || !$this->info['height']) {
            return;
        }
        //custom: Alovip
        if ($width == 0) {
            $temp = ceil(($this->info['width'] * $height) / $this->info['height']);
            $width = (int)$temp;
        } elseif ($height == 0) {
            $temp = ceil(($this->info['height'] * $width) / $this->info['width']);
            $height = (int)$temp;
        }
        //
        $xpos = 0;
        $ypos = 0;

        $scale = min($width / $this->info['width'], $height / $this->info['height']);

        if ($scale == 1 && $this->info['mime'] != 'image/png') {
            return;
        }

        $new_width = (int)($this->info['width'] * $scale);
        $new_height = (int)($this->info['height'] * $scale);
        $xpos = (int)(($width - $new_width) / 2);
        $ypos = (int)(($height - $new_height) / 2);

        $image_old = $this->image;
        $this->image = imagecreatetruecolor($width, $height);

        if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
            imagecolortransparent($this->image, $background);
        } else {
            $background = imagecolorallocate($this->image, 255, 255, 255);
        }

        imagefilledrectangle($this->image, 0, 0, $width, $height, $background);

        imagecopyresampled($this->image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);

        $this->info['width'] = $width;
        $this->info['height'] = $height;
    }

    public function watermark($file, $position = 'bottomright')
    {
        $watermark = $this->create($file);

        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);

        switch ($position) {
            case 'topleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = 0;
                break;
            case 'topright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = 0;
                break;
            case 'bottomleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
            case 'bottomright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
        }

        imagecopy($this->image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, 120, 40);

        imagedestroy($watermark);
    }

    public function crop()
    {

        //Tuan Anh crop pic
        $centreX = round($this->info['width'] / 2);
        $centreY = round($this->info['height'] / 2);

        $cropWidth = min($this->info['width'],$this->info['height']);
        $cropHeight = min($this->info['width'],$this->info['height']);;
        $cropWidthHalf = round($cropWidth / 2); // could hard-code this but I'm keeping it flexible
        $cropHeightHalf = round($cropHeight / 2);

        $top_x = max(0, $centreX - $cropWidthHalf);
        $top_y = max(0, $centreY - $cropHeightHalf);

        $bottom_x = min($this->info['width'], $centreX + $cropWidthHalf);
        $bottom_y = min($this->info['height'], $centreY + $cropHeightHalf);
        //end
        $image_old = $this->image;
        $this->image = imagecreatetruecolor($bottom_x - $top_x, $bottom_y - $top_y);

        imagecopy($this->image, $image_old, 0, 0, $top_x, $top_y, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);

        $this->info['width'] = $bottom_x - $top_x;
        $this->info['height'] = $bottom_y - $top_y;
    }

    public function rotate($degree, $color = 'FFFFFF')
    {
        $rgb = $this->html2rgb($color);

        $this->image = imagerotate($this->image, $degree, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));

        $this->info['width'] = imagesx($this->image);
        $this->info['height'] = imagesy($this->image);
    }

    private function filter($filter)
    {
        imagefilter($this->image, $filter);
    }

    private function text($text, $x = 0, $y = 0, $size = 5, $color = '000000')
    {
        $rgb = $this->html2rgb($color);

        imagestring($this->image, $size, $x, $y, $text, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
    }

    private function merge($file, $x = 0, $y = 0, $opacity = 100)
    {
        $merge = $this->create($file);

        $merge_width = imagesx($image);
        $merge_height = imagesy($image);

        imagecopymerge($this->image, $merge, $x, $y, 0, 0, $merge_width, $merge_height, $opacity);
    }

    private function html2rgb($color)
    {
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        if (strlen($color) == 6) {
            list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return false;
        }

        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return array($r, $g, $b);
    }

    private static function reflejarImagen($imagenOriginal)
    {
        $anchura = imagesx($imagenOriginal);
        $altura = imagesy($imagenOriginal);

        $origenDeX = $anchura - 1;
        $origenDeY = 0;
        $anchura_original = -$anchura;
        $altura_original = $height;

        $imagenDeDestino = imagecreatetruecolor($anchura, $altura);

        if (imagecopyresampled($imagenDeDestino, $imagenOriginal, 0, 0, $origenDeX, $origenDeY, $anchura, $altura, $anchura_original, $altura_original)) return $imagenDeDestino;

        return $imagenOriginal;
    }
}

?>