<?php

use Config\Config;

?>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/home/index.css?v=<?= Config::get('version') ?>"/>
</head>
<body>
<div class="container-center-horizontal">
    <div class="landing-page screen">
        <div class="flex-col">
            <div class="header">
                <div class="konnect poppins-bold-royal-blue-36px">KONNECT</div>
                <a href="#rectangle-3">
                    <div class="frame-2">
                        <a onclick="window.event.stopPropagation()"
                        >
                            <div class="our-research-groups poppins-normal-black-20px">Our research groups</div>
                        </a
                        >
                        <div class="our-partners poppins-normal-black-20px">Our partners</div>
                    </div>
                </a
                >
                <button class="call-to-action-button" onclick="window.location.href='/auth/login'">
                    <div class="go-to-portal poppins-bold-white-20px">Go to Portal</div>
                    <img
                            class="akar-icons-arrow-right-thick"
                            src="<?= ROOT ?>app/images/akar-icons-arrow-right-thick.svg"
                    />
                </button>
            </div>
            <div class="flex-row">
                <h1 class="text-1">Collaborate with this generation’s most talented brains</h1>
                <img
                        class="ucsc-logo"
                        src="<?= ROOT ?>app/images/ucsc-logo.png"
                />
            </div>
            <div class="overlap-group">
                <div class="overlap-group3">
                    <div class="about-us poppins-bold-royal-blue-30px">ABOUT US</div>
                    <img
                            class="line-1"
                            src="<?= ROOT ?>app/images/line-1.svg"
                    />
                </div>
                <div class="text-2 poppins-bold-black-18px">
                    Bro ipsum dolor sit amet ski steed gondy first tracks noodle. Pow stomp bowl heli skinny. Line huck
                    rip heli
                    dirtbag Snowboard air rail epic face plant ollie taco. Whip death cookies bomb hole dope shuttle
                    brain bucket
                    gapers method misty hardtail big ring dust on crust. Huck death cookies heli jib white room air.
                </div>
            </div>
            <div class="overlap-group1">
                <div class="our-research-groups-1 poppins-bold-royal-blue-30px">OUR RESEARCH GROUPS</div>
                <img
                        class="line-2"
                        src="<?= ROOT ?>app/images/line-2.svg"
                />
            </div>
            <div class="frame-9">
                <div class="frame-5">
                    <img
                            class="scorelabs-1"
                            src="<?= ROOT ?>app/images/scorelabs-1.png"
                    />
                    <img
                            class="vector-1"
                            src="<?= ROOT ?>app/images/vector-1.svg"
                    />
                    <div class="score poppins-normal-black-24px">Score</div>
                </div>
                <div class="frame">
                    <img
                            class="scorelabs-1"
                            src="<?= ROOT ?>app/images/scorelabs-1.png"
                    />
                    <img
                            class="vector-1"
                            src="<?= ROOT ?>app/images/vector-1.svg"
                    />
                    <div class="score poppins-normal-black-24px">Score</div>
                </div>
                <div class="frame">
                    <img
                            class="scorelabs-1"
                            src="<?= ROOT ?>app/images/scorelabs-1.png"
                    />
                    <img
                            class="vector-1"
                            src="<?= ROOT ?>app/images/vector-1.svg"
                    />
                    <div class="score poppins-normal-black-24px">Score</div>
                </div>
                <div class="frame">
                    <img
                            class="scorelabs-1"
                            src="<?= ROOT ?>app/images/scorelabs-1.png"
                    />
                    <img
                            class="vector-1"
                            src="<?= ROOT ?>app/images/vector-1.svg"
                    />
                    <div class="score poppins-normal-black-24px">Score</div>
                </div>
            </div>
            <div class="overlap-group2">
                <div class="our-partners-1 poppins-bold-royal-blue-30px">OUR PARTNERS</div>
                <img
                        class="line-3"
                        src="<?= ROOT ?>app/images/line-3.svg"
                />
                <div class="logos">
                    <img
                            class="image-1"
                            src="<?= ROOT ?>app/images/image-1.png"
                    />
                    <img
                            class="image-2"
                            src="<?= ROOT ?>app/images/image-2.png"
                    />
                    <img
                            class="image-3"
                            src="<?= ROOT ?>app/images/image-3.png"
                    />
                    <img
                            class="image-4"
                            src="<?= ROOT ?>app/images/image-4.png"
                    />
                </div>
            </div>
            <div class="footer">
                <img
                        class="ucsc-logo-1"
                        src="<?= ROOT ?>app/images/ucsc-logo.png"
                />
                <div class="all-rights-reserved poppins-bold-white-24px">All Rights Reserved</div>
            </div>
        </div>
    </div>
</div>
</body>