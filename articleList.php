<?php

//连接数据库

require_once('connect.php');
$page = isset($_GET['page']) ? $_GET['page'] : 1;//定义变量由浏览器传入
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$school_name = isset($_GET['school_name']) ? $_GET['school_name'] : "";
$major_name = isset($_GET['major_name']) ? $_GET['major_name'] : "";
$ke_lei = isset($_GET['ke_lei']) ? $_GET['ke_lei'] : "";
$ceng_ci = isset($_GET['ceng_ci']) ? $_GET['ceng_ci'] : "";

$condition = buildConditionSql($school_name, $major_name, $ke_lei, $ceng_ci);

$getInfoSql = "SELECT * FROM  major_info {$condition} limit " . ($page - 1) * 5 . "," . $limit;
$getCountSql = "SELECT count(*) as count FROM  major_info {$condition}";

$result = $con->query($getInfoSql);


$totalCount = $con->query($getCountSql);
$obj = mysqli_fetch_object($totalCount);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $json = json_encode(array(
        "code" => 0,
        "msg" => "查询成功！",
        "count" => $obj->count,
        "data" => $data
    ), JSON_UNESCAPED_UNICODE);
    //转换成字符串JSON
    echo($json);
} else {
    $json = json_encode(array(
        "code" => 0,
        "msg" => "暂无数据",
        "data" => [],
        "count" => 0,

    ), JSON_UNESCAPED_UNICODE);
    //转换成字符串JSON

    echo($json);
}

function buildConditionSql($school_name, $major_name, $ke_lei, $ceng_ci){
    $conditionSql = "where 1 = 1 ";
    if ($school_name != "") {
        $conditionSql = $conditionSql ."and school_name like " . "'%".$school_name."%'";
    }

    if ($major_name != "") {
        $conditionSql = $conditionSql . "and major_name like " . "'%".$major_name."%'";
    }

    if ($ke_lei != "") {
        $conditionSql = $conditionSql . "and ke_lei =" . "'".$ke_lei."'";
    }

    if ($ceng_ci != "") {
        $conditionSql = $conditionSql . "and ceng_ci =" . "'".$ceng_ci."'";
    }

    return $conditionSql;
}

?>




