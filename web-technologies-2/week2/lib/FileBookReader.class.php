<?php
class FileBookReader implements BookReader {
    
    private $file;
    
    function __construct(string $fileName) {
        $this->file = fopen($fileName, 'r');
    }
    
    /*function readBook() : ?array {
        $book = [];
        
        while (($line = fgets($this->file)) !== false) {
            $line = trim($line); 
            
            if ($line === "") { 
                break;
            }
            
            $delimiterPos = strpos($line, ':');
            if ($delimiterPos === false) {
                throw new Exception("Invalid format");
            }
            
            $property = trim(substr($line, 0, $delimiterPos));
            $value = trim(substr($line, $delimiterPos + 1));
            
            $book[$property] = $value;
        }
        
        return $book;
    }
}
    */
    function readBook() : ?array {
        $book = [];
        
        while (($line = fgets($this->file)) !== false) {
            $line = trim($line); 
            
           if ($line === "") {
            if (!empty($book)) {
                break;
            }
            continue;
        }
            
            $delimiterPos = strpos($line, ':');
            if ($delimiterPos === false) {
                throw new Exception("Invalid format");
            }
            
            $property = trim(substr($line, 0, $delimiterPos));
            $value = trim(substr($line, $delimiterPos + 1));
            
            $book[$property] = $value;
        }
        
        return !empty($book) ? $book : null;
    }
}


?>
