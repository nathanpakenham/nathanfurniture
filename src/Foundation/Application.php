<?php

namespace App\Foundation;

use App\Controller\ErrorController;
use App\Controller\NotFoundController;
use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Slim\Route;
use Slim\Slim;

class Application
{
	private ?Slim $app = null;

	public function init(): void
	{
		$this->loadSession();
		$this->loadEnvironment();
		$this->loadDebugging();

		// slim specific
		$this->loadSlim();
		$this->loadLogging();
		$this->loadErrorPages();
		$this->loadCommon();
		$this->loadRouting();
		$this->loadHooks();
	}

	private function loadSession(): void
	{
		Session::start();
	}

	private function loadEnvironment(): void
	{
		ini_set('display_errors', '1');


		if (!file_exists(dirname(__DIR__, 2) . '/.env')) {
			die('env file not found');
		}

		$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
		$dotenv->load();
	}

	private function loadDebugging(): void
	{
		if (isset($_ENV['APP_MODE']) && $_ENV['APP_MODE'] === 'dev') {
			ini_set('display_errors', '1');
		} else {
			ini_set('display_errors', '0');
		}
	}

	public function run(): void
	{
		$this->app->run();
	}

	private function loadSlim(): void
	{
		$debug = isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'dev';

		$this->app = new Slim([
			'debug' => $debug,
			'templates.path' => dirname($_SERVER['DOCUMENT_ROOT']) . '/views',
			'log.enabled' => true,
			'log.level' => \Slim\Log::DEBUG
		]);

		Route::setDefaultConditions([
			'id' => '[0-9]+',
			'id2' => '[0-9]+',
			'name' => '[a-zA-Z]+',
			'namewithslashes' => '[a-zA-Z-]+',
		]);
	}

	private function loadLogging(): void
	{
		$this->app->container->singleton('log', function () {
			$log = new Logger('logger');
			$log->pushHandler(new StreamHandler(dirname($_SERVER['DOCUMENT_ROOT']) . '/data/logs' . date('Y-m-d') . '.log', Level::Debug));
			return $log;
		});
	}

	private function loadErrorPages(): void
	{
		$this->app->notFound(function () {
			$obj = new NotFoundController();
			$obj->index();
		});

		$app = $this->app;

		$this->app->error(function (\Throwable $e) use ($app) {
			$app->getLog()->error($e->getMessage(), ['exception' => $e]);
			$obj = new ErrorController();
			$obj->index();
		});
	}

	private function loadCommon(): void
	{
		$common = new Common();
		$common->init();
	}

	private function loadRouting(): void
	{
		$app = $this->app;

		require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/routes/frontend.php';
		require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/routes/cms.php';
		require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/routes/scheduled.php';
		require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/routes/account.php';
	}

	private function loadHooks(): void
	{
		$app = $this->app;

		$app->hook('slim.before.dispatch', function () use ($app) {
			$app->view()->setData(['app' => $app]);
		});

		$app->hook('slim.after.dispatch', function () use ($app) {
			if (isset($_SESSION["post"]["_uri"]) && $_SESSION["post"]["_uri"] != $_SERVER["REQUEST_URI"]) {
				unset($_SESSION["post"]);
			}
		});
	}
}
