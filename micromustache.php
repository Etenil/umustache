<?php

/**
 * Renders a mustache template.
 */
function umustache_render($content, array $vars) {
    foreach($vars as $name => $value) {
        if(is_array($value)) { // Looping on array.
            // Seeking the matching tag.
            $start = strpos($content, '{{'.$name.'}}');
            if($start === false) {
                continue;
            }
            $stop = strpos($content, '{{/'.$name.'}}');
            if($stop === false) {
                str_replace('{{'.$name.'}}', '', $content);
                continue;
            }

            $inner_start = $start + strlen($name) + 4;
            $inner_stop = $stop;
            $stop+= strlen($name) + 5;

            if($content[$inner_start] == "\n") {
                $inner_start++;
            }
            if(strlen($content) > $stop && $content[$stop] == "\n") {
                $stop++;
            }

            // Cutting a slice of text.
            $beginning = substr($content, 0, $start);
            $within = substr($content, $inner_start, $inner_stop - $inner_start);
            $end = substr($content, $stop);

            if(count($value) > 0) {
                if(is_array($value[0])) {
                $collector = '';
                foreach($value as $subvalue) {
                    $collector.= umustache_render($within, $subvalue);
                }
                $content = $beginning . $collector . $end;
                } else {
                    $content = $beginning . umustache_render($within, $value) . $end;
                }
            } else {
                $content = $beginning . $end;
            }
        }
        elseif($value) {
            $content = str_replace('{{'.$name.'}}', $value, $content);
        }
    }

    // Cleaning up.
    $content = preg_replace('/\{\{.+?\}\}/', '', $content);

    return $content;
}


