<?php

class CharactersController
{

    public function getCharacters()
    {

        $url = 'https://rickandmortyapi.com/api/character';
        $response = file_get_contents($url);


        if (empty ($response)) { //Se não tiver os dados, eles virão como null ou vazio e será retornado um erro
            http_response_code(500);
            return array(
                'error' => true,
                'message' => 'Erro interno.'
            );
        }


        $data = json_decode($response, true);

        if ($data === null) {
            http_response_code(500);
            return array(
                'error' => true,
                'message' => 'Erro ao decodificar os dados JSON'
            );
        }
        
        // Retorna os dados desejados
        http_response_code(200);
        return array(
            'error' => false,
            'info' => $data['info'],
            'results' => $data['results']
        );

    }

}