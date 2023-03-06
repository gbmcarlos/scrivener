<?php

namespace App\Clients;

use Orhanerday\OpenAi\OpenAi;

class OpenAiClient {

    private OpenAi $openAi;

    public function __construct(string $privateKey) {
        $this->openAi = new OpenAi($privateKey);
    }

    public function ask(string $prompt) {

        $result = $this->openAi->chat([
            'model' => "gpt-3.5-turbo",
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ]);

        $result = json_decode($result, true);

        if (isset($result['error'])) {
            throw new \Exception($result['error']['message']);
        }

        return trim($result['choices'][0]['message']['content']);

    }

    public function completion(string $modelId, string $prompt) {

        $result = $this->openAi->completion([
            'model' => $modelId,
            'prompt' => $prompt
        ]);

        $result = json_decode($result, true);

        return trim($result['choices'][0]['text']);

    }

}