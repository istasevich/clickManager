<?php

/* @var $this yii\web\View */

$this->title = 'Clicks list';


?>
<div class="site-index">


    <div class="content">

        <div id="clicks">

            <input class="search" placeholder="Search" />
            <button class="sort" data-sort="id">
                Sort by id
            </button>
            <table class="table">
                <tr>
                    <th>click Id</th><th>User-Agent</th><th>IP</th><th>Referral</th><th>param1</th><th>param2</th>
                </tr>
                <tbody class="list"></tbody>
            </table>

        </div>

    </div>


</div>