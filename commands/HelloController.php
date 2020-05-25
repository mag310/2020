<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Amp\Loop;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /** @var string */
    public $myText;

    /**
     * @inheritDoc
     */
    public function init(){
        parent::init();



    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message;
        return ExitCode::OK;
    }

    /**
     * Test daemon
     * @param int $forkNum
     * @return int
     */
    public function actionDaemon($forkNum = 0)
    {

        Loop::run(function () {
            echo "Please input some text: ";
            stream_set_blocking(STDIN, false);
            // Watch STDIN for input
            Loop::onReadable(STDIN, [$this, "onInput"]);

            Loop::delay($msDelay = 5000, "Amp\\Loop::stop");
        });

        echo $this->myText . PHP_EOL;
        return ExitCode::OK;
    }

    public function worker()
    {
        echo 'tick' . PHP_EOL;
    }


    function onInput($watcherId, $stream)
    {
        $this->myText = fgets($stream);
        stream_set_blocking(STDIN, true);

        Loop::cancel($watcherId);
        Loop::stop();
    }
}
