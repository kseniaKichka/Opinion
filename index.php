<?php

class Manager {

    public static $start;
    private $handle;
    private $path;
    private static $instance;
    const UP = "Up";
    private $type = array(1 => 'folder', 2 => 'file');

    public static function getInstance($start) {
        if (empty(self::$instance)) {
            self::$instance = new Manager();
            self::$start = $start;
        }
        return self::$instance;
    }

    public function getPath() {
        return $this->unsetSlash($this->path);
    }

    private function unsetSlash($path) {
        return str_replace('//', '/', $path);
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
        $dirs = $this->getSort($_GET['sort'], $dirs);
        return $dirs;
    }

    private function getSort($get, $array) {
        if ($this->checkGet($get)) {
            switch ($get) {
                case 'name_asc':
                    usort($array, function ($a, $b) {
                        return (strcmp($a["res"], $b["res"]));
                    });
                    break;
                case 'name_desc':
                    usort($array, function ($b, $a) {
                        return (strcmp($a["res"], $b["res"]));
                    });
                    break;
                case 'type_asc':
                    usort($array, function ($a, $b) {
                        return ($a["type"] - $b["type"]);
                    });
                    break;

                case 'type_desc':
                    usort($array, function ($b, $a) {
                        return ($a["type"]- $b["type"]);
                    });
                    break;
                case 'size_asc':
                    usort($array, function ($a, $b) {
                        return ($a["size"] - $b["size"]);
                    });
                    break;

                case 'size_desc':
                    usort($array, function ($b, $a) {
                        return ($a["size"]- $b["size"]);
                    });
                    break;

            }
        }
        return $array;
    }

    private function checkDir($path, $dir) {
        return is_dir($path.'/'.$dir) && $dir!="." && $dir!="..";
    }

    private function checkFile($path, $file) {
        return is_file($path.'/'.$file);
    }

    public function getUp() {
        if (!$this->checkEmptyGet($_GET['f'])) {
            return "<a class='btn btn-info' href='?f=".$this->getUpUrl($_GET['f'])."'>".UP."</a>";
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

    private function getSize($file) {
        return filesize($file);
    }

    public function getType($k) {
        return $this->type[$k];
    }
}

$inst = Manager::getInstance('/home/ksu/websites');
$files = $inst->readCatalog('.');
$up = $inst->getUp();

include 'files.php';
$inst->closeDir('.');