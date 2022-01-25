<?php

use Config\Config;

$this->start("content"); ?>

  <div class="container  mx-auto w-full mt-20">
      <table class="table">
          <thead>
          <tr class="table-top-bar">
              <td colspan="4" class="td">
                  <div class="table-search-container">
                     <span class="material-icons-outlined table-search-icon">
                        search
                     </span>
                      <input type="text" placeholder="Search" class="table-search-input"/>
                  </div>
              </td>
              <td colspan="2" class="border-none">
              </td>
          </tr>
          <tr class="table-body-tr">
              <th class="th">Name</th>
              <th class="th" colspan="2">Project</th>
              <th class="th" colspan="2">Status</th>
              <th>
                <span class="material-icons-outlined table-actions-icon">
                more_horiz
                </span>
              </th>
          </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
</div>


<?php $this->end() ?>