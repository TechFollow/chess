<?php


namespace App\Service\Chess\Updater;

use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder
{
    private $content;
    private $status;
    private $contentType;

    /**
     * ResponseBuilder constructor, json response by default
     */
    public function __construct()
    {
        $this->status = ResponseStatus::SUCCESS;
        $this->contentType = array('Content-type', 'json');
        $this->content = array();
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setContent(array $content): void
    {
        $this->content = $content;
    }

    public function createResponse()
    {
        $response = new Response(json_encode($this->content),
                        $this->status,
                        $this->contentType);

        return $response;
    }
}