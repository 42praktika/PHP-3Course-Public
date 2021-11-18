<?php
spl_autoload_register(function ($className) {require_once './app/classes/'.$className.'.inc';});
