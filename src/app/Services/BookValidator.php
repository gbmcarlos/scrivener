<?php

namespace App\Services;

use App\Clients\OpenAiClient;
use Illuminate\Console\Concerns\InteractsWithIO;

class BookValidator {

    use InteractsWithIO;

    private OpenAiClient $openAiClient;

    public function __construct(OpenAiClient $openAiClient) {
        $this->openAiClient = $openAiClient;
    }

    public function validate(string $englishPath, string $spanishPath) {

        $englishBook = simplexml_load_file($englishPath);
        $spanishBook = simplexml_load_file($spanishPath);

        $englishChapters = $englishBook->xpath("//chapter");
        $spanishChapters = $spanishBook->xpath("//chapter");

        foreach ($englishChapters as $chapterIndex => $englishChapter) {

            $spanishChapter = $spanishChapters[$chapterIndex];
            $this->line("Validating Chapter {$chapterIndex}");
            $this->validateChapter(
                (array)$englishChapter->p,
                (array)$spanishChapter->p
            );

        }

    }

    protected function validateChapter(array $englishParagraphs, array $spanishParagraphs) {

        $this->line("English Count: " . count($englishParagraphs));
        $this->line("Spanish Count: " . count($spanishParagraphs));

        foreach ($englishParagraphs as $index => $englishParagraph) {

            if (!isset($spanishParagraphs[$index])) {
                throw new \Exception("Spanish paragraph with index {$index} doesn't exist");
            }

            $spanishParagraph = $spanishParagraphs[$index];

            $valid = $this->validateParagraph($englishParagraph, $spanishParagraph);

            if (!$valid) {

                $this->line("Paragraph {$index} invalid");
                $this->line("English:");
                $this->line($englishParagraph);
                $this->line("Spanish:");
                $this->line($spanishParagraph);

                break;

            }

        }

    }

    protected function validateParagraph($englishParagraph, $spanishParagraph) : bool {

        $prompt = "Answer with \"yes\" or \"no\". Are these 2 texts equivalent?";
        $prompt .= "\n- {$englishParagraph}";
        $prompt .= "\n- {$spanishParagraph}";

        $answer = $this->openAiClient->ask($prompt);
//        return true;

        if (str_contains(strtolower($answer), "no")) {
            return false;
        }

        return true;

    }

}