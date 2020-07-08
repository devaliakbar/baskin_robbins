<?php
class MySqlEscape
{

    private $body;

    private $conn;

    private $failMsg = array("success" => false, "status" => "FIELD");

    public function __construct($body, $conn)
    {
        $this->body = $body;
        $this->conn = $conn;
    }

    public function getValue($key)
    {
        if (!isset($this->body[$key])) {
            echo json_encode($this->failMsg);
            die();
        }

        return mysqli_real_escape_string($this->conn, $this->body[$key]);
    }
}
