<?php 

use App\Models\Users;
use App\Models\Post;
use Core\Router;

$user = Users::getCurrentUser();
$user_type = $user->roles[0];

$posts = Post::getAllPosts();

if (!$user) Router::redirect("/");
$this->start('content');

?>
<?php $this->partial('partials/navbar'); ?>
    <div class="flex justify-around my-5">
        <div class="bg-white rounded-lg shadow-md p-5 w-64 h-fit">
            <p class="uppercase text-sm font-semibold">Search by interests</p>
            <hr/>
            <div class="inline-grid grid-cols-3 gap-2 mt-5">
                <div class="bg-blue-100 rounded-lg text-xs p-2 mx-1 h-fit w-fit">#deep-learning</div>
                <div class="bg-blue-100 rounded-lg text-xs p-2 mx-1 h-fit w-fit">#ux</div>
                <div class="bg-blue-100 rounded-lg text-xs p-2 mx-1">#deep-learning</div>
                <div class="bg-blue-100 rounded-lg text-xs p-2 mx-1">#deep-learning</div>
            </div>
        </div>


        <div class="flex-wrap content-center my-5" style="width:800px">

            <!-- post create start -->
            <?php if($user_type == 'admin' || $user_type == 'coordinator'){ ?>
                <div class="bg-white rounded-lg p-2 shadow-md w-full h-fit my-4">
                    <textarea placeholder="Write something" class="w-full focus:outline-none p-5"></textarea>
                    <div class="w-full flex">
                        <button class="btn bg-blue-500 rounded-l-lg rounded-r-none flex">
                        <span class="material-icons-outlined mr-1">
                            photo
                            </span>Photo
                        </button>
                        <button class="btn bg-blue-500 rounded-none flex">
                        <span class="material-icons-outlined mr-1">
                            article
                            </span>File
                        </button>
                        <button class="btn w-2/5 rounded-l-none rounded-l-lg flex justify-center">
                        <span class="material-icons-outlined">
                            send
                            </span>
                        </button>
                    </div>
                </div>
            <?php } ?>
            <!-- post create end -->

            <!-- post list start -->
            <?php 
                if(count($posts)!=0){
                    foreach($posts as $key=>$post){ 
                        $date = date_create($post->createdAt)
            ?>
                <div class="bg-white rounded-lg p-2 shadow-md w-full h-fit my-4 p-4">

                    <!-- post details -->
                    <div class="w-full flex my-2" >
                        <div class="gap-4 w-1/2 text-left ">
                            <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white p-2" src="https://www.w3schools.com/howto/img_avatar.png" alt=""/>
                            <?php echo $post->firstName; ?>
                        </div>
                        <div class="gap-4 w-1/2 text-right "><?php echo date_format($date,"dS F, Y"); ?></div>
                    </div>

                    <hr>

                    <!-- post content -->
                    <div class="w-full flex my-4">
                        <?php echo $post->notice; ?>
                    </div>

                    <!-- post images / files -->
                    <div class="w-full flex my-4">
                        <img src="" alt="">
                    </div>

                </div>
            <?php 
                    } 
                } else {
            ?>
                <h2 class="text-center ">No Notices</h2>
            <?php } ?>
            <!-- post list end -->

        </div>
        
        <div class="bg-white rounded-lg shadow-md px-5 pt-5 pb-3 rounded-lg shadow-md h-fit">
            <p class="uppercase text-sm font-semibold">Projects you might like</p>
            <hr class="mt-2"/>
            <div class="flex justify-between mt-4">
                <div class="w-1/2 text-sm">
                    <p class="font-bold">Project A</p>
                    <p class="truncate">Lorem ipsum doori aishdishdia jaisdjoasjido naisdh</p>
                </div>
                <div class="flex justify-center items-center">
                    <button class="border border-blue-400 text-blue-400 rounded-lg px-3 py-1 h-fit hover:scale-105 text-sm">
                        View
                    </button>
                </div>
            </div>
            <hr class="mt-5"/>
            <div class="mt-2 flex justify-center items-center text-blue-400">
                See All
            </div>
        </div>
    </div>
<?php $this->end() ?>