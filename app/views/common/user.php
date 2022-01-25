<?php

use Config\Config;

$this->start("content"); ?>
<body class="font-poppins">
  <div class="container  mx-auto w-full h-screen">
    <div class="bg-white h-3/4 mt-20 rounded-xl filter drop-shadow-lg">
      <div class="w-full flex inline   h-1/3">
        <div class="h-full w-1/5 flex justify-center items-center">
            <img class="rounded-full h-32 w-32 filter drop-shadow-lg" src="<?= ROOT ?>app/images/person.png">
        </div>
        <div class="h-full w-2/5 flex justify-center items-center">
           <lable class="text-xl w-full">jhondeo@gmail.com</lable><br>
        </div>
       <div class="h-full w-2/5 flex justify-center items-center">
           <lable class="text-xl w-full">Senior lecturer</lable><br>
       </div>
       </div>
       <div class="w-full">
         <div class="font-bold text-xl mx-20 mb-10">
           Projects
         </div>
         <!-- projects table -->
         <div id="table" class="flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 w-11/12 mx-auto rounded">
           <!-- table header -->
           <div id="table-header" class="border-b-2 border-blue-600 flex w-full">
             <div class="w-1/5 flex justify-start items-center ml-10">
               <div class="text-lg font-bold py-4">Project Name</div>
             </div>
           <div class="w-1/5 flex justify-start items-center ml-10">
             <div class="text-lg font-bold py-4">Status</div>
           </div>
           <div class="w-1/5 flex justify-start items-center ml-10">
             <div class="text-lg font-bold py-4">Type</div>
           </div>
           <div class="w-1/5 flex justify-start items-center ml-10">
             <div class="text-lg font-bold  py-4">Interests</div>
           </div>
           <div class="w-1/5 flex justify-start items-center ml-10">
             <div class="text-lg font-bold py-4"></div>
           </div>
         </div>
         <!-- table content -->
         <div id="table-content" class="w-full">
           <div id="row-blue" class="flex w-full ml-10">
             <div class="w-1/5 flex justify-start items-center">
               <div class="text-lg py-4">Project Alpha</div>
             </div>
             <div class="w-1/5 flex justify-satrt items-center">
               <a href="" class="bg-green-500 rounded-full w-2/3 py-2 flex justify-center items-center hover:opacity-80">
                 <div class="text-lg font-bold text-white">Active</div>
               </a>
             </div>
             <div class="w-1/5 flex justify-start items-center">
               <div class="text-lg py-4">Internal</div>
             </div>
             <div class="w-1/5 flex justify-start items-center">
               <div class="text-lg py-4">AI</div>
             </div>
             <div class="w-1/5 flex justify-satrt items-center">
               <a href="" class="bg-blue-600 rounded-xl w-2/3 py-2 flex justify-center items-center hover:opacity-80">
                 <div class="text-lg font-bold text-white">View</div>
               </a>
             </div>
           </div>
         </div>
       </div>
     </div>
    </div>
  </div>
</body>

<?php $this->end() ?>
