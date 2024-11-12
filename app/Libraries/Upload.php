<?php

/**
 * Class that is responsible for uploading media to system.
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2024 Php7 Alex
 * @version 1.0.1
 */

class Upload {

    // private $dir = '../public/uploads/';
    /** @var string default Directory */
    private $dir;
    /** @var files archive */
    private $archive;
    /** @var int file size */
    private $size;
    /** @var string file name */
    private $name;
    /** @var string child folder */
    private $folder;

    /** @var string file name */
    private $result;
    /** @var string error */
    private $error;

    /**
     * Verifies if upload has succeeded
     * @return string  file name or false
     */
    public function getResult() :string {
        return $this->result;
    }

    /**
     * Shows error text
     * @return string  Error
     */
    public function getError() :string {
        return $this->error;
    }

    //Verifies and creates uploads desfault folder. Optionally informs a directory name.
    public function __construct(string $direct = null) {

        // if dir exists = dir, else dir = uploads
        // $this->dir = $direct ? $direct : 'uploads';
        $this->dir = $direct ?? 'uploads';
        // above null covalescence
        if (!file_exists($this->dir) && !is_dir($this->dir)) :
            // dir, permissions
            mkdir($this->dir, 0777);
        endif;
    }

    /**
     * Validates images uploads
     * @param array $img image
     * @param string $imgName image name - optional
     * @param string $imgFolder folder name - optional
     * @param int $imgSize max size - optional, 2gb default
     */
    public function image(array $img, string $imgName = null, string $imgFolder = null, int $imgSize = null) {
        // $this->archive = (array) $img;
        $this->archive = $img;
        $this->name = $imgName ?? pathinfo($this->archive['name'], PATHINFO_FILENAME);
        $this->folder = $imgFolder ?? 'images';
        $this->size = $imgSize ?? 10;

        // gets file extension
        $ext = pathinfo($this->archive['name'], PATHINFO_EXTENSION);
        // var_dump($ext);

        $validExts = ['png', 'jpg'];

        // valids MIME Types
        $validTypes = ['image/jpeg', 'image/png'];

        // verifies if permitted extensions exists in array
        if (!in_array($ext, $validExts)) :
            // echo ' Invalid Extension ';
            $this->error = ' Invalid Extension ';
            // where result == null
            $this->result = false;
        
        // verifies if permitted MIME Types exists in array
        elseif (!in_array($this->archive['type'], $validTypes)) :
            // echo ' Invalid Type ';
            $this->error =  ' Invalid Type ';
            // where result == null
            $this->result = false;

        // verifies if permitted size
        elseif ($this->archive['size'] > $this->size * (1024 * 1024)) :
            // echo ' File very large ';
            $this->error =  ' File very large ';
            // where result == null
            $this->result = false;
        else :
            $this->makeFolder();
            $this->rename();
            // echo 'You can send this file';
            $this->moveFile();
        endif;
    }

    // Checks file's existence, if yes rename it adding a Br date to file name
    private function rename(){
        $file = $this->name.strrchr($this->archive['name'], '.');
        // concat filename with extension
        // if (file_exists($this->dir.DIRECTORY_SEPARATOR.$file)):
        if (file_exists($this->dir. DIRECTORY_SEPARATOR. $this->folder.DIRECTORY_SEPARATOR. $file)):
            $file = $this->name.'-'.date('d-m-Y-h_i-s').strrchr($file, '.');
        endif;
        $this->name = $file;
    }

    // Checks and creates child folder inside default directory
    private function makeFolder(){
        if (!file_exists($this->dir) . DIRECTORY_SEPARATOR.$this->folder && !is_dir($this->dir.DIRECTORY_SEPARATOR.$this->folder)) :
            // dir, permissions
            mkdir($this->dir.DIRECTORY_SEPARATOR.$this->folder, 0777);
        endif;
    }

    // Move files to directory and save file name in result
    private function moveFile() {
        // if (move_uploaded_file($this->archive['tmp_name'], $this->dir.          DIRECTORY_SEPARATOR.$this->archive['name'])):
        if (move_uploaded_file($this->archive['tmp_name'], $this->dir.DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->name )):
            // $this->result =  $this->archive['name'];
            $this->result = $this->name ;
        else:
            $this->result = false;
            $this->error = 'Error moving file';
        endif;
    }

}

