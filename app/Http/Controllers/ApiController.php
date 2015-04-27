<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * Define default status code
     *
     * @var integer
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * Get status code
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status code
     *
     * @param  integer $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond with 'Unauthorised' error
     *
     * @param  string $message
     * @return mixed
     */
    public function respondUnauthorised($message = 'Unauthorised')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * Respond with 'Not found' error
     *
     * @param  string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not found')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Respond with 'Rate limit' error
     *
     * @param  string $message
     * @return mixed
     */
    public function respondTooManyRequests($message = 'Rate limit exceeded')
    {
        return $this->setStatusCode(Response::HTTP_TOO_MANY_REQUESTS)->respondWithError($message);
    }

    /**
     * Respond with 'Internal error' error
     *
     * @param  string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal error')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * Send an error response
     *
     * @param  string $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message'    => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Send a generic response with optional headers
     *
     * @param  string $message
     * @param  array  $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        header_remove('X-Powered-By');

        return response()->json($data, $this->getStatusCode(), $headers);
    }
}
