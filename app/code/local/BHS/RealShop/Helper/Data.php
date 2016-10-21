<?php

class BHS_RealShop_Helper_Data extends Mage_Core_Helper_Data
{
    public function resizeImage($fileName, $width = 0, $height = 0, $aspecRatio = true) {
        $mediaURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $fileName;
        $height = ($height ? $height : $width);
        $newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'resized' . DS . $width . 'x' . $height . DS . $fileName;
        if (!file_exists(Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'resized' . DS . $width . 'x' . $height)) {
            mkdir(Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'resized' . DS . $width . 'x' . $height, 0777,true);
        };
        //if width empty then return original size image's URL
        if ($width) {
            //if image has already resized then just return URL
            if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
                $imageObj = new Varien_Image($basePath);
                $imageObj->keepAspectRatio($aspecRatio);
                $imageObj->keepFrame(true);
                $imageObj->keepTransparency(true);
                $imageObj->constrainOnly(true);
                $imageObj->backgroundColor(array(255, 255, 255));
                $imageObj->resize($width, $height);
                $imageObj->save($newPath);
            }
            $resizedURL = $mediaURL . str_replace(DS, '/', 'resized' . DS . $width . 'x' . $height . DS . $fileName);
        } else {
            $resizedURL = $mediaURL . str_replace(DS, '/', $fileName);
        }
        return $resizedURL;
    }

    public function getShopListUrl() {
        return Mage::getUrl('realshop');
    }

}