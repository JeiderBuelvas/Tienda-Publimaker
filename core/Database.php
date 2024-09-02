<?php
class Database extends Connection
{
    protected $connection;
    protected $sql;
    protected $datos;

    public function __construct()
    {
        parent::__construct();
    }

    public function select(string $sql, array $datos = null)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            if ($this->datos) {
                $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);
            }

            $resul->execute();

            $resultados = $resul->get_result();
            $data = $resultados->fetch_assoc();

            $resul->close();

            return $data;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta SELECT: " . $e->getMessage());
        }
    }

    public function selectAll(string $sql, array $datos = null)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            if ($this->datos) {
                $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);
            }

            $resul->execute();

            $resultados = $resul->get_result();
            $data = [];

            while ($fila = $resultados->fetch_assoc()) {
                $data[] = $fila;
            }

            $resul->close();

            return $data;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta SELECT ALL: " . $e->getMessage());
        }
    }

    public function insert(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);

            $data = $resul->execute();

            $resul->close();

            return $data ? 1 : 0;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta INSERT: " . $e->getMessage());
        }
    }

    public function update(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);

            $data = $resul->execute();

            $resul->close();

            return $data ? 1 : 0;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta UPDATE: " . $e->getMessage());
        }
    }

    public function delete(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);

            $data = $resul->execute();

            $resul->close();

            return $data ? 1 : 0;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta DELETE: " . $e->getMessage());
        }
    }

    public function insert_id(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;

            $resul = $this->connection->prepare($this->sql);
            $resul->bind_param(str_repeat('s', count($this->datos)), ...$this->datos);

            $resul->execute();

            if ($resul->affected_rows > 0) {
                $inserted_id = $this->connection->insert_id;
            } else {
                $inserted_id = 0;
            }

            $resul->close();

            return $inserted_id;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta INSERT: " . $e->getMessage());
        }
    }
}
