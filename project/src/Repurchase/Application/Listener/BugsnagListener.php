<?php

namespace Repurchase\Application\Listener;
use Bugsnag\Client;
use Bugsnag\Report;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BugsnagListener
{
    /**
     * @var Client
     */
    private $bugsnag;
    /**
     * BugsnagListener constructor.
     * @param Client $bugsnag
     */
    public function __construct(Client $bugsnag)
    {
        $this->bugsnag = $bugsnag;
    }
    /**
     * @param \Throwable $error
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function __invoke(\Throwable $error, ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->bugsnag->notifyException($error, function (Report $report) use ($response, $request) {
            $report->setSeverity('error');
            $report->setUser([
                'token' => $request->getHeader('Authorization'),
            ]);
            $report->setMetaData([
                'status' => [
                    'code' => $response->getStatusCode(),
                ],
                'body' => [
                    'contents' => $request->getBody()->getContents()
                ]
            ]);
        });
    }
}
