<?php

namespace App\Controllers;

use App\Api;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    private FilesystemLoader $loader;
    private Environment $twig;
    private Api $apiClient;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views');
        $this->twig = new Environment($this->loader);
        $this->apiClient = new Api($_ENV['API_KEY']);
    }

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }

    public function api(): Api
    {
        return $this->apiClient;
    }
}