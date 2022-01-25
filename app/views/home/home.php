<?php use App\Models\Users;
use Core\Router;

$user = Users::getCurrentUser();
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
        <div class="bg-white rounded-lg p-2 shadow-md w-2/5 h-fit">
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