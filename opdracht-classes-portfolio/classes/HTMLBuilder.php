<?php

class HTMLBuilder
{
    
    protected $path;
    protected $extensie;
    
    function __construct( $path, $extensie ) {
        
        $this->path = $path;
        $this->extensie = $extensie;
    }
    
    public function getBestandsnaam () {
        
        return $this->path . $this->extensie;
        
    }
    
    public function buildHeader($bestandsnaam) {
        
        include './html/' . $bestandsnaam;
        
        $css = '';
        $handle = '';
        $file = 'global';
        // open the "css" directory
        if ($handle = opendir('css')) {
        // list directory contents
        while (false !== ($file = readdir($handle))) {
        // only grab file names
        if (is_file('css/' . $file)) {
            // insert HTML code for loading Javascript files
            $css .= '<link rel="stylesheet" href="css/' . $file .
                '" type="text/css" media="all" />' . "\n";
                }
            }
        }
    closedir($handle);
    echo $css;
    }
        
    
    public function buildBody($bestandsnaam) {
        
        require './html/' . $bestandsnaam;
        
    }
    
    public function buildFooter($bestandsnaam) {
        
        require './html/' . $bestandsnaam;
        $js = '';
        $handle = '';
        $file = 'script';
        // open the "js" directory
        if ($handle = opendir('js')) {
        // list directory contents
        while (false !== ($file = readdir($handle))) {
        // only grab file names
        if (is_file('js/' . $file)) {
            // insert HTML code for loading Javascript files
            $js .= '<script src="js/' . $file . '" type="text/javascript"></script>' . "\n";
        }
    }
    closedir($handle);
    echo $js;
}

        
    }
}