<?php
// Create base time in India timezone
$india = new DateTime("now", new DateTimeZone("Asia/Kolkata"));

// Clone it and convert to Germany timezone
$germany = clone $india;
$germany->setTimezone(new DateTimeZone("Europe/Berlin"));

// Print times
echo "<h3>Current Date and Time</h3>";
echo "India Time: " . $india->format("Y-m-d H:i:s") . "<br>";
echo "Germany Time: " . $germany->format("Y-m-d H:i:s") . "<br><br>";

// Calculate timezone offset difference in seconds
$indiaOffset = $india->getOffset();
$germanyOffset = $germany->getOffset();

$offsetDiffSeconds = $germanyOffset - $indiaOffset;
$offsetDiffHours = $offsetDiffSeconds / 3600;

echo "<h3>Timezone Difference</h3>";
echo "Difference in hours: " . $offsetDiffHours;
?>