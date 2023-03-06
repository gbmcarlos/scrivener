<?php

namespace App\Commands;

use App\Services\BookValidator;
use Illuminate\Console\Command;

class ValidateBook extends Command {

    protected BookValidator $bookValidator;

    public function __construct(BookValidator $bookValidator) {
        parent::__construct();
        $this->bookValidator = $bookValidator;
    }

    protected $signature = "validate-book {booksDirectory} {bookNumber}";

    public function handle() {

        $this->bookValidator->setOutput($this->getOutput());

        $cwd = getcwd();
        $booksDirectory = $cwd . "/" . $this->argument("booksDirectory");
        $englishBookFile = $booksDirectory . "/" . $this->argument("bookNumber") . "-english.xml";
        $spanishBookFile = $booksDirectory . "/" . $this->argument("bookNumber") . "-spanish.xml";

        $this->line("Current working directory: {$cwd}");
        $this->line("English Book file: {$englishBookFile}");
        $this->line("Spanish Book file: {$spanishBookFile}");

        $this->validateBookEditing(
            $englishBookFile,
            $spanishBookFile
        );

    }

    protected function validateBookEditing(string $bookFile, string $outputPath) {

        $this->bookValidator->validate($bookFile, $outputPath);

    }

}