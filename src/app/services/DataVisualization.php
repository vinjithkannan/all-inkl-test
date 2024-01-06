<?php

namespace App\Services;

class DataVisualization
{
    public function __construct(private readonly DBConnectionInterface $DBConnection)
    {
    }

    public function visualizeData(?array $data)
    {
        $this->render('index', $data);
    }

    public function getGraphData(array $resultSet, string $format): array
    {
        switch ($format){
            case 'thermometer':
                return $this->prepareThermometerData($resultSet);
            break;
            default;
            break;
        }
    }

    public function render(string $templateFile, array $content)
    {
        extract($content);
        ob_start();
        $templateFileAbsolutePath = sprintf(__DIR__ . '\/../template/%s.php', $templateFile);
        include_once $templateFileAbsolutePath;
        $renderData = ob_get_contents();
        ob_end_clean();

        echo $renderData;
    }

    private function prepareThermometerData(array $resultSet): array
    {
        $headRows = array_unique(array_column($resultSet, 'Meter'));
        $days =  array_map('strval', array_unique(array_column($resultSet, 'Day')));
        $graphHeads = array_fill_keys($headRows, []);

        foreach ($resultSet as $resultValue) {
           array_push($graphHeads[$resultValue['Meter']], (float) $resultValue['Reading']);
        }

        $graphData = [];
        foreach ($days as $day) {
            $dataItem = [];
            foreach ($graphHeads as $graphHead) {
                $dataItem[] = $graphHead[(int) $day - 1];
            }
            array_unshift($dataItem, $day);
            $graphData[] = $dataItem;
        }
        array_unshift($headRows, 'Day');
        array_unshift($graphData, $headRows);

        return $graphData;
    }
}