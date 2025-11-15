<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * Handle API errors gracefully
     */
    protected function handleApiError($service, $error, $defaultMessage = 'Terjadi kesalahan saat mengambil data')
    {
        log_message('error', "API Error in {$service}: " . $error);

        return [
            'success' => false,
            'message' => $defaultMessage,
            'data' => []
        ];
    }

    /**
     * Check if API response is valid
     */
    protected function isValidApiResponse($data)
    {
        return !empty($data) && is_array($data);
    }

    /**
     * Format API response
     */
    protected function formatApiResponse($data, $message = 'Data berhasil diambil')
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
    }
}
