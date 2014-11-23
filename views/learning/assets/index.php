<?php

use app\MyAssets\Learn\AssetsTutorial\AssetTutorial;

use app\MyAssets\MyAsset;
use app\assets\AppAsset;
AppAsset::register($this);

app\MyAssets\MyAsset::register($this);
AssetTutorial::register($this)
?>

<p>
    This is Assets tutorial.
</p>
