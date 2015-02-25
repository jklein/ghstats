<?php

require 'vendor/autoload.php';

if (empty($argv[1])) {
    die('Please provide the organization name as the first argument on the command line' . PHP_EOL);
}
$org = $argv[1];

$client = new GuzzleHttp\Client();
$response = $client->get('https://api.github.com/orgs/' . $org . '/repos?type=sources&per_page=100');


$repos = [];
foreach ($response->json() as $repo) {
    $repos[$repo['name']] = intval($repo['stargazers_count']);
}

arsort($repos);
echo "Stars: " . PHP_EOL;
$i = 1;
foreach ($repos as $name => $stars) {
    echo "\t$i. " . $name . ': ' . $stars . PHP_EOL;
    $i++;
}