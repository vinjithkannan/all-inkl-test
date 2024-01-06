<?php
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use App\Services\DataVisualization;
use App\Services\DBConnection;

$dbConnection = new DBConnection();
$dataVisualization = new DataVisualization($dbConnection);
$dbAdapters = $dbConnection->getDbAdapters();
$contents = [
    'dbAdapters' => $dbAdapters ?? [],
    'formData' => [],
    'graphData' => []
];
if (isset($_POST['search'])) {
    $formData = $_POST;
    $dbConnection->setConnectionData($formData);
    $dbConnection->getConnection();
    if (isset($formData['db_query'])) {
        $resultSet = $dbConnection->getRows($formData['db_query']);
        $graphData = $dataVisualization->getGraphData($resultSet, 'thermometer');
    }
    $contents['formData'] = $formData;
    $contents['graphData'] = $graphData ?? [];
}

$dataVisualization->visualizeData($contents);
