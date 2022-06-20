<?php

namespace Amp\Http\Server;

/**
 * A ClientException thrown from Body::read() or Body::buffer() indicates that the requesting client stream has been
 * closed due to an error or exceeding a server limit such as the body size limit.
 *
 * Applications may optionally catch this exception in request handlers to continue other processing. Users are NOT
 * required to catch it and if left uncaught it will simply end request handler execution. For streaming response bodies
 * in which the handler is also reading the request body, this exception should be caught and used to fail the streaming
 * response body.
 *
 * Creating and throwing a ClientException from a request handler or failing streaming response body will abruptly
 * disconnect a client. It is not recommended to create ClientException instances in a request handler.
 *
 * Responses returned by request handlers after a ClientException has been thrown will be ignored, as a response has
 * already been generated by the error handler.
 */
class ClientException extends \Exception
{
    /** @var Driver\Client */
    private $client;

    public function __construct(Driver\Client $client, string $message, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->client = $client;
    }

    final public function getClient(): Driver\Client
    {
        return $this->client;
    }
}