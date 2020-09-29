<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;
    private $targetTicket;

    public function __construct($targetDirectory,$targetTicket)
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetTicket = $targetTicket;
    }

    public function upload(UploadedFile $file, Object $test)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        if($test instanceof User){
            try {
                $file->move($this->getTargetDirectory(), $fileName);
            } catch (FileException $e) {

            }
        }else{
            try {
                $file->move($this->getTargetTicket(), $fileName);
            } catch (FileException $e) {
                
            }
        }
        

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
    public function getTargetTicket()
    {
        return $this->targetTicket;
    }
}