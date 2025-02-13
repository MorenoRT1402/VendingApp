<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private string $targetDirectory;
    private SluggerInterface $slugger;

    public function __construct(#[Autowire('%kernel.project_dir%/public/uploads/images')] string $targetDirectory, SluggerInterface $slugger, 
    private ParameterBagInterface $params, private Filesystem $fileSystem)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            throw new Exception('there is a problem with your file ' . $e->getMessage());
        }

        return $fileName;
    }

    public function delete(string $fileName){
        $path = $this->params->get('app.uploads_directory') . '/' . $fileName;

        $this->fileSystem->remove($path);
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}