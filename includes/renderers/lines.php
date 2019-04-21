<?php

function line($direction, $id, $color = 'primary') {
    switch ($direction) {
        case 'h':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line horizontal <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 296 1.25"
                    preserveAspectRatio="none"
                >
                    <line
                        class="line_stroke"
                        y1="0.63"
                        x2="296"
                        y2="0.63"
                    />
                </svg>
            <?php
            break;

        case 'v':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line vertical <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1.25 296"
                    preserveAspectRatio="none"
                >
                    <line
                        class="line_stroke"
                        x1="0.63"
                        x2="0.63"
                        y2="296"
                    />
                </svg>
            <?php
            break;
    }
}

function bend($direction, $id, $color = 'primary') {
    switch ($direction) {
        case 'l-d':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line bend left_down <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 27.84 27.89"
                >
                    <path
                        class="line_stroke"
                        d="M27.2,27.9V16.2c0-8.6-7-15.5-15.5-15.5H0"
                    />
                </svg>
            <?php
            break;

        case 'l-u':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line bend left_up <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 27.84 27.89"
                >
                    <path
                        class="line_stroke"
                        d="M27.21,0V11.72A15.58,15.58,0,0,1,11.67,27.26H0"
                    />
                </svg>
            <?php
            break;

        case 'r-d':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line bend right_down <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 27.84 27.89"
                >
                    <path
                        class="line_stroke"
                        d="M1.29,28.26V16.54A15.58,15.58,0,0,1,16.83,1H28.5"
                        transform="translate(-0.66 -0.37)"
                    />
                </svg>
            <?php
            break;

        case 'r-u':
            ?>
                <svg
                    id="<?= $id ?>"
                    class="line bend right_up <?= $color ?>"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 27.84 27.89"
                >
                    <path
                        class="line_stroke"
                        d="M1.29,0V11.72A15.58,15.58,0,0,0,16.83,27.26H28.5"
                        transform="translate(-0.66 0)"
                    />
                </svg>
            <?php
            break;
    }
}

function render_hero_lines() {
        line('v', 'hero_1', 'white');
        line('h', 'hero_7', 'white');

        line('h', 'hero_2', 'white');
        bend('l-u', 'hero_3', 'white');
        line('v', 'hero_4', 'white');
        line('v', 'hero_5');

        line('h', 'hero_6', 'white');
    ?><script>window.hasHeroLines = true;</script><?php
}
