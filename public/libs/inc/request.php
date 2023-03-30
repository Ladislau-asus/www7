<?php

function get_all_table($db, $table_name, $get = "", $limit = "")
{
    $query = "SELECT * FROM $table_name";

    if ($get == "inactive") {
        $query .= " WHERE deleted_at IS NOT NULL";
    } elseif ($get == "active") {
        $query .= " WHERE deleted_at IS NULL";
    } elseif ($get == "all") {

    } elseif ($limit != "") {
        $query .= " LIMIT $limit";
    }

    $results = $db->EXE_QUERY($query);
    return $results;
}
// -----------------------------------------------
// PESQUISAR UM VALOR NUMA TABELA
// -----------------------------------------------
function get_search_table($db, $table_name, $column, $search)
{
    $query = "SELECT * FROM " . $table_name . " WHERE " . $column . " LIKE '%" . $search . "%'";

    $results = $db->EXE_QUERY($query);
    return $results;
}

function get_soft_table($db, $table_name, $type_soft, $column, $id) {
    if ($type_soft == 'delete') {
        $db->EXE_NON_QUERY("UPDATE " . $table_name . " SET deleted_at = NOW() WHERE " . $column . " = " . $id . "");
    } elseif ($type_soft == 'restore') {
        $db->EXE_NON_QUERY("UPDATE " . $table_name . " SET deleted_at = NULL WHERE " . $column . " = " . $id . "",);
    } else {
        return false;
    }

    return true;
}
?>