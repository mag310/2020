<?php

namespace app\commands;

use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Server\Router;
use Amp\Http\Server\StaticContent\DocumentRoot;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Loop;
use Amp\Promise;
use Amp\Socket\Server as SocketServer;
use Amp\Success;
use Amp\Websocket\Client;
use Amp\Websocket\Message;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Endpoint;
use Amp\Websocket\Server\Websocket;
use Monolog\Logger;
use function Amp\ByteStream\getStdout;

use app\commands\ws\wsHandler;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Обработка WS
 */
class WsController extends Controller
{
    /** @var Websocket */
    public $ws;

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->ws = new Websocket(new wsHandler());
    }

    /**
     * @return Promise
     * @throws \Amp\Socket\SocketException
     */
    public function actionRun()
    {
        Loop::run(function (): Promise {

            $sockets = [
                SocketServer::listen('0.0.0.0:1337'),
            ];

            $router = new Router;
            $router->addRoute('GET', '/broadcast', $this->ws);
            $router->setFallback(new DocumentRoot(__DIR__ . '/../web/public'));

            $logHandler = new StreamHandler(getStdout());
            $logHandler->setFormatter(new ConsoleFormatter);
            $logger = new Logger('server');
            $logger->pushHandler($logHandler);

            $server = new HttpServer($sockets, $router, $logger);

            return $server->start();
        });

        return ExitCode::OK;
    }
}