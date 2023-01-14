<?php

namespace App\Services;

/*
 * Converts the contents of a *.fb2 file to a *.jsonl
 * Receives a SimpleXMLElement containing the whole book, and returns an array of strings
 * It will only consider content inside of a <p> element
 */
class FB2Extractor {

    public function process(string $bookFile, string $outputPath) {

        $inputBook = new \SimpleXMLElement(file_get_contents($bookFile));
        $outputBook = new \SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><book></book>");

        $this->extractContent($inputBook, $outputBook);

        $this->saveBookXML($outputBook, $outputPath);

    }

    protected function extractContent(\SimpleXMLElement $inputBook, \SimpleXMLElement $outputBook) {

        $a = '';

    }

    protected function saveBookXML(\SimpleXMLElement $book, string $outputPath) {

        $dom = new \DOMDocument('1.0','UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($book->asXML());
        $dom->save($outputPath);

    }

}