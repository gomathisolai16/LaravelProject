<?php

namespace App\Services;
use App\Models\Log;

/**
 * Class ResponseService
 */
class ResponseService
{
    /**
     * @var array $_successStatuses
     */
    protected $_successStatuses = [200, 201];

    /**
     * @var array $_availableFormats
     */
    protected $_availableFormats = ['json', 'xml'];

    /**
     * @var string $_format
     */
    protected $_format = 'json';

    /**
     * @var int $_status
     */
    protected $_status = 200;

    /**
     * @param int $status
     * @return $this
     */
    public function withStatus($status)
    {
        $this->_status = $status;
        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function format($format)
    {
        $this->__checkFormat($format);
        $this->_format = $format;
        return $this;
    }

    /**
     * @param int $total
     * @param int $count
     * @param array $data
     * @param string $key
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function multiple($total, $count, $data, $key = '', $message = null)
    {
        global $time;
        if (empty($key)) {
            $key = "items";
        }

        $data = [
            'total' => $total,
            'success' => in_array($this->_status, $this->_successStatuses),
            'count' => $count,
            $key => $data,
        ];

        if (!is_null($message)) {
            $data['message'] = $message;
        }

        $data['execution_time'] = microtime(true) - $time;
        $data['used_memory'] = memory_get_usage(true) / pow(1024, 2) . 'MB';

        return $this->_response($data);
    }

    /**
     * @param array $object
     * @param string $key
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function single($object, $key = '', $message = null)
    {
        global $time;
        if (empty($key)) {
            $key = "item";
        }

        $data = [
            'success' => in_array($this->_status, $this->_successStatuses),
        ];

        $data[$key] = $object;

        if (!is_null($message)) {
            $data['message'] = $message;
        }

        $data['execution_time'] = microtime(true) - $time;
        $data['used_memory'] = memory_get_usage(true) / pow(1024, 2) . 'MB';

        return $this->_response($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function _response($data)
    {
        switch ($this->_format) {
            case "xml":
                return response($data, $this->_status)->header('Content-Type', 'text/xml');
                break;
            case "json":
                return response()->json($data, $this->_status);
                break;
        }
    }

    /**
     *
     * Will check is format available for this
     *
     * @param string $format
     * @throws \Exception
     */
    private function __checkFormat($format)
    {
        if (!in_array($format, $this->_availableFormats)) {
            throw new \Exception();
        }
    }
}