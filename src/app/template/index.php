<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALL INKL PHP TEST</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {font-family: "Lato", sans-serif}
    </style>
</head>
<body>
<!-- Page content -->
<div class="w3-content" style="max-width: 2000px; margin-top: 46px">

    <!-- The Contact Section -->
    <div class="w3-container w3-content" id="contact">
        <div class="w3-row w3-padding-32">
            <div class="w3-col 12">
                <form method="post">
                    <fieldset>
                        <legend>Database Settings</legend>
                        <div class="w3-row-padding w3-padding" >
                            <div class="w3-third">
                                <select class="w3-input w3-border" name="db_driver">
                                    <option value="" > Select a driver</option>
                                    <?php
                                        foreach ($dbAdapters as $dbAdapterKey => $dbAdapterValue) {
                                            $selected = isset($formData['db_driver']) &&
                                                $formData['db_driver'] === $dbAdapterKey ? 'selected' : "";
                                            echo '<option ' . $selected . ' value="' .$dbAdapterKey. '">' . $dbAdapterValue. ' </option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="w3-third">
                                <input
                                        class="w3-input w3-border"
                                        type="text"
                                        placeholder="Database Host"
                                        required
                                        name="db_host"
                                        value="<?php echo $formData['db_host'] ?? '' ?>"
                                >
                            </div>
                            <div class="w3-third">
                                <input
                                        class="w3-input w3-border"
                                        type="text"
                                        placeholder="Database Port"
                                        required
                                        name="db_port"
                                        value="<?php echo $formData['db_port'] ?? '' ?>"
                                >
                            </div>
                        </div>
                        <div class="w3-row-padding w3-padding" >
                            <div class="w3-third">
                                <input
                                        class="w3-input w3-border"
                                        type="text"
                                        placeholder="Database Name"
                                        required
                                        name="db_name"
                                        value="<?php echo $formData['db_name'] ?? '' ?>"
                                >
                            </div>
                            <div class="w3-third">
                                <input
                                        class="w3-input w3-border"
                                        type="text"
                                        placeholder="Database User"
                                        required
                                        name="db_user"
                                        value="<?php echo $formData['db_user'] ?? '' ?>"
                                >
                            </div>
                            <div class="w3-third">
                                <input
                                        class="w3-input w3-border"
                                        type="password"
                                        placeholder="Database Password"
                                        required
                                        name="db_password"
                                        value="<?php echo $formData['db_password'] ?? '' ?>"
                                >
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Database Query</legend>
                        <textarea
                                class="w3-input w3-border"
                                rows="10"
                                placeholder="Query"
                                required
                                name="db_query"
                        ><?php echo $formData['db_query'] ?? '' ?></textarea>
                        <button
                                class="w3-button w3-black w3-section w3-left"
                                name="search"
                                type="submit"
                        >
                            Search
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

    <!-- The Chart Section -->
    <div class="w3-container w3-content w3-padding-32" >
        <div class="w3-row">
            <div class="w3-col m12">
                <fieldset>
                    <legend>Visualization</legend>
                    <div id="curve_chart" style="width: 90%; height: 70%"></div>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- End Chart Section -->
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">

</footer>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(
            <?php echo json_encode($graphData); ?>
        );

        var options = {
            title: 'Readings',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>

</body>
</html>
