<?php

class Manager {

    public static $start;
    private $handle;
    private $path;
    private static $instance;

    public static function getInstance($start) {
        if (empty(self::$instance)) {
            self::$instance = new Manager();
            self::$start = $start;
        }
        return self::$instance;
    }

    public function getPath() {
        return $this->path;
    }

    public function getDir() {
        return dirname($this->start);
    }

    public function openDir($path = '.') {
        $this->setPath($_GET['f'], $path);
        $this->path = $this->createPath($this->path);
        return opendir($this->path);
    }

    private function setPath($get, $path) {
        if ($this->checkGet($get)) {
            $path = $get;
        }

        return $this->path = $path;
    }

    private function createPath($path) {
        return self::$start."/".$path;
    }

    private function checkGet($get) {
        return isset($get);
    }

    private function checkEmptyGet($get) {
        return empty($get);
    }

    public function closeDir($path) {
        closedir($path);
    }

    public function readCatalog($path = '.') {
        $this->handle = $this->openDir($path);

        while (false !== ($dir = readdir($this->handle))) {

            if ($this->checkDir($this->path, $dir)) {
                $arr['res'] = $dir;
                $arr['type'] = 1; //folder
                $dirs[] =  $arr;
            }

            if ($this->checkFile($this->path, $dir)) {
                $arr['res'] = $dir;
                $arr['type'] = 2; //file
                $arr['size'] = $this->getSize($this->getFull($this->path, $dir));
                $dirs[] = $arr;
            }

        }
        if (isset($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'name_asc':
                    usort($dirs, function ($a, $b) {
                        return (strcmp($a["res"], $b["res"]));
                    });
                    break;
                case 'name_desc':
                    usort($dirs, function ($b, $a) {
                        return (strcmp($a["res"], $b["res"]));
                    });
                    break;
                case 'type_asc':
                    usort($dirs, function ($a, $b) {
                        return ($a["type"] - $b["type"]);
                    });
                    break;

                case 'type_desc':
                    usort($dirs, function ($b, $a) {
                        return ($a["type"]- $b["type"]);
                    });
                    break;
                case 'size_asc':
                    usort($dirs, function ($a, $b) {
                        return ($a["size"] - $b["size"]);
                    });
                    break;

                case 'size_desc':
                    usort($dirs, function ($b, $a) {
                        return ($a["size"]- $b["size"]);
                    });
                    break;

            }
        }
        return $dirs;
    }



    public function readDir($path = '.') {

        $this->handle = $this->openDir($path);

        while (false !== ($dir = readdir($this->handle))) {

            if ($this->checkDir($this->path, $dir)) {

                $dirs[]= $dir;
            }

        }

        return $dirs;
    }

    public function readFiles($path = '.') {

        $this->handle = $this->openDir($path);

        while (false !== ($dir = readdir($this->handle))) {

            if($this->checkFile($this->path, $dir)){

                $files[]=$dir;
            }

        }

        return $files;
    }

    private function checkDir($path, $dir) {
        return is_dir($path.'/'.$dir) && $dir!="." && $dir!="..";
    }

    private function checkFile($path, $file) {
        return is_file($path.'/'.$file);
    }

    public function getUp() {
        if (!$this->checkEmptyGet($_GET['f'])) {
            return "<a class='btn btn-info' href='?f=".$this->getUpUrl($_GET['f'])."'>&lt;&lt;НАВЕРХ</a>";
        }
    }

    private function getUpUrl($get) {
        return substr($get,0,$this->getSlash($get));
    }

    private function getSlash($get) {
        return strrpos($get,"/");
    }

    private function getFull($path, $dir) {
        return $path.'/'.$dir;
    }

    public function getSize($file) {
        return filesize($file);
    }
}

$inst = Manager::getInstance('/home/ksu/websites');
//$catalogues = $inst->readDir('.');
//$files = $inst->readFiles('.');
$files = $inst->readCatalog('.');
$up = $inst->getUp();

include 'files.php';
$inst->closeDir('.');