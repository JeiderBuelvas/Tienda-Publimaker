<?php

class Connection
{
    protected $db_host;
    protected $db_port;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $db_charset;
    protected $db_collation;

    protected $connection;

    public function __construct()
    {
        $config = include __DIR__ . '/../config/database.php';
        $config = $config['mysql'];

        $this->db_host = $config['host'];
        $this->db_port = $config['port'];
        $this->db_user = $config['username'];
        $this->db_pass = $config['password'];
        $this->db_name = $config['database'];
        $this->db_charset = $config['charset'];
        $this->db_collation = $config['collation'];

        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli(
            $this->db_host,
            $this->db_user,
            $this->db_pass,
            $this->db_name,
            $this->db_port
        );

        if ($this->connection->connect_error) {
            die('Error de conexión: ' . $this->connection->connect_error);
        }

        $this->connection->set_charset($this->db_charset);
        $this->connection->query("SET collation_connection = '{$this->db_collation}'");
    }
}
