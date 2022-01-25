<?php

use Config\Config;

$this->start("content"); ?>
<head>
<link rel="stylesheet" href="<?= ROOT ?>app/css/researchgroup/view.css?v=<?= Config::get('version'); ?>">
</head>
<body>
    <?php $this->partial('partials/navbar'); ?>
    <div class="Dpagecontainer">
        <div class="Dpagetittle">RESEARCH GROUP NAME</div>
        <div class="Dsection">
            <div class="sectiontittle">DESCRIPTION</div>
            <div class="section1content">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat et earum, doloremque alias quae sequi ipsum impedit magni temporibus neque debitis maiores rem voluptatum dolorem at ad vero dicta repellat. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam ipsum tenetur ducimus adipisci explicabo, in earum expedita, provident inventore soluta fugiat dignissimos sint ex quasi facere sit ad praesentium mollitia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit corrupti consequuntur iusto voluptatibus et numquam dicta vero repellat, incidunt enim quibusdam praesentium distinctio nulla beatae ipsa. Exercitationem nam vel corporis! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias laudantium animi cum maiores praesentium culpa voluptatem ipsam explicabo magni necessitatibus, quaerat suscipit quas beatae ex dolore, nesciunt expedita officia nisi? Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat et cum alias amet doloribus rerum sapiente dolore nisi totam voluptatibus sint nihil officia eveniet tenetur sit tempore, non excepturi animi.
            </div>
        </div>
        <div class="Dsection">
            <div class="sectiontittle">INTERSTS</div>
            <div class="section2content">
                <div class="interest">Artificial Intelligence</div>
            </div>
        </div>
        <div class="Dsection">
            <div class="sectiontittle">MEMBERS</div>
            <div class="section3subtittle">RESEARCH GROUP HEAD</div>
            <div class="sectiongrid">
                <div class="Dcard" style="text-align: center">
                    <img src="https://img.flaticon.com/icons/png/512/149/149071.png" alt="user image" style="width: 50%"/>
                    <div class="user-card-details">
                        <h3>First Last</h3>
                        <p>email@email.com</p>
                        <p style="text-transform: capitalize; color: grey;">Student</p>
                        <button class="btn">View Member</button>
                    </div>
                </div>
            </div>
            <div class="section3subtittle">ACADEMIC STAFF MEMBERS</div>
            <div class="sectiongrid">
                <div class="Dcard" style="text-align: center">
                    <img src="https://img.flaticon.com/icons/png/512/149/149071.png" alt="user image" style="width: 50%"/>
                    <div class="user-card-details">
                        <h3>First Last</h3>
                        <p>email@email.com</p>
                        <p style="text-transform: capitalize; color: grey;">Student</p>
                        <button class="btn">View Member</button>
                    </div>
                </div>
            </div>
            <div class="section3subtittle">STUDENT MEMBERS</div>
            <div class="sectiongrid">
                <div class="Dcard" style="text-align: center">
                    <img src="https://img.flaticon.com/icons/png/512/149/149071.png" alt="user image" style="width: 50%"/>
                    <div class="user-card-details">
                        <h3>First Last</h3>
                        <p>email@email.com</p>
                        <p style="text-transform: capitalize; color: grey;">Student</p>
                        <button class="btn">View Member</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="Dsection">
            <div class="sectiontittle">PROJECTS</div>
            <div class="sectiongrid">
                <div class="Dcard">
                    <div class="Dcardcontainer">
                        <div class="head">
                            <p>Project Alpha</p>
                            <!-- <span class="material-icons" id="icon1">delete_forever</span> -->
                        </div>
                        <div class="content">
                            <div class="row1col1">
                                <p>Status</p>
                            </div>
                            <div class="row1col2">
                                <p>Active</p>
                            </div>
                            <div class="row2col1">
                                <p>Type</p>
                            </div>
                            <div class="row2col2">
                                <p>External</p>
                            </div>
                            <div class="row3">
                                <p>A discription of project Recusandae veritatis repellat eum exercitationem unde,
                                    dignissimos doloribus magni</p>
                            </div>
                        </div>
                        <div class="foot">
                            <button>View Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $this->end() ?>