<style>
    #contain {
        margin: 30px;
    }

    h1, h2, h3, h4 {

        text-size: 2em;
    }

    h1 {
        text-align: center;
    }
</style>
<div id="contain">
    <h1 style="text-align:center">Question & Answer</h1>
    <br><br>

    <?php

    foreach ($this->data['QA'] as $q) {
        echo "<h2>" . $q['Question'] . "</h3><hr>";
    }
    ?>
</div>