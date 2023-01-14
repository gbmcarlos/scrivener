<?php

namespace App\Commands;

use Illuminate\Console\Command;

class TransformBookContentCommand extends Command {

    protected $signature = "transform-book-content {libraryFolder} {bookFile} {outputFolder}";

    public function handle() {

        $this->line("Library folder: " . $this->argument("libraryFolder"));
        $this->line("Book file: " . $this->argument("bookFile"));
        $this->line("Output folder: " . $this->argument("outputFolder"));
        $this->line("Current working directory: " . getcwd());

    }

}