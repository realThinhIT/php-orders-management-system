<?php
class CommonModel {
  public static function deleteResource($resourceName = '', $whereField = '', $whereValue = '') {
    global $g;

    $stmt = $g->db->prepare("
      DELETE FROM `{$resourceName}` WHERE {$whereField} = ?
    ");
    $stmt->bind_param(
      "s",
      $rsValue
    );
    $rsValue = $whereValue;

    return $stmt->execute();
  }

  public static function createResource($resourceName = '', $data = [], $fields = []) {
    global $g;

    $fieldsText = '';
    $valuesText = '';
    foreach ($data as $key => $value) {
      if (in_array($key, $fields)) {
        $fieldsText = $fieldsText . '' . $key . ', ';
        $valuesText = $valuesText . "'" . $value . "', ";
      }
    }
    $fieldsText = substr($fieldsText, 0, -2);
    $valuesText = substr($valuesText, 0, -2);

    $sql = "
      INSERT INTO `{$resourceName}` ({$fieldsText})
      VALUES ({$valuesText})
    ";
    $stmt = $g->db->prepare($sql);

    $stmt->execute();
    return $stmt->insert_id;
  }

  public static function modifyResource($resourceName = '', $whereId = '', $data = [], $fields = []) {
    global $g;

    $setText = '';
    foreach ($data as $key => $value) {
      if (in_array($key, $fields)) {
        $setText .= "`{$key}` = '{$value}', ";
      }
    }
    $setText = substr($setText, 0, -2);

    $sql = "
      UPDATE `{$resourceName}` SET {$setText}
      WHERE `id` = '{$whereId}'
    ";
    $stmt = $g->db->prepare($sql);

    return $stmt->execute();
  }

  public static function stmtToArray($result) {
    $re = [];

    foreach ($result as $r) {
      $re[$r['id']] = $r;
    }

    return $re;
  }
}