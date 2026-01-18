<?php
namespace App\Models;

use PDO;
use App\Core\Database;
use App\Database\Db;

class User {
    private ?int $id = null;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $role = 'user';
    private ?string $created_at = null;
    private PDO $db;

    public function __construct() {
        $this->db = Db::connect();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setFirstname(string $firstname): void {
        $this->firstname = trim($firstname);
    }

    public function setLastname(string $lastname): void {
        $this->lastname = trim($lastname);
    }

    public function setEmail(string $email): void {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email format");
        }
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function save(): bool {
        $sql = "INSERT INTO users (firstname, lastname, email, password, role) 
                VALUES (:firstname, :lastname, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':firstname' => $this->firstname,
            ':lastname'  => $this->lastname,
            ':email'     => $this->email,
            ':password'  => $this->password,
            ':role'      => $this->role
        ]);
    }

    public function findByEmail(string $email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $user = $stmt->fetch();

        return $user ?: null;
    }
}