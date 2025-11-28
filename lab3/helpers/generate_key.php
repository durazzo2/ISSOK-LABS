<?php

function generate_key($length = 32) {
    return bin2hex(random_bytes($length));
}
