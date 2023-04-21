<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 19.12.2017
 * Time: 15:48
 */

namespace App\Services;

/**
 * Class FTPSendService
 * @package App\Services
 */
class FTPSendService
{
    /**
     * @var resource $_connection
     */
    protected $_connection;
    /**
     * @var string $__host
     */
    private $__host;
    /**
     * @var string $__user
     */
    private $__user;
    /**
     * @var string $__pass
     */
    private $__pass;
    /**
     * @var int $__port
     */
    private $__port;

    /**
     * FTPSendService constructor.
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param int $port ,
     * @throws \Exception
     */
    public function __construct($host = null, $user = null, $pass = null, $port = 21)
    {
        $this->setPort($port);
        if (null !== $host && null !== $user && null !== $pass) {
            $this->setHost($host);
            $this->setUser($user);
            $this->setPass($pass);
            $this->connect();
        }
    }

    /**
     * @param bool $passiveMode
     * @return void
     * @throws \Exception
     */
    public function connect($passiveMode = true)
    {
        $this->_connection = ftp_connect($this->getHost(), $this->getPort(), 90);
        if (FALSE === $this->_connection) {
            throw new \Exception('Invalid FTP host');
        }

        $auth = ftp_login($this->getConnection(), $this->getUser(), $this->getPass());

        if (!$auth) {
            throw new \Exception('Invalid credentials for FTP ' . $this->getHost());
        }

        ftp_pasv($this->_connection, $passiveMode);
    }

    /**
     * @return resource
     * @throws \Exception
     */
    public function getConnection()
    {
        if (!$this->_connection) {
            $this->connect();
        }
        return $this->_connection;
    }

    /**
     * @param $remoteFile
     * @param $localFile
     * @param int $mode
     * @return bool
     * @throws \Exception
     */
    public function upload($remoteFile, $localFile, $mode = FTP_BINARY)
    {
        $sent = ftp_put($this->getConnection(), $remoteFile, $localFile, $mode);
        return $sent;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->__host;
    }

    /**
     * @param string $_host
     */
    public function setHost($_host)
    {
        $this->__host = $_host;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->__user;
    }

    /**
     * @param string $_user
     */
    public function setUser($_user)
    {
        $this->__user = $_user;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->__pass;
    }

    /**
     * @param string $_pass
     */
    public function setPass($_pass)
    {
        $this->__pass = $_pass;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->__port;
    }

    /**
     * @param int $_port
     */
    public function setPort($_port)
    {
        $this->__port = $_port;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function disconnect()
    {
        return ftp_close($this->getConnection());
    }

    /**
     * @throws \Exception
     */
    public function __destruct()
    {
        $this->disconnect();
    }
}