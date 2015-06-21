<?php
namespace App\Http\Controllers;

use App\Http\Requests;
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
     * Check if the request has a required filters
     *
     * @param  Request  $request
     * @return boolean
     */
    public function hasRequiredFilter(Request $request, $filters = [])
    {
        foreach ($filters as $filter) {
            if ($request->has($filter)) {
                return true;
            }
        }

        return false;
    }

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
     * Respond with 'Service unavailable' error
     *
     * @param  string $message
     * @return mixed
     */
    public function respondUnavailable($message = 'Service unavailable')
    {
        return $this->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE)->respondWithError($message);
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
