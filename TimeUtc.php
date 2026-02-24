<?php
// Create one base UTC time
$utc = new DateTime("now", new DateTimeZone("UTC"));

// Clone it and convert to Berlin timezone
$berlin = clone $utc;
$berlin->setTimezone(new DateTimeZone("Europe/Berlin"));

// Print times
echo "<h3>Current Date and Time</h3>";
echo "UTC Time: " . $utc->format("Y-m-d H:i:s") . "<br>";
echo "Berlin Time: " . $berlin->format("Y-m-d H:i:s") . "<br><br>";

// Calculate timezone offset difference in seconds
$utcOffset = $utc->getOffset();
$berlinOffset = $berlin->getOffset();

$offsetDiffSeconds = $berlinOffset - $utcOffset;
$offsetDiffHours = $offsetDiffSeconds / 3600;

echo "<h3>Timezone Difference</h3>";
echo "Difference in hours: " . $offsetDiffHours;
?>