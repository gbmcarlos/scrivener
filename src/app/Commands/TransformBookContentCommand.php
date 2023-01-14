<?php

namespace App\Commands;

use App\Services\FB2Extractor;
use Illuminate\Console\Command;

class TransformBookContentCommand extends Command {

    public function __construct(FB2Extractor $fb2Extractor) {
        parent::__construct();
        $this->fb2Extractor = $fb2Extractor;
    }

    protected FB2Extractor $fb2Extractor;

    protected $signature = "transform-book-content {bookFile} {outputPath}";

    public function handle() {

        $cwd = getcwd();
        $bookFile = $cwd . "/" . $this->argument("bookFile");
        $outputPath = $cwd . "/" . $this->argument("outputPath");

        $this->line("Current working directory: " . $cwd);
        $this->line("Book file: " . $bookFile);
        $this->line("Output path: " . $outputPath);

        $this->transformBook(
            $bookFile,
            $outputPath
        );

    }

    protected function transformBook(string $bookFile, string $outputPath) {

        $this->fb2Extractor->process($bookFile, $outputPath);

    }

}