<?php

class StatusRepository extends DbRepository
{
  public function insert($user_id, $body)
  {
    $now = new DateTime();
    $sql = "INSERT INTO test_status(user_id, body, created_at) VALUES(:user_id, :body, :created_at)";
    $stmt = $this->execute($sql, [
      ':user_id' => $user_id,
      ':body' => $body,
      ':created_at' => $now->format('Y-m-d H:i:s'),
    ]);
  }

  public function fetchAllPersonalArchivesByUserId($user_id)
  {
    $sql = "
      SELECT s.*, u.user_name FROM test_status s
      LEFT JOIN test_user u ON s.user_id = u.id
      LEFT JOIN test_following f ON s.user_id = f.following_id
      WHERE u.id = :user_id OR f.user_id = :user_id
      ORDER BY s.created_at DESC
    ";
    return $this->fetchAll($sql, [':user_id' => $user_id]);
  }

  public function fetchAllByUserId($user_id)
  {
    $sql = "
    SELECT s.*, u.user_name FROM test_status s
    LEFT JOIN test_user u ON u.id = s.user_id
    WHERE s.user_id = :user_id
    ORDER BY s.created_at DESC
    ";
    return $this->fetchAll($sql, [':user_id' => $user_id]);
  }

  public function fetchByIdAndUserName($id, $user_name)
  {
    $sql = "
    SELECT s.*, u.user_name FROM test_status s
    LEFT JOIN test_user u ON u.id = s.user_id
    WHERE s.id = :id AND u.user_name = :user_name
    ";
    return $this->fetch($sql, [':id' => $id, ':user_name' => $user_name]);
  }
}