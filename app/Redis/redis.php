<?php

$redis = new Redis();
//Connecting to Redis
$redis->connect('school_project_redis_1', 6379);
//$redis->auth('password');

if ($redis->ping()) {
//    echo "PONGn";
}

//$redis->flushAll('kay', 'India');
//$redis->keys(*)
//print_r(unserialize($redis->get('School_1:Class_7:Section_0')));
echo"<pre>";
$keys = $redis->keys('*');
if (!empty($keys)){
    foreach ($keys as $key) {
        print_r("$key=>". ($redis->get($key))."                         ");
    }
}
$redis->flushAll();

?>