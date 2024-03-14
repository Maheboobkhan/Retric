<?php

function generateGanttChart($taskNames, $startDates, $endDates, $dependencies) {
    // Calculate chart dimensions
    $chartWidth = 800;
    $chartHeight = 400;
    $barHeight = 20;
    $barSpacing = 30;

    // Initialize SVG
    $svg = '<svg width="' . $chartWidth . '" height="' . $chartHeight . '">';

    // Loop through tasks
    for ($i = 0; $i < count($taskNames); $i++) {
        // Calculate task position and dimensions
        $y = $i * ($barHeight + $barSpacing);
        $startDate = strtotime($startDates[$i]);
        $endDate = strtotime($endDates[$i]);
        $duration = $endDate - $startDate;
        $x = ($startDate - strtotime(min($startDates))) / (strtotime(max($endDates)) - strtotime(min($startDates))) * $chartWidth;
        $width = $duration / (strtotime(max($endDates)) - strtotime(min($startDates))) * $chartWidth;

        // Draw task bar
        $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $width . '" height="' . $barHeight . '" fill="#007bff"></rect>';
        
        // Draw task name
        $svg .= '<text x="' . ($x + 5) . '" y="' . ($y + $barHeight / 2 + 5) . '" font-size="12" fill="#fff">' . $taskNames[$i] . '</text>';

        // Draw dependency arrow if exists
        if (!empty($dependencies[$i])) {
            $dependencyIndex = array_search($dependencies[$i], $taskNames);
            if ($dependencyIndex !== false) {
                $dependencyX = ($startDate - strtotime(min($startDates))) / (strtotime(max($endDates)) - strtotime(min($startDates))) * $chartWidth;
                $dependencyY = $dependencyIndex * ($barHeight + $barSpacing) + $barHeight / 2;
                $dependencyWidth = $x - $dependencyX;
                $svg .= '<line x1="' . $dependencyX . '" y1="' . $dependencyY . '" x2="' . $x . '" y2="' . ($y + $barHeight / 2) . '" stroke="#fff" stroke-width="2"></line>';
            }
        }
    }

    // Close SVG
    $svg .= '</svg>';

    // Output SVG
    echo $svg;
}

?>
