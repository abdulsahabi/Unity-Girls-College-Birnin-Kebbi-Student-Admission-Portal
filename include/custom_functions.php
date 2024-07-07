<?php
function postDateFormat($postDate)
{
  $currentTime = time();
  $postedTime = strtotime($postDate);
  $timeDifference = $currentTime - $postedTime;

  if ($timeDifference < 60) {
    return "Just now";
  } elseif ($timeDifference < 3600) {
    $minutes = floor($timeDifference / 60);
    return formatTimeUnit($minutes, "minute");
  } elseif ($timeDifference < 86400) {
    $hours = floor($timeDifference / 3600);
    return formatTimeUnit($hours, "hour");
  } elseif ($timeDifference < 2592000) {
    $days = floor($timeDifference / 86400);
    return formatTimeUnit($days, "day");
  } elseif ($timeDifference < 31536000) {
    $months = floor($timeDifference / 2592000);
    $remainingDays = floor(($timeDifference % 2592000) / 86400);
    if ($remainingDays > 0) {
      return "$months months ago";
    } else {
      return formatTimeUnit($months, "month");
    }
  } else {
    $years = floor($timeDifference / 31536000);
    return formatTimeUnit($years, "year");
  }
}

function formatTimeUnit($value, $unit)
{
  return $value == 1 ? "1 {$unit} ago" : "$value {$unit}s ago";
}
